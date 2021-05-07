<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Coupons;

class CouponsController extends Controller
{
    //add coupons
    public function addCoupon(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $coupon = new Coupons;
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['coupon_amount'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expiry_date = $data['expiry_date'];
            $coupon->save();
            return redirect('admin/view_coupons')->with('flash_message_success','Coupons has been added Successfully');
        }
        return view('admin.coupons.add_coupon');
    }

    //view coupons
    public function viewCoupons(){
        $coupons = Coupons::get();
        // echo "<pre>";print_r($coupons);die;
        return view('admin.coupons.view_coupons')->with(compact('coupons'));
    }

    //update coupons status
    public function updateStatus(Request $request,$id=null){
        $data = $request->all();
        Coupons::where('id',$data['id'])->update(['status'=>$data['status']]);
    }

    //edit coupons
    public function editCoupons(Request $request,$id=null){
        if($request->isMethod('post')){
            $data = $request->all();
            $coupon = Coupons::find($id);
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['coupon_amount'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expiry_date = $data['expiry_date'];
            $coupon->save();
            return redirect('admin/view_coupons')->with('flash_message_success','Coupons has been updated Successfully');
        }
        $couponDetails = Coupons::find($id);
        return view('admin.coupons.edit_coupons')->with(compact('couponDetails'));
    }

    //delete coupons
    public function deleteCoupons($id=null) {
        Coupons::where(['id'=>$id])->delete();
        Alert::success('Deleted','Success Message');
        return redirect()->back();
    }
}
