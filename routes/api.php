<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactMessageController as PublicContactMessageController;

use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\ClientReviewController;
use App\Http\Controllers\Api\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Api\Admin\FaqController;
use App\Http\Controllers\Api\Admin\MenuController;
use App\Http\Controllers\Api\Admin\NewsController;
use App\Http\Controllers\Api\Admin\PermissionController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\ProjectController;
use App\Http\Controllers\Api\Admin\ProjectImageController;
use App\Http\Controllers\Api\Admin\ReplyReviewController;
use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\Api\Admin\ServiceController;
use App\Http\Controllers\Api\Admin\ServiceFeatureController;
use App\Http\Controllers\Api\Admin\SliderController;
use App\Http\Controllers\Api\Admin\TeamMemberController;
use App\Http\Controllers\Api\AboutUsController as PublicAboutUsController;
use App\Http\Controllers\Api\Admin\AboutUsController as AdminAboutUsController;
use App\Http\Controllers\Api\Admin\EventController;
use App\Http\Controllers\Api\Admin\LicenseController;
use App\Http\Controllers\Api\Admin\SubBrandController;
use App\Http\Controllers\Api\Admin\SiteSettingController;
use App\Http\Controllers\Api\Admin\AdminLogController;

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::post('contact-messages', [PublicContactMessageController::class, 'store']);

Route::get('about-us', [PublicAboutUsController::class, 'show']);

/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/

Route::prefix('admin/auth')->group(function (): void {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    Route::middleware('auth:sanctum')->group(function (): void {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
        Route::patch('profile', [AuthController::class, 'updateProfile']);
        Route::put('change-password', [AuthController::class, 'changePassword']);
    });
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware('auth:sanctum')
    ->group(function (): void {

        Route::apiResource('roles', RoleController::class);

        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('services', ServiceController::class);

        Route::scopeBindings()->group(function (): void
        {
            Route::apiResource('services.features', ServiceFeatureController::class);
        });

        Route::apiResource('faqs', FaqController::class);

        Route::apiResource('projects', ProjectController::class);

        Route::scopeBindings()->group(function (): void
        {
            Route::apiResource('projects.images', ProjectImageController::class);
        });

        Route::apiResource('categories', CategoryController::class);

        Route::apiResource('news', NewsController::class);

        Route::apiResource('products', ProductController::class);

        Route::apiResource('menus', MenuController::class);

        Route::apiResource('sliders', SliderController::class);

        Route::apiResource('client-reviews', ClientReviewController::class);

        Route::apiResource('client-reviews.replies', ReplyReviewController::class);

        Route::apiResource('team-members', TeamMemberController::class);

        Route::get('about-us', [AdminAboutUsController::class, 'show']);

        Route::match(['put', 'patch'], 'about-us', [AdminAboutUsController::class, 'update']);

        Route::apiResource('events', EventController::class);

        Route::apiResource('licenses', LicenseController::class);

        Route::apiResource('sub-brands', SubBrandController::class);

        Route::apiResource('site-settings', SiteSettingController::class);

        Route::get('admin-logs', [AdminLogController::class,'index']);

        Route::get('admin-logs/{adminLog}', [AdminLogController::class,'show']);

        /*
        |--------------------------------------------------------------------------
        | Contact Messages
        |--------------------------------------------------------------------------
        */

        Route::get('contact-messages', [AdminContactMessageController::class, 'index']);

        Route::get('contact-messages/{contact_message}', [AdminContactMessageController::class, 'show']);

        Route::patch('contact-messages/{contact_message}/status', [AdminContactMessageController::class, 'updateStatus']);

        Route::delete('contact-messages/{contact_message}', [AdminContactMessageController::class, 'destroy']);
    });
