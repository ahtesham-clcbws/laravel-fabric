-- 🏗️ FABRIC REGISTRY: MASTER SCHEMA
-- This SQL handles User Accounts (Solo/Company) and Project Licensing.

-- 1. Account Type Enum
CREATE TYPE account_type AS ENUM ('solo', 'company', 'partner', 'enterprise');

-- 2. Strategy Key Enum (How we charge/manage the user)
CREATE TYPE strategy_key AS ENUM ('forever_free', 'limited_free', 'commercial');

-- 3. Users / Developers Table
-- (Linked to Supabase Auth.uid())
CREATE TABLE fabric_users (
    id UUID PRIMARY KEY REFERENCES auth.users(id),
    email TEXT UNIQUE NOT NULL,
    account_type account_type DEFAULT 'solo',
    strategy_key strategy_key DEFAULT 'limited_free',
    max_projects INT DEFAULT 5,
    is_beta_user BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT NOW()
);

-- 4. Projects Table (The Installation Registry)
CREATE TABLE fabric_projects (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    user_id UUID REFERENCES fabric_users(id) NOT NULL,
    project_name TEXT NOT NULL,
    local_uuid UUID UNIQUE NOT NULL, -- The ID from the .fabric file
    is_legacy BOOLEAN DEFAULT TRUE,  -- Beta projects are legacy (Free Forever)
    is_active BOOLEAN DEFAULT TRUE,
    license_artifact TEXT,           -- The Signed Sodium Token
    expiry TIMESTAMP WITH TIME ZONE, -- NULL = Infinite
    created_at TIMESTAMP WITH TIME ZONE DEFAULT NOW()
);

-- 5. Row Level Security (RLS)
ALTER TABLE fabric_users ENABLE ROW LEVEL SECURITY;
ALTER TABLE fabric_projects ENABLE ROW LEVEL SECURITY;

-- Users can view their own data
CREATE POLICY "Users can view their own profile" ON fabric_users FOR SELECT USING (auth.uid() = id);
CREATE POLICY "Users can view their own projects" ON fabric_projects FOR SELECT USING (auth.uid() = user_id);

-- Only your backend (Service Role) can update projects/users
