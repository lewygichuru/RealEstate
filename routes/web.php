<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontpageController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Agent\DashboardController as AgentDashboardController;
use App\Http\Controllers\Agent\PropertyController as AgentPropertyController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// AUTH ROUTES
Route::middleware('guest')->group(function () {
    Route::get('/login',    [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login',   [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register',[RegisterController::class, 'register']);
    Route::get('/password/reset',         [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email',        [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset',        [ResetPasswordController::class, 'reset'])->name('password.update');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// FRONT-END ROUTES
Route::get('/', [FrontpageController::class, 'index'])->name('home');
Route::get('/slider', [FrontpageController::class, 'slider'])->name('slider.index');

Route::get('/search', [FrontpageController::class, 'search'])->name('search');

Route::get('/property', [PagesController::class, 'properties'])->name('property');
Route::get('/property/{slug}', [PagesController::class, 'propertieshow'])->name('property.show');
Route::post('/property/message', [PagesController::class, 'messageAgent'])->name('property.message');
Route::post('/property/comment/{id}', [PagesController::class, 'propertyComments'])->name('property.comment');
Route::post('/property/rating', [PagesController::class, 'propertyRating'])->name('property.rating');
Route::get('/property/city/{city}', [PagesController::class, 'propertyCities'])->name('property.city');

Route::get('/agents', [PagesController::class, 'agents'])->name('agents');
Route::get('/agents/{id}', [PagesController::class, 'agentshow'])->name('agents.show');

Route::get('/gallery', [PagesController::class, 'gallery'])->name('gallery');

Route::get('/blog', [PagesController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [PagesController::class, 'blogshow'])->name('blog.show');
Route::post('/blog/comment/{id}', [PagesController::class, 'blogComments'])->name('blog.comment');

Route::get('/blog/categories/{slug}', [PagesController::class, 'blogCategories'])->name('blog.categories');
Route::get('/blog/tags/{slug}', [PagesController::class, 'blogTags'])->name('blog.tags');
Route::get('/blog/author/{userId}', [PagesController::class, 'blogAuthor'])->name('blog.author');

Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::post('/contact', [PagesController::class, 'messageContact'])->name('contact.message');


// ADMIN ROUTES
Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function(){

    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('tags', TagController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class);
    Route::resource('features', FeatureController::class);
    Route::resource('properties', AdminPropertyController::class);
    Route::post('properties/gallery/delete', [AdminPropertyController::class, 'galleryImageDelete'])->name('gallery-delete');

    Route::resource('sliders', SliderController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('testimonials', TestimonialController::class);

    Route::get('galleries/album', [GalleryController::class, 'album'])->name('album');
    Route::post('galleries/album/store', [GalleryController::class, 'albumStore'])->name('album.store');
    Route::get('galleries/{id}/gallery', [GalleryController::class, 'albumGallery'])->name('album.gallery');
    Route::post('galleries', [GalleryController::class, 'Gallerystore'])->name('galleries.store');

    Route::get('settings', [AdminDashboardController::class, 'settings'])->name('settings');
    Route::post('settings', [AdminDashboardController::class, 'settingStore'])->name('settings.store');

    Route::get('profile', [AdminDashboardController::class, 'profile'])->name('profile');
    Route::post('profile', [AdminDashboardController::class, 'profileUpdate'])->name('profile.update');

    Route::get('message', [AdminDashboardController::class, 'message'])->name('message');
    Route::get('message/read/{id}', [AdminDashboardController::class, 'messageRead'])->name('message.read');
    Route::get('message/replay/{id}', [AdminDashboardController::class, 'messageReplay'])->name('message.replay');
    Route::post('message/replay', [AdminDashboardController::class, 'messageSend'])->name('message.send');
    Route::post('message/readunread', [AdminDashboardController::class, 'messageReadUnread'])->name('message.readunread');
    Route::delete('message/delete/{id}', [AdminDashboardController::class, 'messageDelete'])->name('messages.destroy');
    Route::post('message/mail', [AdminDashboardController::class, 'contactMail'])->name('message.mail');

    Route::get('changepassword', [AdminDashboardController::class, 'changePassword'])->name('changepassword');
    Route::post('changepassword', [AdminDashboardController::class, 'changePasswordUpdate'])->name('changepassword.update');

});

// AGENT ROUTES
Route::prefix('agent')->name('agent.')->middleware(['auth','agent'])->group(function(){

    Route::get('dashboard', [AgentDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [AgentDashboardController::class, 'profile'])->name('profile');
    Route::post('profile', [AgentDashboardController::class, 'profileUpdate'])->name('profile.update');
    Route::get('changepassword', [AgentDashboardController::class, 'changePassword'])->name('changepassword');
    Route::post('changepassword', [AgentDashboardController::class, 'changePasswordUpdate'])->name('changepassword.update');
    Route::resource('properties', AgentPropertyController::class);
    Route::post('properties/gallery/delete', [AgentPropertyController::class, 'galleryImageDelete'])->name('gallery-delete');

    Route::get('message', [AgentDashboardController::class, 'message'])->name('message');
    Route::get('message/read/{id}', [AgentDashboardController::class, 'messageRead'])->name('message.read');
    Route::get('message/replay/{id}', [AgentDashboardController::class, 'messageReplay'])->name('message.replay');
    Route::post('message/replay', [AgentDashboardController::class, 'messageSend'])->name('message.send');
    Route::post('message/readunread', [AgentDashboardController::class, 'messageReadUnread'])->name('message.readunread');
    Route::delete('message/delete/{id}', [AgentDashboardController::class, 'messageDelete'])->name('messages.destroy');
    Route::post('message/mail', [AgentDashboardController::class, 'contactMail'])->name('message.mail');

});

// USER ROUTES
Route::prefix('user')->name('user.')->middleware(['auth','user'])->group(function(){

    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [UserDashboardController::class, 'profile'])->name('profile');
    Route::post('profile', [UserDashboardController::class, 'profileUpdate'])->name('profile.update');
    Route::get('changepassword', [UserDashboardController::class, 'changePassword'])->name('changepassword');
    Route::post('changepassword', [UserDashboardController::class, 'changePasswordUpdate'])->name('changepassword.update');

    Route::get('message', [UserDashboardController::class, 'message'])->name('message');
    Route::get('message/read/{id}', [UserDashboardController::class, 'messageRead'])->name('message.read');
    Route::get('message/replay/{id}', [UserDashboardController::class, 'messageReplay'])->name('message.replay');
    Route::post('message/replay', [UserDashboardController::class, 'messageSend'])->name('message.send');
    Route::post('message/readunread', [UserDashboardController::class, 'messageReadUnread'])->name('message.readunread');
    Route::delete('message/delete/{id}', [UserDashboardController::class, 'messageDelete'])->name('messages.destroy');

});
