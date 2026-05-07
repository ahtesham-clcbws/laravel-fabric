#!/bin/bash
THEME=$1
if [ -z "$THEME" ]; then
    echo "Usage: ./provision_demo.sh <theme_name>"
    exit 1
fi

DEST="demo/$THEME"
echo "🚀 Provisioning demo app for $THEME at $DEST..."

# Create directory
mkdir -p "$DEST"

# Copy from template (excluding theme folders)
rsync -av --progress demo/template/ "$DEST" \
    --exclude "vendor" \
    --exclude "node_modules" \
    --exclude "storage/framework/cache/data/*" \
    --exclude "storage/framework/sessions/*" \
    --exclude "storage/framework/views/*.php" \
    --exclude "storage/logs/*.log" \
    --exclude "database/database.sqlite"

# Copy vendor if it exists
if [ -d "demo/template/vendor" ]; then
    echo "📦 Copying vendor folder..."
    cp -r demo/template/vendor "$DEST/"
fi

# Update .env
if [ -f "demo/template/.env" ]; then
    cp "demo/template/.env" "$DEST/.env"
else
    cp "demo/template/.env.example" "$DEST/.env"
fi

sed -i "s/APP_NAME=Laravel/APP_NAME=Fabric_$THEME/" "$DEST/.env"
sed -i "s/DB_DATABASE=.*/DB_DATABASE=database.sqlite/" "$DEST/.env"
touch "$DEST/database/database.sqlite"

# Generate license key (needed because it's path-bound)
FINGERPRINT=$(php -r "echo substr(md5('$PWD/$DEST'), 0, 8);")
KEY="FAB-$(echo $FINGERPRINT | tr '[:lower:]' '[:upper:]')-TEST"
echo "FABRIC_LICENSE_KEY=$KEY" >> "$DEST/.env"

echo "✅ $THEME provisioned."
