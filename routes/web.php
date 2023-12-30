<?php

use App\Http\Controllers\admin\SettingController as AdminSettingController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\AddressController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\CurrencyController;
use App\Http\Controllers\backend\EmployController;
use App\Http\Controllers\backend\ExpenseController;
use App\Http\Controllers\backend\FlashSalesController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\backend\InventoryController;
use App\Http\Controllers\backend\InvoiceController;
use App\Http\Controllers\Backend\MassEmailController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\Backend\PagesController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\backend\ProductReturnController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\ReviewController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\frontend\UserDashboardController;
use App\Http\Controllers\frontend\WishlistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Middleware\Role;
use App\Models\Inventory;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     // return view('frontend.master');
//     return view('welcome');
// });

// admin route start
Route::get('/admin/login',[AdminController::class,'login'])->name('admin.login.index');
Route::post('/admin/login',[AdminController::class,'loginStore'])->name('login');
Route::middleware(['auth','role:admin'])->group(function(){
    //admin controller start
    Route::controller(AdminController::class)->group(function(){
       Route::get('/admin/dashboard','adminDashboard')->name('admin.dashboard');
    
    });
    //admin controller end

    //category controller
    Route::controller(CategoryController::class)->group(function(){
      Route::get('/admin/category/add','AddCategory')->name('cat.add');
      Route::post('/admin/category/store','StoreCategory')->name('cat.store');
      Route::get('/admin/category','AllCategory')->name('admin.cat.all');
      Route::get('/category/status/{id}','CategoryStatus')->name('cat.status');
      Route::get('/category/edit/{id}','CategoryEdit')->name('cat.edit');
      Route::post('/category/update','CategoryUpdate')->name('cat.update');
      Route::post('/category/delete/','CategoryDelete')->name('cat.delete');
    });
    // end category controller

    // start brand controller
    Route::controller(BrandController::class)->group(function(){
        Route::get('/admin/brand/add','AddBrand')->name('brand.add');
        Route::post('/admin/brand/store','StoreBrand')->name('brand.store');
        Route::get('/admin/brand','AllBrand')->name('admin.brand.all');
        Route::get('/brand/status/{id}','BrandStatus')->name('brand.status');
        Route::get('/brand/edit/{id}','BrandEdit')->name('brand.edit');
        Route::post('/brand/update','BrandUpdate')->name('brand.update');
        Route::post('/brand/delete/','BrandDelete')->name('brand.delete');
      });
    // end brand controller

    // product contrller start
    Route::controller(ProductController::class)->group(function(){
        Route::get('/admin/all/product','allProduct')->name('admin.all.product');
        Route::get('/admin/product/add','AddProduct')->name('product.add');
        Route::post('/admin/product/store','productStore')->name('product.store');
        Route::get('/admin/product/edit/{id}','productEdit')->name('product.edit');
        Route::post('/admin/product/update','productUpdate')->name('product.update');
        Route::post('/admin/product/delete','productDelete')->name('product.delete');
        Route::get('/admin/product/status/{id}','productStatus')->name('product.status');
        Route::get('/admin/product/view/{id}','productView')->name('product.view');
        
    });
    // product contrller end
    
    //coupon controller
    Route::controller(CouponController::class)->group(function(){
        Route::get('/admin/all/coupon','allCoupon')->name('admin.all.coupon');
        Route::get('/admin/coupon/add','AddCoupon')->name('coupon.add');
        Route::post('/admin/coupon/store','CouponStore')->name('coupon.store');
        Route::get('/admin/coupon/edit/{id}','couponEdit')->name('coupon.edit');
        Route::post('/admin/coupon/update','couponUpdate')->name('coupon.update');

        Route::get('/admin/coupon/{id}','couponStatus')->name('coupon.status');
        Route::post('/admin/coupon/delete','couponDelete')->name('coupon.delete');
    });
    //coupon controller end

    // address controller
    Route::controller(AddressController::class)->group(function(){
        Route::get('/admin/division/all','allDivision')->name('admin.all.division');
        Route::get('/admin/division/add','AddDivision')->name('division.add');
        Route::post('/admin/division/store','DivisonStore')->name('division.store');
        Route::get('/division/edit/{id}','DivisionEdit')->name('division.edit');
        Route::post('/division_update','DivisionUpdate')->name('division.update');
        Route::post('/division_delete','DivisionDelete')->name('division.delete');
        Route::get('/division/status/{id}','divisionStatus')->name('division.status');
        // ------------------------------------
        Route::get('/admin/district/all','allDistrict')->name('admin.all.district');
        Route::get('/admin/district/add','AddDistrict')->name('district.add');
        Route::post('/admin/district/store','DistrictStore')->name('district.store');
        Route::get('/district/edit/{id}','districtEdit')->name('district.edit');
        Route::post('/district_update','districtUpdate')->name('district.update');
        Route::post('/district_delete','districtDelete')->name('district.delete');
        Route::get('/district/status/{id}','districtStatus')->name('district.status');
        // ------------------------------------
        
        Route::get('/admin/upazila/all','allUpazila')->name('admin.all.upazila');
        Route::get('/admin/upazila/add','AddUpazila')->name('upazila.add');
        Route::post('/admin/upazila/store','UpazilaStore')->name('upazila.store');
        Route::get('/upazila/edit/{id}','upazilaEdit')->name('upazila.edit');
        Route::post('/upazila_update','upazilaUpdate')->name('upazila.update');
        Route::post('/upazila_delete','upazilaDelete')->name('upazila.delete');
        Route::get('/upazila/status/{id}','upazilaStatus')->name('upazila.status');

        // ------------------------------------
    });
    // address controller end



    // order managment
        Route::controller(OrderController::class)->group(function(){
            Route::get('/admin/order','AllOrder')->name('all.order');
            Route::get('/admin/order/view/{id}','OrderView')->name('order.view');
            Route::get('/invoice/download/{id}','Invoice')->name('invoice');
            Route::post('/admin/order_status','order_status')->name('order_status');
            
        });
    // order managment end

        //admin return
        Route::controller(ProductReturnController::class)->group(function(){
            Route::get('/admin/return-reson','returnReson')->name('return_reson');
            Route::post('/admin/add/return-reson','addReturnReson')->name('add.return.reson');
            Route::get('/admin/return-reson/status/{id}','ReturnStatus')->name('return.reson.status');
            Route::get('/admin/return-reson/edit/{id}','returnResonEdit')->name('return.reson.edit');
            Route::post('/admin/return-reson/update','resonUpdate')->name('update.return.reson');
            Route::post('/admin/reson/delete','resonDelete')->name('reson.delete');
            Route::get('/admin/product/return','allReturn')->name('all.return');
            Route::get('/admin/return-details/{id}','returnDetails')->name('return.details');
            Route::get('/admin/product-return/approve/{id}','ApproveReturn')->name('approve.return');
            Route::post('/admin/return/accept','returnAcc')->name('return.acc');
            Route::post('/admin/order/reject','RejctOrder')->name('admin.order.reject');
        });
        //admin return

        // site setting start
        Route::controller(SettingController::class)->group(function(){
            //logo and name
            Route::get('/admin/setting','index')->name('admin.setting');
            Route::get('/admin/site/and/logo','siteLogo')->name('admin.site.logo');
            Route::post('/admin/logoandsite/store','logoandsiteStore')->name('logoandsite.store');
            Route::get('/admin/logo/site/edit/{id}','logoSiteEdit')->name('logo.site.edit');
            Route::post('/admin/logo/site/update','logoSiteUpdate')->name('logoandsite.update');
            Route::post('/admin/logo/site/delete','logoSiteDelete')->name('logo.site.delete');
            Route::get('/admin/logo/site/status/{id}','logoSiteStatus')->name('logo.site.status');
            //cache 
            Route::post('/admin/cache/clear','clearCache')->name('admin.clearCache');

            //social and contact
            Route::get('/admin/social/contact','socialContact')->name('social.contact');
            Route::post('/admin/social/contact/store','socialContactStore')->name('socialContact.store');
            Route::get('/admin/socialandcontact','allsocialandcontact')->name('all.socialandcontact');
            Route::get('/admin/socialContact/edit/{id}','socialContactEdit')->name('socialContact.edit');
            Route::post('/admin/social/contact/update','socialContactUpdate')->name('socialContact.update');
            Route::post('/admin/contact_delete','contact_delete')->name('contact_delete');
            Route::get('/admin/contact_status/{id}','contact_status')->name('contact_status');
        });
        // site setting end

        //employ controller start
        Route::controller(EmployController::class)->group(function(){
            Route::get('/admin/employer/role','EmployerRole')->name('role.employer');
            Route::post('/admin/employer/role/store','EmployerRoleStore')->name('role.employer.store');
            Route::get('/admin/role/status/{id}','roleStatus')->name('role.status');
            Route::get('/admin/role/edit/{id}','RoleEdit')->name('role.edit');
            Route::put('/admin/role/employer/update','RoleUpdate')->name('role.employer.update');
            Route::delete('/admin/role/delete','roleDeleted')->name('role.delete');
            Route::get('/admin/all/active/employer','allActiveEmployer')->name('active.employer');
            Route::get('/admin/add/employer','addEmployer')->name('add.employer');
            Route::post('/admin/store/employer','StoreEmployer')->name('store.employer');
            Route::get('/admin/employ/status/{id}','employStatus')->name('employ.status');

            Route::get('/admin/all/employer','allEmployer')->name('all.employer');
            Route::get('/admin/employ/edit/{id}','employEdit')->name('employ.edit');
            Route::put('/admin/employ/update','updateEmployer')->name('update.employer');

            Route::get('/admin/employ/details/{id}','employDetails')->name('employ.details');
            Route::delete('/admin/employ/delete','employDelete')->name('employ.delete');

            Route::get('/admin/salary/employer','salaryEmployer')->name('salary.employer');
        });
        //employ controller end

        // expenses controller start
        // Route::controller(ExpenseController::class)->group(function(){
        //     Route::get('/admin/all/expense','allExpense')->name('all.expense');
        // });
        // expenses controller end

        Route::controller(InventoryController::class)->group(function(){
            Route::get('/admin/all/product/stock','allProductStock')->name('product.stock');
            Route::get('/admin/warning/stock','WorningStock')->name('warning.stock');
            Route::get('/admin/stock/details/{id}','StockDetails')->name('stock.details');
        });

        //currency start
        Route::controller(CurrencyController::class)->group(function(){
            Route::get('/admin/currency','currency')->name('currency');
            Route::post('/admin/currency/store','currencyStore')->name('currency.store');
            Route::get('/admin/currency/edit/{id}','currencyEdit')->name('currency.edit');
            Route::put('/admin/currency/update','currencyUpdate')->name('currency.update');
            Route::delete('/admin/currecny/delete/{id}','currencyDelete')->name('currency.delete');
        });
        //currency end
        Route::controller(FlashSalesController::class)->group(function(){
            Route::get('/admin/flash/sales/all','FlashSalesAll')->name('admin.flash.sales.all');
            Route::get('/admin/flash/sales/add','FlashSalesAdd')->name('admin.flash.sales');
            Route::post('/store_flash_sale','store_flash_sale')->name('store_flash_sale');
            Route::get('/view/flash/sale/{id}','viewFlashSale')->name('viewFlashSale');
            Route::get('/remove/from/flash/sale/{id}', 'RemoveFromFlashSale') -> name('flashProduct');
            Route::get('/edit/flash/sales/{id}','editFlashSale')->name('editFlashSale');
            Route::post('/update_flash_sale','update_flash_sale')->name('update_flash_sale');

        });

        Route::controller(PagesController::class)->group(function(){
            Route::get('/admin/add/page','AddPages')->name('admin.add.page');
            Route::post('/admin/add/page','StorePage')->name('page.store');
            Route::get('/admin/page/all','AllPage')->name('admin.all.page');
            Route::get('/admin/edit/page/{id}','EditPage')->name('page.edit');
            Route::post('/admin/update/page','UpdatePage')->name('page.update');
            Route::post('/admin/page/delete','pageDelete')->name('page.delete');

        });

        Route::controller(GalleryController::class)->group(function (){
            Route::get('/admin/gallery','gallery')->name('admin.all.image');    
            Route::get('/admin/add/image','addImages')->name('admin.add.image');
            Route::post('/admin/store/image','storeImage')->name('admin.store.image');
            Route::get('/admin/image/delete/{path}','deleteImage')->name('admin.image.delete');
        });

        Route::controller(MassEmailController::class)->group(function(){
            Route::get('/admin/send/mail','MailPage')->name('admin.mail');
            Route::post('/admin/send/mail','sendMail')->name('admin.send.mail');
        });

});
// admin route end admin.all.image


