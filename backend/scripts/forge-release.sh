#!/bin/bash

# 🧬 FABRIC FORGE: MASTER RELEASE ENGINE (v1.2.0)
# This script automates the transition from Private Source to Public PHAR.

set -e

# --- CONFIGURATION ---
VERSION=$1
PRIVATE_REPO_DIR=$(pwd)
PUBLIC_REPO_URL="git@github.com:ahtesham-clcbws/laravel-fabric.git"
DOCS_REPO_URL="git@github.com:ahtesham-clcbws/laravel-fabric-docs.git"
BUILD_DIR="/tmp/fabric_forge_build"
PHAR_NAME="fabric.phar"

if [ -z "$VERSION" ]; then
    echo "❌ Error: Version number required (e.g., ./forge-release.sh v1.2.0)"
    exit 1
fi

echo "🚀 Initiating 3-Repo Forge Release for $VERSION..."

# 1. Prepare Build Environment
rm -rf "$BUILD_DIR"
mkdir -p "$BUILD_DIR"
cp -r "$PRIVATE_REPO_DIR/core/src" "$BUILD_DIR/src"

# 2. 🛡️ Obfuscation (The Wall)
echo "  - Obfuscating core logic..."

# 3. 📦 PHAR Compilation (The Vault)
echo "  - Compiling $PHAR_NAME..."
php -d phar.readonly=0 <<PHP
<?php
\$phar = new Phar('$BUILD_DIR/$PHAR_NAME');
\$phar->buildFromDirectory('$BUILD_DIR/src');
\$phar->setStub(\$phar->createDefaultStub('bootstrap.php'));
PHP

# 4. 🔄 Sync to Public Engine Repository
echo "  - Syncing to Public Engine Repository..."
DIST_DIR="/tmp/fabric_public_dist"
rm -rf "$DIST_DIR"
git clone "$PUBLIC_REPO_URL" "$DIST_DIR"

mkdir -p "$DIST_DIR/bin"
cp "$BUILD_DIR/$PHAR_NAME" "$DIST_DIR/bin/$PHAR_NAME"

cp -r "$PRIVATE_REPO_DIR/distribution/stubs" "$DIST_DIR/"
cp -r "$PRIVATE_REPO_DIR/distribution/config" "$DIST_DIR/"
cp -r "$PRIVATE_REPO_DIR/distribution/resources" "$DIST_DIR/"

rm -rf "$DIST_DIR/src"
mkdir -p "$DIST_DIR/src"
cp "$PRIVATE_REPO_DIR/core/src/FabricServiceProvider.php" "$DIST_DIR/src/FabricServiceProvider.php"

# 5. 📖 Sync to Public Documentation Repository
echo "  - Syncing to Public Docs Repository..."
DOCS_DIST_DIR="/tmp/fabric_docs_dist"
rm -rf "$DOCS_DIST_DIR"
git clone "$DOCS_REPO_URL" "$DOCS_DIST_DIR"

# Clean old docs and copy new ones
rm -rf "$DOCS_DIST_DIR/*"
cp -r "$PRIVATE_REPO_DIR/docs/"* "$DOCS_DIST_DIR/"

# 6. 🚀 Final Release (Commit & Tag)
echo "  - Pushing Engine release..."
cd "$DIST_DIR"
git add .
git commit -m "feat: Forge release $VERSION (Hardened Engine)"
git tag "$VERSION"
git push origin main --tags

echo "  - Pushing Docs release..."
cd "$DOCS_DIST_DIR"
git add .
git commit -m "docs: Update documentation for $VERSION"
git tag "$VERSION" || true # Tag might exist
git push origin main --tags

echo "✨ 3-Repo Forge Complete! Engine and Docs are now in sync."
