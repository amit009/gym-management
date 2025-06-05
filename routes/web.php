<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\DashboardController;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\UserRoleController;
use App\Models\User;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\RolesPermissionController;

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
    Route::get('/members', [MemberController::class, 'index'])->name('members');
    Route::prefix('member')->group(function(){
        Route::controller(MemberController::class)->group(function(){
            Route::get('/create', 'create')->name('member.create');
            Route::post('/create', 'store')->name('member.store');
            Route::get('/search', 'search')->name('member.search');
            
            Route::get('/view/{id}', 'show')->name('member.view');
            Route::get('/edit/{id}', 'edit')->name('member.edit');
            Route::put('/update/{id}', 'update')->name('member.update');
            Route::delete('/delete/{id}', 'destroy')->name('member.delete');
            Route::put('/update_fee', 'updateFee')->name('member.update_fee');
            Route::post('/send_notification', 'sendNotification')->name('member.send_notification');
        });    
    });

    
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::prefix('service')->group(function(){
        Route::controller(ServiceController::class)->group(function(){
            Route::get('/create', 'create')->name('service.create');
            Route::post('/create', 'store')->name('service.store');
            
            Route::get('/view/{id}', 'show')->name('service.view');
            Route::get('/edit/{id}', 'edit')->name('service.edit');
            Route::put('/update/{id}', 'update')->name('service.update');
            Route::delete('/delete/{id}', 'destroy')->name('service.delete');
        });    
    });
    
    Route::get('/trainers', [TrainerController::class, 'index'])->name('trainers');
    Route::prefix('trainer')->group(function(){
        Route::controller(TrainerController::class)->group(function(){
            Route::get('/create', 'create')->name('trainer.create');
            Route::post('/create', 'store')->name('trainer.store');            
            Route::get('/view/{id}', 'show')->name('trainer.view');
            Route::get('/edit/{id}', 'edit')->name('trainer.edit');
            Route::put('/update/{id}', 'update')->name('trainer.update');
            Route::delete('/delete/{id}', 'destroy')->name('trainer.delete');
            Route::get('/restore/{id}', 'restore')->name('trainer.restore');
        });    
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    //Route::get('/dashboard', [UserRoleController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [UserRoleController::class, 'index'])->name('users');
    Route::get('/user/create', [UserRoleController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserRoleController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserRoleController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{id}', [UserRoleController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{id}', [UserRoleController::class, 'delete'])->name('user.delete');
   
    Route::get('/roles', [RolesPermissionController::class, 'index'])->name('roles');
    Route::get('/role/create', [RolesPermissionController::class, 'create'])->name('role.create');
    Route::post('/role/store', [RolesPermissionController::class, 'store'])->name('role.store');
    Route::get('/role/edit/{id}', [RolesPermissionController::class, 'edit'])->name('role.edit');
    Route::put('/role/update/{id}', [RolesPermissionController::class, 'update'])->name('role.update');
    Route::delete('/role/delete/{id}', [RolesPermissionController::class, 'destroy'])->name('role.delete');
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


/******** Routes for testing purpose ************/
/* Route::get('/test/{name?}', function (?string $name="John") {
    return 'Hello ' . $name;
})->name('test'); */

/* Route::get('/test/{name}', function (string $name) {
    return "Hello " . $name;
})->whereAlpha('name')->name('test'); */

Route::get('/search/{search}', function (string $search) {
    return $search;
})->where('search', '.*');

//Route::get('/test', [MemberController::class, 'test'])->name('test');
Route::get('/home', function(User $user){
    //return "Hello World!";
    //return response('Hello World!', 200)->header('content-type', 'text/plain');
    //return $user;
    //return redirect('/dashboard');
    //return back()->withInput();
    //return redirect()->action([MemberController::class, 'show'], ['id' => 1]);
    //return redirect()->away('https://www.google.com/');
    /* return response()->json([
        'name' => 'John Doe',
        'email' =>'amit@gmail.com'
    ]); */

    /* return response()->download( public_path('build/images/muscle.png'), 'muscle.png', [
        'Content-Type' => 'image/png',
        'Content-Disposition' => 'inline; filename="muscle.png"',
    ]); */

    //return response()->file(public_path('build/images/muscle.png'));

     
});

/* Route::get('/users.json', function () {
    return response()->streamJson([
        'users' => User::cursor(),
    ]);
}); */

Route::get('/test', [MemberController::class, 'test'])->name('test');

require __DIR__.'/auth.php';