//====================================================================================================================
//====================================================================================================================
//====================================================================================================================
//====================================================================================================================


Route::get('/test',function(){
    return view('frontend.test');
});


// frontend route start
Route::controller(HomeController::class)->group(function(){
    Route::get('/','index')->name('home');
    Route::get('/product/details/{id}/{slug}','productDetails')->name('product.details');
    Route::get('/category/all/product/{cat_slug}','cat_wiseProduct')->name('cat_wise.product');
    //randering product route  
    Route::get('/serach/product/by/ajax/category','cat_wiseProduct_search')->name('cat_wise.product.search');
    Route::get('/serach/rendering_cat_wiseProduct','rendering_cat_wiseProduct')->name('rendering_cat_wiseProduct');
    Route::get('/serach/product/by/ajax/brand','brand_wiseProduct_search')->name('brand_wise.product.search');

    Route::get('/search','search')->name('search');
    Route::post('/news_letter','news_letter')->name('news_letter');
});

Route::controller(UserController::class)->group(function(){
    Route::get('/register','userRegistration')->name('userRegistration');
    Route::post('/register','userRegistrationStore')->name('userRegistrationStore');
    Route::get('/login','userLogin')->name('userLogin');
    Route::post('/login','userLoginStore')->name('userLoginStore');
    // Route::get('/logout','logout')->name('logout');
    Route::middleware(['auth','role:user'])->group(function(){
        Route::get('/my/account','userAccount')->name('user.account');
        Route::post('/my/account/update','userAccountUpdate')->name('user.account.update');
    });
});

