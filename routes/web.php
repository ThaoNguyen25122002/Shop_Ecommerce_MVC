<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\AuthUserController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Frontend\HandleCartController;
use App\Models\Product;

use function Pest\Laravel\get;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';


Route::prefix('admin')->middleware(['auth','CheckAdmin'])->group(function(){
    Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    // ============= Handle Profile =============== //
    Route::get('profile',[AdminController::class,'showProfile'])->name('admin.profile');
    Route::put('profile',[AdminController::class,'updateProfile'])->name('admin.updateProfile');
    // ============= Handle Country =============== //
    Route::get('country',[AdminController::class,'showCountry'])->name('admin.showCountry');
    Route::get('editCountry/{id}',[AdminController::class,'formEditCountry'])->name('admin.formEditCountry');
    Route::put('editCountry',[AdminController::class,'updateCountry'])->name('admin.updateCountry');
    Route::get('/deleteCountry/{id}', [AdminController::class,'deleteCountry'])->name('admin.deleteCountry');
    Route::view('addCountry','admin/countries/form_addCountry');
    Route::post('addCountry',[AdminController::class,'createCountry'])->name('admin.createCountry');
    // ============= Handle Blogs =============== //
    Route::get('blogs',[AdminController::class,'showBlog'])->name('admin.showBlog');
    Route::view('addBlog','admin/blogs/form_add_blog');
    Route::post('/addBlog',[AdminController::class,'createBlog'])->name('admin.createBlog');
    Route::get('editBlog/{id}',[AdminController::class,'editBlog'])->name('admin.editBlog');
    Route::put('editBlog/{id}',[AdminController::class,'updateBlog'])->name('admin.updateBlog');
    Route::get('deleteBlog/{id}',[AdminController::class,'deleteBlog'])->name('admin.deleteBlog');
    // ============= Handle History =============== //
    Route::get('/history',[AdminController::class,'showHistories'])->name('admin.showHistories');
    // ============= Handle Others =============== //
    Route::view('/form','admin/form/form');
    Route::view('/table','admin/table/table');
    Route::view('/icon','admin/icon/icon');
    Route::view('/starter','admin/starter/starter');
    Route::view('/404','admin/404');
});


// Route::get('/haha',[CommentController::class,'test']);


    // Route::view('/','frontend.index')->middleware('CheckMember')->name('user.home');
    // ========= Chưa đăng nhập mới được vào =========== //
Route::middleware('guest')->group(function(){
    Route::view('/register','frontend.auth.register')->name('register');
    Route::post('/register',[AuthUserController::class,'register'])->name('user.register');
    Route::view('/login','frontend.auth.login')->name('login');
    Route::post('/login',[AuthUserController::class,'login'])->name('user.login');
});
    // ===== Chưa đăng nhập hoặc đã đăng nhập bằng tk Member thì được vào ======= //
    Route::middleware('CheckMember')->group(function(){
        Route::get('/blog',[BlogController::class,'blogList']);
        // Route::view('/blog-detail','frontend.blog.blog-detail');
        Route::get('/blog-detail/{id}',[BlogController::class,'showBlogDetail']);
        Route::view('/rate','frontend.rate.rate');
        Route::post('/blog-detail/{id}',[CommentController::class,'postComment'])->name('user.postComment');
        Route::post('/blog/rate/ajax',[BlogController::class,'updateRating'])->name('rating');
                    // ================ Home =============== //
        Route::get('/',[HomeController::class,'index'])->name('user.home');
        Route::get('/product-details/{id}',[ProductController::class,'productDetail']);
    
    
        // ====================== Search By Name ======================//
        Route::get('/search',[HomeController::class,'searchByName']);
        // ====================== Menu Search ======================//
        Route::get('/menu-search',[HomeController::class,'searchByMenuSearch'])->name('search.results');
        // ====================== Price Range ======================= //
        Route::get('price-range',[HomeController::class,'searchPrice']);



        // ====================== Login Mới được vào ===================== //
        Route::middleware('auth')->group(function(){
            Route::get('account',[AccountController::class,'showAccount']);
            Route::put('updateAccount',[AccountController::class, 'updateAccount']);
            // ==================== Rating ==================== //
            // ==================== Post Comment =============== //
            Route::get('my-product',[ProductController::class,'showProduct']);
            Route::get('form-add-product',[ProductController::class,'showFormCreate']);
            Route::post('form-add-product',[ProductController::class,'createProduct']);
            Route::get('edit-product/{id}',[ProductController::class,'showFormEdit']);
            Route::put('edit-product/{id}',[ProductController::class,'update'])->name('user.updateProduct');
            // Route::view('form-add-product','frontend.product.form-add-product');
            // Route::get('delete-product/{id}',[ProductController::class,'deleteProduct']);
            
            // ================== Add To Cart ================= //
            Route::post('add-to-cart',[HomeController::class,'addToCart']);
            // ================== Handle Cart ================= //
            
            Route::get('cart',[HandleCartController::class,'index']);
            Route::post('cart',[HandleCartController::class,'handleCartAjax']);
    
            // ===================== Send Mail ====================== //
    
            // ===================== CheckOut ====================== //
            Route::get('checkout',[HandleCartController::class,'checkout']);
    
        });
    });
    



    
    



