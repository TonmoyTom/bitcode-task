<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Website\HomeController;
use Illuminate\Support\Facades\Route;
use Spatie\MediaLibrary\MediaCollections\Models\Media as MediaAlias;

Route::middleware('web')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/trello-login', [HomeController::class, 'trelloLogin'])->name('trello.login');
    Route::get('/trello-logout', [HomeController::class, 'trelloLogout'])->name('trello.logout');
    Route::post('/trello-login-submit', [HomeController::class, 'trelloLoginSubmit'])->name('trello.login.submit');
    Route::get('/trello-information', [HomeController::class, 'trelloInformation'])->name('trello.information');
    Route::post('/trello-set-organizations', [HomeController::class, 'trelloSetorganizations'])->name('trello.set.organizations');
    Route::resource('board', \App\Http\Controllers\Admin\BoradController::class);
    Route::resource('purchase', PurchaseController::class);



    Route::get('/trello-card-create/{id}', [\App\Http\Controllers\Admin\CardController::class, 'trelloCardcreate'])->name('trello.card.create');
    Route::Post('/trello-card-store/{id}', [\App\Http\Controllers\Admin\CardController::class, 'trelloCardStore'])->name('trello.card.store');
    Route::get('/trello-card-child-list/{id}', [\App\Http\Controllers\Admin\CardController::class, 'trelloCardChildList'])->name('trello.card.child.list');


    Route::get('/trello-card-child-list-details/{id}', [\App\Http\Controllers\Admin\CardChildController::class, 'trelloCardChildListDetails'])->name('trello.card.child.list.details');
    Route::get('/trello-card-child-create-details/{id}', [\App\Http\Controllers\Admin\CardChildController::class, 'trelloCardChildCreateDetails'])->name('trello.card.child.create.details');
    Route::Post('/trello-card-child-store-details/{id}', [\App\Http\Controllers\Admin\CardChildController::class, 'trelloCardChildStoreDetails'])->name('trello.card.child.store.details');
});

Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::view('/', 'dashboard.dashboard')->name('dashboard');
    Route::resource('user', UserController::class);

//
//    Route::get('edit-profile', [UserController::class, 'editProfile'])->name('edit.profile');
//    Route::get('change_password', [UserController::class, 'change_password'])->name('change_password');
//    Route::get('settings/company_settings', [SettingController::class, 'editCompanySetting'])->name('company.edit');
//    Route::post('settings/company_setting', [SettingController::class, 'updateCompanySetting'])->name('company.update');
//
//    // Role Permission
//    Route::resource('developer/permission', PermissionController::class)->only('index', 'store');
//    Route::get('role/assign', [RoleController::class, 'roleAssign'])->name('role.assign');
//    Route::post('role/assign', [RoleController::class, 'storeAssign'])->name('store.assign');
//    Route::resource('role', RoleController::class);
//
//    Route::delete('remove-media/{media}', function (MediaAlias $media) {
//        $media->delete();
//        return back()->with('success', 'Media successfully deleted.');
//    })->name('remove-media');
});