Route::post('/add/to/cart',[CartController::class,'addToCart'])->name('addToCart');

Route::middleware(['auth','role:user'])->group(function(){

    Route::controller(UserController::class)->group(function(){
        Route::get('/add/address','addAddress')->name('add.user.address');
        Route::get('/getDistrict/{id}','getDistrict')->name('getDistrict');
        Route::get('/getUpazila/{id}','getUpazila')->name('getUpazila');
        Route::post('/add/address','StoreAddress')->name('add.address');
        Route::get('/address/edit/{id}','addressEdit')->name('address.edit');
        Route::put('/update/address','UpdateAddress')->name('update.address');
        Route::delete('/addrese/delete','addresDelete')->name('address.delete');
        Route::get('/address/status/{id}','addressStatus')->name('address.status');
    });

    //dashboard controller 
    Route::controller(UserDashboardController::class)->group(function(){
            Route::get('/dashboard','dashboard')->name('dashboard');

            Route::get('/address','userAddress')->name('user.address');

            Route::get('/my/return','my_return')->name('my_return');
            Route::get('/return/details/{id}','return_details')->name('return_details');
        });
        
    //cart route start
    Route::controller(CartController::class)->group(function(){
        Route::get('/cart','mycart')->name('mycart');
        Route::get('/get_cart_data','get_cart_data')->name('get_cart_data');
        Route::get('/cart_item_delete/{id}','cart_item_delete')->name('cart_item_delete');
        Route::get('/get/cart/item/price','itemWisePrice');
        Route::post('/apply/coupon','AppliyedCoupon');
        Route::get('/remove/coupon','couponRemove');

        Route::get('/my/orders','my_orders')->name('my_orders');
        Route::get('/order/details/{id}','order_details')->name('order_details');

        Route::get('/checkout','checkout')->name('checkout');
        
        // Route::match(['get', 'post'],'/order_confirmed','order_confirmed')->name('order_confirmed');
        Route::post('/order_confirmed','order_confirmed')->name('confirmed');

        Route::post('/success','success')->name('success');
        Route::post('/fail','fail')->name('fail');
        Route::get('/cancel','cancel')->name('cancel');

        Route::get('/product/rate/{id}','RatingProduct')->name('rate');
        Route::get('/order/return/{oid}/{pid}','orderReturn')->name('order.return');
        Route::post('/submit-return','submitReturn')->name('submit.return');
    });
    //cart route end

    Route::controller(ReviewController::class)->group(function(){
        Route::post('/store/review','storeReview')->name('store.review');
        Route::get('/review/edit/{id}','ReviewEdit')->name('edit.review');
        Route::post('/update/review','updateReview')->name('update.review');
        Route::get('/delete/review/{id}','deleteReview')->name('delete.review');
    });

    Route::controller(WishlistController::class)->group(function(){
        Route::get('/wishlist','wishlist')->name('wishlist');
        Route::get('/add/wishlist/{id}','addWishlist')->name('add.wishlist');

    });


});


Route::get('/{slug}',[HomeController::class,'pages'])->name('pages');







// SSLCOMMERZ Start
// Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
// Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

// Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
// Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

// Route::post('/success', [SslCommerzPaymentController::class, 'success']);
// Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
// Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

// Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END


//aamar pay start

//You need declear your success & fail route in "app\Middleware\VerifyCsrfToken.php"
// Route::post('success',[\App\Http\Controllers\paymentController::class,'success'])->name('success');
// Route::post('fail',[\App\Http\Controllers\paymentController::class,'fail'])->name('fail');
// Route::get('cancel',[\App\Http\Controllers\paymentController::class,'cancel'])->name('cancel');
//aamar pay end




// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth','role:user'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
