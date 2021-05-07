<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class CategoryController extends Controller
{
    //add category code
    public function addcategory(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            $category = new Category();
            $category->name = $data['category_name'];
            $category->url = $data['category_url'];
            $category->description = $data['category_description'];
            $category->save();
            return redirect('/admin/view_category')->with('flash_message_success', 'Category added successfully');
        }
        $levels = Category::where(['parent_id'=>0])->get();
        return view('admin.category.add_category')->with(compact('levels'));
    }

    //display or view category code
    public function viewcategories(){
        $categories = Category::get();
        return view('admin.category.view_category')->with(compact('categories'));
    }

    //edit category code
    public function editcategory(Request $request, $id=null){
        if ($request->isMethod('post')) {
            $data = $request->all();
            Category::where(['id' => $id])->update(['name' => $data['category_name'], 'parent_id' => $data['parent_id'], 'description' => $data['category_description'], 'url' => $data['category_url']]);
            return redirect('/admin/view_category')->with('flash_message_success', 'Category updated successfully!!.');
        }
        $levels = Category::where(['parent_id'=>0])->get();
        $categoryDetails = Category::where(['id'=>$id])->first();
        return view('admin.category.edit_category')->with(compact('levels', 'categoryDetails')); 
    }

    //delete category code
    public function deletecategory($id=null){
        Category::where(['id'=>$id])->delete();
        Alert::Success('Deleted', 'Success Message');
        return redirect()->back();
    }

    //Update product status code
    public function updatestatus(Request $request, $id = null)
    {
        $data = $request->all();
        Category::where('id', $data['id'])->update(['status' => $data['status']]);
    }
}
