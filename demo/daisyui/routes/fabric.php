<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Fabric\Dashboard;
use App\Livewire\Fabric\Lab;
use App\Livewire\Fabric\Auth\Profile;
use App\Livewire\Fabric\Auth\Login;
use App\Livewire\Fabric\Auth\Register;

/* --- Fabric Guest Routes --- */
Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
    Route::get('login/magic/{token}', [Login::class, 'verifyMagic'])->name('login.magic');
});

/* --- Fabric Authenticated Routes --- */
Route::middleware(['web', 'auth'])->prefix('fabric')->name('fabric.')->group(function () {
    Route::get('/', function() { return redirect()->route('fabric.dashboard'); });
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/lab', Lab::class)->name('lab');
    Route::get('/profile', Profile::class)->name('profile');

    
    
    
    

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        Route::get('/post', \App\Livewire\Fabric\Post\Table::class)->name('post.index');
        Route::get('/category', \App\Livewire\Fabric\Category\Table::class)->name('category.index');
        Route::get('/user', \App\Livewire\Fabric\User\Table::class)->name('user.index');
        Route::get('/tag', \App\Livewire\Fabric\Tag\Table::class)->name('tag.index');
        Route::get('/testimonial', \App\Livewire\Fabric\Testimonial\Table::class)->name('testimonial.index');
        Route::get('/faq', \App\Livewire\Fabric\Faq\Table::class)->name('faq.index');
        Route::get('/service', \App\Livewire\Fabric\Service\Table::class)->name('service.index');
        Route::get('/inquiry', \App\Livewire\Fabric\Inquiry\Table::class)->name('inquiry.index');
        Route::get('/settings/general-settings', \App\Livewire\Fabric\Settings\GeneralSettings::class)->name('settings.general-settings');
    // [FABRIC-RESOURCE-ROUTES]
    
    Route::post('logout', function () {
        \Illuminate\Support\Facades\Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});
