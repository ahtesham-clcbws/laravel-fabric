#!/bin/bash
THEME=$1
if [ -z "$THEME" ]; then
    echo "Usage: ./finalize_demo.sh <theme_name>"
    exit 1
fi

DEST="demo/$THEME"
echo "🛠️ Finalizing $THEME app..."

cd "$DEST"

# Reset web.php to avoid boot crashes due to missing classes
cat > routes/web.php <<EOF
<?php
use Illuminate\Support\Facades\Route;
Route::get('/', function () { return view('welcome'); });
EOF

# Publish and configure theme
php artisan vendor:publish --tag=fabric-config --force
sed -i "s/'theme' => .*,/'theme' => '$theme',/" config/fabric.php

# Install Fabric Identity (Native Auth)
php artisan fabric:auth --register --profile --sessions

# Setup Ecosystem Packages
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="medialibrary-migrations"
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-migrations"
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="permission-migrations"

# Migrate and Seed
php artisan migrate:fresh --seed --force

# Generate components
php artisan fabric:generate "App\Models\Admin\CompanyResource" --force

# Publish Assets (Base UI components)
php artisan fabric:assets

# Add authenticated routes (Idempotent)
if ! grep -q "CompanyResourceTable" routes/web.php; then
cat >> routes/web.php <<EOF

use App\Livewire\Fabric\Admin\CompanyResource\CompanyResourceTable;
use App\Livewire\Fabric\Admin\CompanyResource\CompanyResourceEditor;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('companies', CompanyResourceTable::class)->name('company.index');
    Route::get('companies/create', CompanyResourceEditor::class)->name('company.create');
});
EOF
fi

echo "✅ $THEME finalized."
