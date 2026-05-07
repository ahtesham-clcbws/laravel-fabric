<?php
use Illuminate\Support\Facades\Route;
Route::get('/', function () { return view('welcome'); });

require __DIR__.'/auth.php';

use App\Livewire\Fabric\Admin\CompanyResource\CompanyResourceTable;
use App\Livewire\Fabric\Admin\CompanyResource\CompanyResourceEditor;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('companies', CompanyResourceTable::class)->name('company.index');
    Route::get('companies/create', CompanyResourceEditor::class)->name('company.create');
});
