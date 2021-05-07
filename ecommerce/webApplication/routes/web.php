<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::match(['get', 'post'],'/','IndexController@index');

//user product
Route::get('/products/{id}','ProductsController@products');

//user sub category
Route::get('/categories/{category_id}','IndexController@categories');

//product page
Route::get('/products','IndexController@products');

//product details page get price
Route::get('/get_product_price','ProductsController@getprice');

// Route for login-register
Route::get('/login-register','UsersController@userLoginRegister');

// Route for login-user
Route::post('/user-login','UsersController@login');

// Route for add user registration
Route::post('/user-register','UsersController@register');

// Route for add user registration
Route::get('/user-logout','UsersController@logout');

// Route for confirm registration
Route::get('/confirm/{id}','UsersController@confirmAccount');

// Route for about us
Route::match(['get', 'post'], '/about-us', 'ProductsController@aboutUs');

// Route for contact us
Route::get('/contact-us', 'ContactController@create');
Route::post('/submit', 'ContactController@store');

//add to cart page
Route::match(['get','post'],'/add_to_cart','ProductsController@addtocart');  //add to db
Route::match(['get','post'],'/cart','ProductsController@cart'); //->middleware('verified'); //display 
Route::get('/cart/delete_product/{id}','ProductsController@deleteCartProduct'); //delete
Route::get('/cart/update_quantity/{id}/{quantity}','ProductsController@updateCartQuantity'); //update quantity

//apply user coupon code
Route::post('/cart/apply_coupon/','ProductsController@applyCoupon');

//admin route
Route::match(['get', 'post'],'/admin','AdminController@login');

//smtp Auth
// Auth::routes(['verify'=>true]);

// Route for Home page(user side)
Route::get('/home', 'HomeController@index')->name('home');
// Route::match(['get', 'post'],'/home','IndexController@home');;

//Route for Wishlist product
//Route::get('/addtowishlist', 'IndexController@wishlist');


//Route for Middleware after front login
Route::group(['middleware' =>['frontlogin']], function(){
    //Route for Users account / Route for My account(user side)
    Route::match(['get', 'post'], '/account', 'UsersController@account');
    // Route for users change password
    Route::match(['get', 'post'], '/change-password', 'UsersController@changePassword');
    // Route for change address
    Route::match(['get', 'post'], '/change_address', 'UsersController@changeAddress');
    // Route for Checkout
    Route::match(['get', 'post'], '/checkout', 'ProductsController@checkout');
    // Route for Order Review
    Route::match(['get', 'post'], '/order-review', 'ProductsController@orderReview');
    // Route for place order
    Route::match(['get', 'post'], '/place-order', 'ProductsController@placeOrder');
    //Route for after cod option
    Route::get('/thanks', 'ProductsController@thanks');
    //Route for stripe payment
    Route::match(['get', 'post'], '/stripe', 'ProductsController@stripe');
    //Route for view user orders 
    Route::get('/orders', 'ProductsController@userOrders');
    //Route for edit user orders
    Route::get('/orders/{id}', 'ProductsController@userOrdersDetails');
});

// create Middleware (For Admin)
Route::group(['middleware' =>['AdminLogin']], function(){
    Route::match(['get', 'post'], '/admin/dashboard', 'AdminController@dashboard'); //admin login
    Route::match(['get', 'post'], '/admin/user_profile', 'AdminController@changePassword'); //admin chnge pwd

    //Banners route
    Route::match(['get', 'post'], '/admin/banners', 'BannersController@banners');
    Route::match(['get', 'post'], '/admin/add_banner', 'BannersController@addbanner');
    Route::match(['get', 'post'], '/admin/edit_banner/{id}', 'BannersController@editbanner');
    Route::match(['get', 'post'], '/admin/delete_banner/{id}', 'BannersController@deletebanner');
    Route::post('/admin/update_banner_status', 'BannersController@updatestatus');

    //Category Route
    Route::match(['get', 'post'], '/admin/add_category', 'CategoryController@addcategory');
    Route::match(['get', 'post'], '/admin/view_category', 'CategoryController@viewcategories');
    Route::match(['get', 'post'], '/admin/edit_category/{id}', 'CategoryController@editcategory');
    Route::match(['get', 'post'], '/admin/delete_category/{id}', 'CategoryController@deletecategory');
    Route::post('/admin/update_category_status', 'CategoryController@updatestatus');

    //Product Route
    Route::match(['get', 'post'], '/admin/add_product', 'ProductsController@addproduct');
    Route::match(['get', 'post'], '/admin/view_products', 'ProductsController@viewproducts');
    Route::match(['get', 'post'], '/admin/edit_product/{id}', 'ProductsController@editproduct');
    Route::match(['get', 'post'], '/admin/delete_product/{id}', 'ProductsController@deleteproduct');
    Route::post('/admin/update_product_status','ProductsController@updatestatus');
    Route::post('/admin/update_featured_product_status','ProductsController@updateFeatured');

    //Product Attribute(Product size)
    Route::match(['get', 'post'], '/admin/add_attributes/{id}', 'ProductsController@addAttributes');
    Route::get('/admin/delete_attributes/{id}', 'ProductsController@deleteAttributes');
    Route::match(['get', 'post'], '/admin/edit_attributes/{id}', 'ProductsController@editAttributes');

    //coupon code
    Route::match(['get', 'post'],'/admin/add_coupon','CouponsController@addCoupon');
    Route::match(['get', 'post'],'/admin/view_coupons','CouponsController@viewCoupons');
    Route::match(['get', 'post'],'/admin/edit_coupons/{id}','CouponsController@editCoupons');
    Route::match(['get', 'post'],'/admin/delete_coupons/{id}','CouponsController@deleteCoupons');
    Route::match(['get', 'post'],'/admin/update_coupon_status','CouponsController@updateStatus');
    
    //Order Route
    Route::get('/admin/orders','ProductsController@viewOrders'); //order details
    Route::get('/admin/orders/{id}','ProductsController@viewOrderDetails'); //view order details
    Route::get('/admin/orders_invoice/{id}','ProductsController@viewOrderInvoice'); //view order invoice
    Route::post('/admin/update_order_status','ProductsController@updateOrderStatus'); //update order status

    //Customer Route
    Route::get('/admin/customers','ProductsController@viewCustomers'); // view customer
    Route::post('/admin/update_customer_status','ProductsController@updateCustomerStatus'); //update customer status
    Route::match(['get', 'post'],'/admin/delete_customer/{id}','ProductsController@deleteCustomer'); //delete customer 
    
    //Contact us route
    Route::get('/admin/contact','ProductsController@viewContactmsg'); // view contact msg
    //Route::post('/admin/update_contact_status','ProductsController@updateContactStatus'); //update Contact msg status
    Route::match(['get', 'post'],'/admin/delete_contact/{id}','ProductsController@deleteContact'); //delete customer 
});
// Admin logout
Route::get('/logout','AdminController@logout');

// SMTP CODE gijakqfhynozawrz