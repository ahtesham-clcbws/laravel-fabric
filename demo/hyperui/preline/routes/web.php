<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Fabric\App\Models\Post\PostTable;
use App\Livewire\Fabric\App\Models\Post\PostEditor;
use App\Livewire\Fabric\App\Models\Category\CategoryTable;

Route::get('/', function () {
    return view('welcome');
});

Route::get('posts', PostTable::class)->name('post.index');
Route::get('posts/editor', PostEditor::class)->name('post.editor');
Route::get('categories', CategoryTable::class)->name('category.index');

use App\Livewire\Fabric\App\Models\Admin\CompanyResource\CompanyResourceTable;
use App\Livewire\Fabric\App\Models\Admin\CompanyResource\CompanyResourceEditor;

Route::get('companies', CompanyResourceTable::class)->name('company.index');
Route::get('companies/create', CompanyResourceEditor::class)->name('company.create');
