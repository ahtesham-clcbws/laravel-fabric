import os
import re

SOURCE_DIR = '/mnt/BWS/public_projects/Laravel_Livewire_Fabric/merakiui-repo/components'
TARGET_DIR = '/mnt/BWS/public_projects/Laravel_Livewire_Fabric/stubs/livewire/merakiui/components'

def normalize(html):
    # Extract body content
    match = re.search(r'<body>(.*?)</body>', html, re.DOTALL)
    if match:
        content = match.group(1).strip()
    else:
        content = html.strip()
    
    # Replace gray/blue/indigo with neutral/{{ PRIMARY }}
    content = content.replace('gray-', 'neutral-')
    content = content.replace('blue-', '{{ PRIMARY }}-').replace('indigo-', '{{ PRIMARY }}-')
    # Special case for raw hex or specific classes if needed, but Tailwind-style is usually enough
    
    # Standardize rounding
    content = content.replace('rounded-lg', 'rounded-2xl')
    content = content.replace('rounded-md', 'rounded-xl')
    content = content.replace('rounded-sm', 'rounded-lg')
    
    # Replace branding text
    content = content.replace('Meraki UI', 'Fabric')
    
    return content

os.makedirs(TARGET_DIR, exist_ok=True)

for category in os.listdir(SOURCE_DIR):
    cat_path = os.path.join(SOURCE_DIR, category)
    if os.path.isdir(cat_path):
        for filename in os.listdir(cat_path):
            if filename.endswith('.html'):
                source_path = os.path.join(cat_path, filename)
                with open(source_path, 'r') as f:
                    html = f.read()
                
                normalized = normalize(html)
                
                # Create a clean node name
                node_name = f"{category}-{filename.replace('.html', '').lower()}"
                # Handle camelCase or PascalCase to kebab-case
                node_name = re.sub(r'(?<!^)(?=[A-Z])', '-', node_name).lower()
                node_name = node_name.replace('--', '-')
                
                target_path = os.path.join(TARGET_DIR, f"{node_name}.blade.php.stub")
                with open(target_path, 'w') as f:
                    f.write(normalized)
                print(f"Forged: {node_name}")
