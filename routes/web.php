<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\MemberController;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* Memeber Routes */

Route::middleware(['auth' ])->group(function(){
    Route::prefix('member')->group(function(){
        Route::controller(MemberController::class)->group(function(){
            Route::get('/create', 'create')->name('member.create');
            Route::post('/create', 'store')->name('member.store');
            Route::get('/lists', 'index')->name('member.lists');
            Route::get('/search', 'search')->name('member.search');

            Route::get('/edit/{id}', 'edit')->name('member.edit');
            Route::put('/update/{id}', 'update')->name('member.update');
        });    
    });    
});

/* Route::get('/send-mail', function () {
    $member = [
        'name' => 'Amit',
        'message' => 'This is a test email using SMTP in Laravel.',
    ];

    Mail::to('amit.xgamer@gmail.com')->send(new WelcomeEmail($member));

    if (count(Mail::failures()) > 0) {
        return 'Email failed to send';
    }

    return 'Mail sent!';
}); */

require __DIR__.'/auth.php';
