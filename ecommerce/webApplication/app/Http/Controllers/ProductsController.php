<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Image;
use Session;
use App\User;
use App\Orders;
use App\Contact;
use App\Country;
use App\Coupons;
use App\Category;
use App\Products;
use App\OrdersProduct;
use App\DeliveryAddress;
use App\ProductsAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use RealRashid\SweetAlert\Facades\Alert;


class ProductsController extends Controller
{
    // add products
    public function addproduct(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>";print_r($data);die;
            $product = new Products();
            $product->category_id = $data['category_id'];
            $product->name = $data['product_name'];
            $product->code = $data['product_code'];
            $product->color = $data['product_color'];
            if(!empty($data['product_description'])){
                $product->description = $data['product_description'];
            }else{
                $product->description = '';
            }
            $product->price = $data['product_price'];
            //upload image
            if($request->hasFile('image')){
                echo $img_tmp = Input::file('image');
                if($img_tmp->isValid()){
                    //image path code
                    $extension = $img_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $img_path = 'uploads/products/' . $filename;
                    //image resize
                    Image::make($img_tmp)->resize(500, 500)->save($img_path);

                    $product->image = $filename;
                }
            }
            $product->save();
            return redirect('/admin/view_products')->with('flash_message_success', 'Product has been added successfully');
        }
        // categories drop down menu code
        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option value='' selected disabled>Select</option>";
        foreach($categories as $cat){
            $categories_dropdown .= "<option value='" .$cat->id."'>".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                $categories_dropdown .= "<option value='" .$sub_cat->id."'>&nbsp;--&nbsp".$sub_cat->name."</option>";
            }
        } 
        return view('admin.products.add_product')->with(compact('categories_dropdown'));
    }

    // view products
    public function viewproducts(){
        $products = Products::get();
        return view('admin.products.view_products')->with(compact('products'));
    }

    // edit products
    public function editproduct(Request $request, $id=null){
        if ($request->isMethod('post')) {
            $data = $request->all();
            //upload image
            if ($request->hasFile('image')) {
                echo $img_tmp = Input::file('image');
                if ($img_tmp->isValid()) {
                    //image path code
                    $extension = $img_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $img_path = 'uploads/products/' . $filename;
                    //image resize
                    Image::make($img_tmp)->resize(500, 500)->save($img_path);
                }
            }else{
                $filename = $data['current_image'];
            }
            if(empty($data['product_description'])){
                $data['product_description'] = '';
            }
            Products::where(['id'=>$id])->update(['name'=>$data['product_name'],'category_id'=>$data['category_id'],'code'=>$data['product_code'],'color'=>$data['product_color'],'description'=>$data['product_description'],'price'=>$data['product_price'],'image'=>$filename]);
            return redirect('/admin/view_products')->with('flash_message_success','Product has been updated successfully!!.');
        }
        $productDetails = Products::where(['id'=>$id])->first();

        //category dropdown code
        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option value='' selected disabled>Select</option>";
        foreach($categories as $cat){
            if($cat->id == $productDetails->category_id){
                $selected = 'selected';
            }else{
                $selected = '';
            }
            $categories_dropdown .= "<option value='".$cat->id."' ".$selected.">".$cat->name ."</option>";
        }
        //code for sub categories
        $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
        foreach ($sub_categories as $sub_cat) {
            if ($cat->id == $productDetails->category_id) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            $categories_dropdown .= "<option value='" . $sub_cat->id . "' " . $selected . ">&nbsp;--&nbsp" . $sub_cat->name . "</option>";
        }
        return view('admin.products.edit_product')->with(compact('productDetails', 'categories_dropdown'));
    }

    //delete product
    public function deleteproduct($id=null){
        Products::where(['id'=>$id])->delete();
        Alert::success('Deleted Successfully', 'Success Message');
        return redirect()->back()->with('flash_message_error', 'Product has been deleted!!.');
    }

    //Update product status code
    public function updatestatus(Request $request, $id=null){
        $data = $request->all();
        Products::where('id',$data['id'])->update(['status'=>$data['status']]);
    }

    //user product detail
    public function products($id=null){
        $productDetails = Products::with('attributes')->where('id',$id)->first();
        $featuredProducts = Products::where(['featured_products'=>1])->get();
        // echo $productDetails;die;
        return view('ecommerce.product_detail')->with(compact('productDetails','featuredProducts'));
    }

    //add size product attribute
    public function addAttributes(Request $request, $id=null){
        $productDetails = Products::with('attributes')->where(['id'=>$id])->first();
        //  echo "<pre>";print_r($productDetails);die;
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            foreach($data['sku'] as $key=>$val){
                if(!empty($val)){
                    //Prevent Duplicate SKU Record
                    $attrCountSKU = ProductsAttribute::where('sku',$val)->count();
                    if($attrCountSKU > 0){
                        // echo "<pre>";print_r($val);die;
                        return redirect('/admin/add_attributes/'.$id)->with('flash_message_error','SKU is already exist please select another SKU');
                    }
                    // echo "<pre>";print_r($attrCountSKU);die;
                    // Prevent Duplicate SIZE Record
                    $attrCountSIZE = ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($attrCountSIZE > 0){
                        return redirect('/admin/add_attributes/'.$id)->with('flash_message_error',''.$data['size'][$key].'SIZE is already exist please select another SIZE');
                    }
                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }
            }
            return redirect('/admin/add_attributes/'.$id)->with('flash_message_success','Product attribute added successfully!');
        }
        return view('admin.products.add_attributes')->with(compact('productDetails'));
    }

    //delete size product attribute
    public function deleteAttributes($id=null){
        ProductsAttribute::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_error','Product Attribute is deleted!');
    }

    //edit size product attribute
    public function editAttributes(Request $request,$id=null){
        if($request->isMethod('post')){
            $data = $request->all();
            foreach($data['attr'] as $key=>$attr){
                ProductsAttribute::where(['id'=>$data['attr'][$key]])->update(['sku'=>$data['sku'][$key],'size'=>$data['size'][$key],'price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]); 
                //  echo "<pre>";print_r($productsAttribute);die;
            }
            return redirect()->back()->with('flash_message_success','Product Attribute is updated!!!');
        }
    }

    //update featured product status code
    public function updateFeatured(Request $request, $id=null){
        $data = $request->all();
        Products::where('id',$data['id'])->update(['featured_products'=>$data['status']]);
    }

    //get product price
    public function getprice(Request $request){
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        $proArr = explode("-",$data['idSize']);
        $proAttr = ProductsAttribute::where(['product_id'=>$proArr[0],'size'=>$proArr[1]])->first();
        echo $proAttr->price;
    }

    //add to cart
    public function addtocart(Request $request){
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        if(empty(Auth::user()->email)){
            $data['user_email'] = '';
        }else{
            $data['user_email'] = Auth::user()->email;
        }

        $session_id = Session::get('session_id');
        // $session_id = 'ZhOdZxiMltPnaHe2p9xfiQMffocgwyPKGDXZYy74';

        if(empty($session_id)){
            $session_id = str_random(40);
            Session::put('session_id',$session_id);
        }
        
        $sizeArr = explode('-',$data['size']);

        $countProducts = DB::table('cart')->where(['product_id'=>$data['product_id'],'product_color'=>$data['product_color'],'price'=>$data['price'],'size'=>$sizeArr[1],'session_id'=>$session_id])->count();
        
        if($countProducts > 0){
            return redirect()->back()->with('flash_message_error','Products already exists in cart!');    
        }else{    
            DB::table('cart')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],'product_color'=>$data['product_color'],'price'=>$data['price'],'size'=>$sizeArr[1],'quantity'=>$data['quantity'],'user_email'=>$data['user_email'],'session_id'=>$session_id]);
        }
        return redirect('/cart')->with('flash_message_success','Products has been added in cart');
    }

    //cart
    public function cart(Request $request){
        if(Auth::check()){
            $user_email = Auth::user()->email;
            // echo $user_email;die;
            $usercart = DB::table('cart')->where(['user_email'=>$user_email])->get();
        }else{
            $session_id = Session::get('session_id');
            // echo $session_id;die;
            $usercart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        }
        foreach($usercart as $key=>$products){
            $productDetails = Products::where(['id'=>$products->product_id])->first();
            $usercart[$key]->image = $productDetails->image;
        }
        // echo "<pre>";print_r($usercart);die;
        return view('ecommerce.products.cart')->with(compact('usercart')); 
    }

    //delete product cart 
    public function deleteCartProduct($id=null){
        // echo $id;die;
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        DB::table('cart')->where('id',$id)->delete();
        return redirect('/cart')->with('flash_message_error','Products has been deleted!');
    }

    //update cart Quantity
    public function updateCartQuantity($id=null,$quantity=null){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
        return redirect('/cart')->with('flash_message_success','Products Quantity updated has been Successfully');
    }

    //apply coupon
    public function applyCoupon(Request $request){
        // Session::forget('CouponAmount');
        // Session::forget('CouponCode');
        if($request->isMethod('POST')){
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            $couponCount = Coupons::where('coupon_code',$data['coupon_code'])->count();
            if($couponCount == 0){
                return redirect()->back()->with('flash_message_error','Coupon Code does not exist');
            }else{
                // echo "success";die;
                $couponDetails = Coupons::where('coupon_code',$data['coupon_code'])->first();
                
                //coupon code status
                if($couponDetails->status == 0){
                    return redirect()->back()->with('flash_message_error','Coupon code is not active');
                }

                //check coupon expiry date
                $expiry_date = $couponDetails->expiry_date;
                $current_date = date('Y-m-d');
                if($expiry_date < $current_date){
                    return redirect()->back()->with('flash_message_error','Coupon code is Expired');
                }

                //coupon is ready for discount
                $session_id = Session::get('session_id');
                
                if(Auth::check()){
                    $user_email = Auth::user()->email;
                    $usercart = DB::table('cart')->where(['user_email'=>$user_email])->get();
                }else{
                    $session_id = Session::get('session_id');
                    $usercart = DB::table('cart')->where(['session_id'=>$session_id])->get();
                }
                $total_amount = 0;

                foreach($usercart as $item){
                    $total_amount = $total_amount + ($item->price * $item->quantity);
                }

                //check if coupon amount is fixed or percentage
                if($couponDetails->amount_type == "Fixed"){
                    $couponAmount = $couponDetails->amount;
                    $coupon = intval($couponAmount);
                } else {
                    $couponAmount = $total_amount * ($couponDetails->amount/100);
                    $coupon = intval($couponAmount);
                }

                //add coupon code in session
                Session::put('CouponAmount', $coupon);
                Session::put('CouponCode', $data['coupon_code']);
                return redirect()->back()->with('flash_message_success', 'Coupon code is Successfully Applied. You are Availing Discount');
            }
        }
    }
    // checkout
    public function checkout(Request $request){
        $user_id =Auth::user()->id;
        $user_email =Auth::user()->email;
        $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        $userDetails = User::find($user_id);
        $countries = Country::get();
        // check if shipping address exist
        $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
        $shippingDetails = array();
        if($shippingCount > 0){
            $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        }
        //update cart table with email
        // $session_id = Session::get('session_id');
        // DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);

        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>";print_r($data);die;
            // Update User details
            User::where('id',$user_id)->update(['name'=>$data['billing_name'],'address'=>$data['billing_address'],'city'=>$data['billing_city'],'state'=>$data['billing_state'],'country'=>$data['billing_country'],'pincode'=>$data['billing_pincode'],'mobile'=>$data['billing_mobile']]);
            if($shippingCount > 0){
                // Update shipping Address
                DeliveryAddress::where('user_id',$user_id)->update(['name'=>$data['shipping_name'],'address'=>$data['shipping_address'],'city'=>$data['shipping_city'],'state'=>$data['shipping_state'],'country'=>$data['shipping_country'],'pincode'=>$data['shipping_pincode'],'mobile'=>$data['shipping_mobile']]);
            }else{
                // new shipping Address
                $shipping = new DeliveryAddress;
                $shipping->user_id = $user_id;
                $shipping->user_email = $user_email;
                $shipping->name = $data['shipping_name'];
                $shipping->address = $data['shipping_address'];
                $shipping->city = $data['shipping_city'];
                $shipping->state = $data['shipping_state'];
                $shipping->country = $data['shipping_country'];
                $shipping->pincode = $data['shipping_pincode'];
                $shipping->mobile = $data['shipping_mobile'];
                $shipping->save();
            }
            return redirect()->action('ProductsController@orderReview');
        }
        return view('ecommerce.products.checkout')->with(compact('userDetails','countries','shippingDetails'));
    }
    public function orderReview(){
        $user_id =Auth::user()->id;
        $user_email =Auth::user()->email;
        $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        $userDetails = User::find($user_id);
        $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
        foreach($userCart as $key=>$product){
            $productDetails = Products::where('id',$product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }
        return view('ecommerce.products.order_review')->with(compact('userDetails','shippingDetails','userCart'));
    }
    public function placeOrder(Request $request){
        if($request->isMethod('post')){
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;
            $data =$request->all();

            // get shipping details of users
            $shippingDetails = DeliveryAddress::where(['user_email'=>$user_email])->first();
            //echo "<pre>";print_r($shippingDetails);die;
            //echo "<pre>";print_r($data);die;
            if(empty(Session::get('CouponCode'))){
                $coupon_code = 'Not Used';
            }else{
                $coupon_code = Session::get('CouponCode');
            }
            if(empty(Session::get('CouponAmount'))){
                $coupon_amount = '0';
            }else{
                $coupon_amount = Session::get('CouponAmount');
            }
            $orders = new Orders;
            $orders->user_id = $user_id;
            $orders->user_email = $user_email;
            $orders->name = $shippingDetails->name;
            $orders->address = $shippingDetails->address;
            $orders->city = $shippingDetails->city;
            $orders->state = $shippingDetails->state;
            $orders->country = $shippingDetails->country;
            $orders->pincode = $shippingDetails->pincode;
            $orders->mobile = $shippingDetails->mobile;
            $orders->coupon_code = $coupon_code;
            $orders->coupon_amount = $coupon_amount;
            $orders->order_status = "New";
            $orders->payment_method = $data['payment_method'];
            $orders->grand_total = $data['grand_total'];
            $orders->save();

            $order_id = DB::getPdo()->lastinsertID();
            
            $cartProducts = DB::table('cart')->where(['user_email'=>$user_email])->get();

            foreach($cartProducts as $pro){
                $cartPro = new OrdersProduct;
                $cartPro->order_id = $order_id;
                $cartPro->user_id = $user_id;
                $cartPro->product_id = $pro->product_id;
                $cartPro->product_code = $pro->product_code;
                $cartPro->product_name = $pro->product_name;
                $cartPro->product_color = $pro->product_color;
                $cartPro->product_size = $pro->size;
                $cartPro->product_price = $pro->price;
                $cartPro->product_qty = $pro->quantity;
                $cartPro->save();
            }
            Session::put('order_id',$order_id);
            Session::put('grand_total',$data['grand_total']);

            if($data['payment_method'] == "cod"){
                //send email for cod
                $productDetails = Orders::with('orders')->where('id',$order_id)->first();
                $productDetails = json_decode(json_encode($productDetails),true);
                // echo "<pre>";print_r($productDetails);die;
                $userDetails = User::where('id',$user_id)->first();
                $userDetails = json_decode(json_encode($userDetails),true);
                
                $email = $user_email;
                $messageData = [
                    'email' => $email,
                    'name' => $shippingDetails->name,
                    'order_id' => $order_id,
                    'productDetails' => $productDetails,
                    'userDetails' => $userDetails,
                ];
                Mail::send('ecommerce.email.cod',$messageData, function($message) use($email){
                    $message->to($email)->subject('Your Ecommerce Order is Placed');
                });
                return redirect('/thanks');
            }else{
                return redirect('/stripe');
            }
        }
    } 
    //thanks page after cod option
    public function thanks() {
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();
        Session::forget('CouponAmount');
        return view('ecommerce.orders.thanks');
    }
    //stripe payment method
    public function stripe(Request $request){
        Session::forget('CouponAmount');
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            \Stripe\Stripe::setApiKey('sk_test_51IbfznSD3DwIKFuRps5r2QIPGGaSP2d1AyYl0lm3i8aBxEJQhbGB1suZ1MFuBO0JMisOVZgshecrfb79gui53fXh0020gjh0b1');

            $token = $_POST['stripe-token'];
            $charge = \Stripe\charge::Create([
                'amount' =>$request->input('total_amount')*100,
                'currency' => 'inr',
                'description' => $request->input('name'),
                // 'description' => 'Software development services',
                'source' => $token,
            ]);
            //dd($charge);
            // echo "<pre>";print_r($token);die;
            return redirect()->back()->with('flash_message_success','Your Payment Successfully Done!');
        }
        return view('ecommerce.orders.stripe');
    }
    //view user orders
    public function userOrders(){
        $user_id = Auth::user()->id;
        $orders = Orders::with('orders')->where('user_id',$user_id)->orderBy('id','DESC')->get();
        // echo "<pre>";print_r($orders);die;
        return view('ecommerce.orders.user_orders')->with(compact('orders'));
    }
    //edit user orders
    public function userOrdersDetails($order_id){
        $orderDetails = Orders::with('orders')->where('id',$order_id)->first();
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        return view('ecommerce.orders.user_order_details')->with(compact('orderDetails','userDetails'));
    }
    //view admin orders
    public function viewOrders(){
        $orders = Orders::with('orders')->orderBy('id','DESC')->get();
        return view('admin.orders.view_orders')->with(compact('orders'));
    }
    //view order userDetails
    public function viewOrderDetails($order_id){
        $orderDetails = Orders::with('orders')->where('id',$order_id)->first();
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        return view('admin.orders.view_order_details')->with(compact('orderDetails','userDetails'));
    }
    //update order status
    public function updateOrderStatus(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
        }
        Orders::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
        return redirect()->back()->with('flash_message_success','Order Status has been updated Successfully!');
    }
    //view customers
    public function viewCustomers(){
        $userDetail = User::get();
        return view('admin.users.customers')->with(compact('userDetail'));
    }
    //update customer status
    public function updateCustomerStatus(Request $request,$id=null){
        $data = $request->all();
        User::where('id',$data['id'])->update(['status'=>$data['status']]);
        // return view('admin.users.customers')->with(compact('userDetail'));
    }
    //delete customer record
    public function deleteCustomer($id=null){
        User::where(['id' => $id])->delete();
        Alert::success('Deleted Successfully', 'Success');
        return redirect()->back();
    }
    //view order invoice
    public function viewOrderInvoice($order_id){
        $orderDetails = Orders::with('orders')->where('id',$order_id)->first();
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        return view('admin.orders.orders_invoice')->with(compact('orderDetails','userDetails'));
    }
    //about us
    public function aboutUs(){
        return view('ecommerce.about-us');
    }
    //Contact us messages
    public function viewContactmsg(){
        $contactDetails = Contact::get();
        return view('admin.contact')->with(compact('contactDetails'));
    }
    //update Contact us status
    // public function updateContactStatus(Request $request,$id=null){
    //     $data = $request->all();
    //     Contact::where('id',$data['id'])->update(['status'=>$data['status']]);
    // }
    //delete Contact record
    public function deleteContact($id=null){
        Contact::where(['id' => $id])->delete();
        Alert::success('Deleted Successfully', 'Success');
        return redirect()->back();
    }
}
