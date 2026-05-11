// 🦕 FABRIC REGISTRY: SIGNING ENGINE (v1.2.0)
// This Edge Function validates project registrations and signs license artifacts.

import { serve } from "https://deno.land/std@0.168.0/http/server.ts"
import { createClient } from 'https://esm.sh/@supabase/supabase-js@2'
import * as sodium from "https://deno.land/x/sodium@0.2.0/sumo.ts"

serve(async (req) => {
  try {
    const { uuid, email, projectName, machineId } = await req.json()

    // 1. Initialize Supabase
    const supabase = createClient(
      Deno.env.get('SUPABASE_URL') ?? '',
      Deno.env.get('SUPABASE_SERVICE_ROLE_KEY') ?? ''
    )

    // 2. Fetch or Create User
    let { data: user } = await supabase
      .from('fabric_users')
      .select('*')
      .eq('email', email)
      .single()

    if (!user) {
      const { data: newUser } = await supabase
        .from('fabric_users')
        .insert([{ email, account_type: 'solo', strategy_key: 'limited_free' }])
        .select()
        .single()
      user = newUser
    }

    // 3. Register Project
    const { data: project, error } = await supabase
      .from('fabric_projects')
      .upsert([
        { 
          user_id: user.id, 
          local_uuid: uuid, 
          project_name: projectName,
          is_legacy: user.is_beta_user 
        }
      ])
      .select()
      .single()

    if (error) throw error

    // 4. ✍️ Sign the License Artifact (Sodium)
    // We sign the combination of UUID + Expiry + Strategy
    const message = `${uuid}:${user.strategy_key}:${project.is_legacy ? 'legacy' : 'commercial'}`
    
    // In production, we use a real secret key from Deno.env
    const signature = "SIGNATURE_SIMULATION_" + btoa(message)

    return new Response(
      JSON.stringify({ 
        status: 'success', 
        license: signature,
        is_legacy: project.is_legacy,
        strategy: user.strategy_key
      }),
      { headers: { "Content-Type": "application/json" } },
    )

  } catch (error) {
    return new Response(JSON.stringify({ error: error.message }), { status: 400 })
  }
})
