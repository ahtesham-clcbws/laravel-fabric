#!/bin/bash
THEME=$1
if [ -z "$THEME" ]; then
    echo "Usage: ./provision_theme.sh <theme_name>"
    exit 1
fi

DEST="integration_test/$THEME"
echo "🚀 Provisioning $THEME app at $DEST..."

# Create directory
mkdir -p "$DEST"

# Copy base Laravel structure from integration_test root
# Exclude theme directories and large vendor/node_modules
rsync -av --progress integration_test/ "$DEST" \
    --exclude "tailwind" \
    --exclude "daisyui" \
    --exclude "floatui" \
    --exclude "hyperui" \
    --exclude "preline" \
    --exclude "vendor" \
    --exclude "node_modules" \
    --exclude "storage/framework/cache/data/*" \
    --exclude "storage/framework/sessions/*" \
    --exclude "storage/framework/views/*.php" \
    --exclude "storage/logs/*.log" \
    --exclude "database/database.sqlite"

# Update composer.json repository path to ../../
sed -i 's/"url": "\.\.\/"/"url": "\.\.\/\.\.\/"/' "$DEST/composer.json"

# Update .env if it exists, or create from example
if [ -f "integration_test/.env" ]; then
    cp "integration_test/.env" "$DEST/.env"
else
    cp "integration_test/.env.example" "$DEST/.env"
fi

# Update APP_NAME and database path in .env
sed -i "s/APP_NAME=Laravel/APP_NAME=Fabric_$THEME/" "$DEST/.env"
sed -i "s/DB_DATABASE=.*/DB_DATABASE=database.sqlite/" "$DEST/.env"

# Initialize SQLite
touch "$DEST/database/database.sqlite"

echo "✅ $THEME app provisioned. Run 'composer install' in $DEST to finish."
