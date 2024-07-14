<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\AdminUserManagement;
use App\Http\Livewire\AdminCategoryPost;
use App\Http\Livewire\AdminPost;
use App\Http\Livewire\ManageCategoryProducts;
use App\Http\Livewire\ManageProducts;
use App\Http\Livewire\PostCreate;
use App\Http\Livewire\PostEdit;

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

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', AdminUserManagement::class)->name('admin.users');
    Route::get('/admin/category-posts', AdminCategoryPost::class)->name('admin.post-category');
    Route::get('/admin/posts', AdminPost::class)->name('admin.posts.index');
    Route::get('/admin/posts/create', PostCreate::class)->name('posts.create');
    Route::get('/admin/posts/{id}/edit', PostEdit::class)->name('posts.edit');
    Route::get('admin/manage-products', ManageProducts::class)->name('manage-products'); 
    Route::get('admin/manage-category-products', ManageCategoryProducts::class)->name('manage-category-products');
});