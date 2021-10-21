<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlukOptoinsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PostPageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Monolog\Processor\HostnameProcessor;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BlogController::class, 'index']);
Route::get('/home', [BlogController::class, 'index'])->name('home');
Route::get('search', [BlogController::class, 'search']);
Route::get('post/{id}', [PostPageController::class, 'show']);
Route::get('author/{author}', [PostPageController::class, 'author']);
Route::get('category/{id}', [PostPageController::class, 'category']);

Route::middleware(['auth','isadmin'])->group(function(){
    

    Route::get('/admin', [HomeController::class, 'adminPage'])->name('admin');
    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class);
    Route::resource('users', UserController::class);
    Route::get('comment/approving/{id}', [CommentController::class, 'approving']);
    Route::get('comment/unapproving/{id}', [CommentController::class, 'unapproving']);
    Route::post('commentoption' , [BlukOptoinsController::class, 'commentOption'])->name('commentoption');
    Route::get('categoriesoptions' , [BlukOptoinsController::class, 'categoriesOptions'])->name('categoriesoptions');
    Route::post('postsoptions', [BlukOptoinsController::class, 'postsOptions'])->name('postsoptions');
    Route::post('useroptions', [BlukOptoinsController::class, 'userOptions'])->name('useroptions');
});


Route::middleware(['auth'])->group(function(){
    
    Route::resource('user_post', App\Http\Controllers\User\PostController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('profile', ProfileController::class);
    
});



require __DIR__.'/auth.php';

