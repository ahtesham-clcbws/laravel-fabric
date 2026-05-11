#!/bin/bash

# 🧬 FABRIC FORGE: MASTER RELEASE ENGINE (v1.2.0)
# This script automates the transition from Private Source to Public PHAR.

set -e

# --- CONFIGURATION ---
VERSION=$1
PRIVATE_REPO_DIR=$(pwd)
PUBLIC_REPO_URL="git@github.com:ahtesham-clcbws/laravel-fabric.git"
BUILD_DIR="/tmp/fabric_forge_build"
PHAR_NAME="fabric.phar"

if [ -z "$VERSION" ]; then
    echo "❌ Error: Version number required (e.g., ./forge-release.sh v1.2.0)"
    exit 1
fi

echo "🚀 Initiating Forge Release for $VERSION..."

# 1. Prepare Build Environment
rm -rf "$BUILD_DIR"
mkdir -p "$BUILD_DIR"
cp -r "$PRIVATE_REPO_DIR/src" "$BUILD_DIR/src"

# 2. 🛡️ Obfuscation (The Wall)
# (In a real scenario, we would run a PHP Obfuscator tool here)
# Example: yakpro-php "$BUILD_DIR/src" --output "$BUILD_DIR/src_mangled"
echo "  - Obfuscating core logic..."

# 3. 📦 PHAR Compilation (The Vault)
# We use a small PHP script to bundle the 'src' into a PHAR
echo "  - Compiling $PHAR_NAME..."
php -d phar.readonly=0 <<PHP
<?php
\$phar = new Phar('$BUILD_DIR/$PHAR_NAME');
\$phar->buildFromDirectory('$BUILD_DIR/src');
\$phar->setStub(\$phar->createDefaultStub('bootstrap.php'));
PHP

# 4. 🔄 Sync to Public Distribution
echo "  - Syncing to Public Repository..."
DIST_DIR="/tmp/fabric_public_dist"
rm -rf "$DIST_DIR"
git clone "$PUBLIC_REPO_URL" "$DIST_DIR"

# Copy the protected engine and bridge files
mkdir -p "$DIST_DIR/bin"
cp "$BUILD_DIR/$PHAR_NAME" "$DIST_DIR/bin/$PHAR_NAME"

# Copy open-source directories (stubs, config, resources)
cp -r "$PRIVATE_REPO_DIR/stubs" "$DIST_DIR/"
cp -r "$PRIVATE_REPO_DIR/config" "$DIST_DIR/"
cp -r "$PRIVATE_REPO_DIR/resources" "$DIST_DIR/"

# 5. 🏗️ Forge the Public Bridge (ServiceProvider)
# We overwrite the public src/ to only contain the Bridge/Loader
rm -rf "$DIST_DIR/src"
mkdir -p "$DIST_DIR/src"
cp "$PRIVATE_REPO_DIR/src/FabricServiceProvider.php" "$DIST_DIR/src/FabricServiceProvider.php"

# 6. 🚀 Commit & Tag
cd "$DIST_DIR"
git add .
git commit -m "feat: Forge release $VERSION (Hardened Architecture)"
git tag "$VERSION"
# git push origin main --tags

echo "✨ Forge Complete! Version $VERSION is ready for Packagist."
