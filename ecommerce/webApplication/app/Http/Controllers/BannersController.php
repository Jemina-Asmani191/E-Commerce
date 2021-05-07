<?php

namespace App\Http\Controllers;

use App\Banners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use RealRashid\SweetAlert\Facades\Alert;
use Image;

class BannersController extends Controller
{
    //view banners
    public function banners(){
        $bannerDetails = Banners::get();
        return view('admin.banner.banners')->with(compact('bannerDetails'));
    }
    //Add banner
    public function addbanner(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $banner = new Banners();
            $banner->name = $data['banner_name'];
            $banner->text_style = $data['text_style'];
            $banner->sort_order = $data['sort_order'];
            $banner->content = $data['banner_content'];
            $banner->link = $data['link'];
            //upload image
            if ($request->hasFile('image')) {
                echo $img_tmp = Input::file('image');
                if ($img_tmp->isValid()) {
                    //image path code
                    $extension = $img_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $banner_path = 'uploads/banners/' . $filename;
                    //image resize
                    Image::make($img_tmp)->resize(500, 500)->save($banner_path);
                    $banner->image = $filename;
                }
            }
            $banner->save();
            return redirect('/admin/banners')->with('flash_message_success','Banners has been updated!!.');
        }
        return view('admin.banner.add_banner');
    }
    //Edit banner
    public function editbanner(Request $request, $id=null){
        if ($request->isMethod('post')) {
            $data = $request->all();
            //upload image
            if ($request->hasFile('image')) {
                echo $img_tmp = Input::file('image');
                if ($img_tmp->isValid()) {
                    //image path code
                    $extension = $img_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $banner_path = 'uploads/banners/' . $filename;
                    //image resize
                    Image::make($img_tmp)->resize(500, 500)->save($banner_path);
                }
            } else if(!empty($data['current_image'])) {
                $filename = $data['current_image'];
            }else{
                $filename='';
            }
            Banners::where(['id' => $id])->update(['name' => $data['banner_name'], 'text_style' => $data['text_style'], 'content' => $data['banner_content'], 'link' => $data['link'], 'sort_order' => $data['sort_order'], 'image' => $filename]);
            return redirect('/admin/banners')->with('flash_message_success', 'Banner has been updated successfully!!.');
        }
        $bannerDetails = Banners::where(['id'=>$id])->first();
        return view('admin.banner.edit_banner')->with(compact('bannerDetails'));
    }

    //delete Banner
    public function deletebanner($id = null)
    {
        Banners::where(['id' => $id])->delete();
        Alert::success('Deleted Banner Successfully', 'Success Message');
        return redirect()->back()->with('flash_message_error', 'Banner has been deleted!!.');
    }

    //Update Banner status code
    public function updatestatus(Request $request, $id = null)
    {
        $data = $request->all();
        Banners::where('id', $data['id'])->update(['status' => $data['status']]);
    }
}
