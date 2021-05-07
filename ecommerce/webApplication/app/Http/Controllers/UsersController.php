<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Country;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use DB;



class UsersController extends Controller
{
    public function userLoginRegister(){
        return view('ecommerce.users.login_register');
    }
    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            $userCount = User::where('email',$data['email'])->count();
            if($userCount>0){
                return redirect()->back()->with('flash_message_error','Email is already exists');
            }else{
                // adding user in table
                $user = new User;
                $user->name =$data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();

                //confirmation Email
                $email = $data['email'];
                $messageData = ['email'=>$data['email'],'name'=>$data['name'],'code'=>base64_encode($data['email'])];
                
                // echo "<pre>";print_r($messageData);die;
                Mail::send('ecommerce.email.confirm',$messageData, function($message) use($email){
                    $message->to($email)->subject('Account Activation For Ecommerce');
                });
                return redirect()->back()->with('flash_message_error','Please Confirm Your Email To Activate Your Account');

                if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                    Session::put('frontSession', $data['email']);
                    if(!empty(Session::get('session_id'))){
                        $session_id = Session::get('session_id');
                        DB::table('cart'->where('session_id',$session_id))->update(['email'=>$data['email']]);
                    }
                    // return redirect('/');
                    return redirect()->back()->with('flash_message_success','Registration has been Successfully!!');
                }
            }
        }
    }
    
    //confirm email activation
    public function confirmAccount($email){
        $email = base64_decode($email);
        $userCount = User::where(['email'=>$email])->count();
        if($userCount > 0){
            $userDetail = User::where(['email'=>$email])->first();
            if($userDetail->status == 1){
                return redirect('login-register')->with('flash_message_error','Your Account is already activated. You can simply login now.');
            }else{
                User::where(['email'=>$email])->update(['status'=>1]);
                //Send Welcome Registration to User Email
                $messageData = ['email'=>$email,'name'=>$userDetail->name];
                // echo "<pre>";print_r($messageData);die;
                Mail::send('ecommerce.email.welcome',$messageData, function($message) use($email){
                    $message->to($email)->subject('Welcome To Ecommerce Store');
                });
                return redirect('login-register')->with('flash_message_success','Congrats! Your Account is Now Activated.');
            }
        } else{
            abort(404);
        }
    }

    public function logout(){
        Session::forget('frontSession');
        Session::forget('session_id');
        Auth::logout();
        return redirect('/');
    }
    public function login(Request $request){
        if($request->isMethod('post')){
                $data = $request->all();
            // echo "<pre>";print_r($data);die;
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                $userStatus = User::where(['email'=>$data['email']])->first();
                if($userStatus->status == 0){
                    return redirect()->back()->with('flash_message_error','Your Account is not activated ! Please confirm your email to activate your Account.');
                }
                Session::put('frontSession', $data['email']);
                if(!empty(Session::get('session_id'))){
                    $session_id = Session::get('session_id');
                    // echo $session_id;die;
                    DB::table('cart'->where('session_id',$session_id))->update(['email'=>$data['user_email']]);
                }
                return redirect('/cart');
            }else{
                return redirect()->back()->with('flash_message_error','Invalid Username and password');
            }
        }
    }
    public function account(Request $request){
        return view('ecommerce.users.account');
    }
    public function changePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $old_pwd = User::where('id',Auth::User()->id)->first();
            $current_password = $data['current_password'];
            if(Hash::check($current_password,$old_pwd->password)){
                $new_pwd = bcrypt($data['new_pwd']);
                User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
                return redirect()->back()->with('flash_message_success','Your Password is Changed now Successfully!!');
            }else{
                return redirect()->back()->with('flash_message_error','Old Password is Incorrect!!');
            }
        }
        return view('ecommerce.users.change_password');
    }
    public function changeAddress(Request $request){
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        //echo "<pre>";print_r($userDetails);die;
        if($request->isMethod('post')){
            $data = $request->all();
            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city']; 
            $user->state = $data['state'];
            $user->country = $data['country']; 
            $user->pincode = $data['pincode'];   
            $user->mobile = $data['mobile'];
            $user->save();
            return redirect()->back()->with('flash_message_success','Account details has been updated successfully!!');
        }
        $countries = Country::get();
        return view('ecommerce.users.change_address')->with(compact('countries','userDetails'));
    }
}
