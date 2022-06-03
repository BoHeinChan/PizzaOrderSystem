<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PizzaController;
use App\Http\Controllers\Admin\UserController as User;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
 */

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.profile');
            } else {
                return redirect()->route('user#index');
            }
        }
    })->name('dashboard');
});
Route::controller(AdminController::class)->group(function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {
            Route::middleware('admin')->group(function () {
                Route::get('profile', 'profile')->name('profile');
                Route::post('profile/{id}', 'update_profile')->name('update_profile');
                Route::get('change_password/{id}', 'change_password')->name('change_password');
                Route::post('change_password/{id}', 'update_password')->name('update_password');
                Route::get('contact_list', 'contact_list')->name('contact_list');
                Route::get('search_contact', 'search_contact')->name('search_contact');
            });
        });
    });
});

Route::controller(CategoryController::class)->group(function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {
            Route::middleware('admin')->group(function () {
                Route::get('category', 'category')->name('category');
                Route::get('add_category', 'add_category')->name('add_category');
                Route::post('add_category', 'create_category')->name('create_category');
                Route::get('delete_category/{id}', 'delete_category')->name('delete_category');
                Route::get('edit_category/{id}', 'edit_category')->name('edit_category');
                Route::put('update_category/{id}', 'update_category')->name('update_category');
                Route::get('search_category', 'search_category')->name('serach_category');
                Route::get('category_detail/{id}', 'category_detail')->name('category_detail');
                Route::get('csv', 'csv')->name('csv');
            });
        });
    });
});

Route::controller(PizzaController::class)->group(function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {
            Route::middleware('admin')->group(function () {
                Route::get('pizza', 'pizza')->name('pizza');
                Route::get('add_pizza', 'add_pizza')->name('add_pizza');
                Route::post('add_pizza', 'create_pizza')->name('create_pizza');
                Route::get('delete_pizza/{id}', 'delete_pizza')->name('delete_pizza');
                Route::get('pizza_info/{id}', 'pizza_info')->name('pizza_info');
                Route::get('edit_pizza/{id}', 'edit_pizza')->name('edit_pizza');
                Route::put('update_pizza/{id}', 'update_pizza')->name('update_pizza');
                Route::get('search_pizza', 'search_pizza')->name('search_pizza');
                Route::get('/pizza/csv', 'csv')->name('pizza_csv');
            });
        });
    });
});

Route::controller(User::class)->group(function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {
            Route::middleware('admin')->group(function () {
                Route::get('user_list', 'user_list')->name('user_list');
                Route::get('eidt_user/{id}', 'edit_user')->name('edit_user');
                Route::post('update_user/{id}', 'update_user')->name('update_user');
                Route::get('admin_list', 'admin_list')->name('admin_list');
                Route::get('edit_admin/{id}', 'edit_admin')->name('edit_admin');
                Route::post('update_admin/{id}', 'update_admin')->name('update_admin');
                Route::post('search_user', 'search_user')->name('search_user');
                Route::post('search_admin', 'search_admin')->name('search_admin');
                Route::get('user/csv', 'csv')->name('user_csv');
                Route::get('admin/csv', 'csv_admin')->name('admin_csv');
            });
        });
    });
});

Route::controller(UserController::class)->group(function () {
    Route::prefix('user')->group(function () {
        Route::name('user#')->group(function () {
            Route::middleware('user')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('contact', 'contact')->name('contact');
                Route::get('pizza_detail/{id}', 'pizza_detail')->name('pizza_detail');
                Route::get('category_search/{id}', 'category_search')->name('category_search');
                Route::get('pizza_search', 'pizza_search')->name('pizza_search');
                Route::get('pizza_search/custom_search', 'custom_search')->name('custom_search');
                Route::get('order_page/{id}', 'order_page')->name('order_page');
                Route::get('order/{id}', 'order')->name('order');
            });
        });
    });
});

Route::controller(OrderController::class)->group(function () {
    Route::prefix('order')->group(function () {
        Route::name('order#')->group(function () {
            Route::middleware('admin')->group(function () {
                Route::get('order_list', 'order_list')->name('order_list');
                Route::get('search_order', 'search_order')->name('search_order');
                Route::get('csv', 'csv')->name('csv');
            });
        });
    });
});
