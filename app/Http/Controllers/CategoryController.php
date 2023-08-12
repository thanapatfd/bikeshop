<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Config, Validator;

use Illuminate\Http\Request;

class CategoryController extends Controller
{   
    var $rp = 2;

    public function index(){
        $categories = Category::paginate($this->rp);
        return view('category/index', compact('categories'));
    }

    public function search(Request $request){
        $query = $request->q;
        if($query) {
            $categories = Category::where('name', 'like', '%'.$query.'%')
            ->paginate($this->rp);
        }else {
            $categories = Category::paginate($this->rp);
        }
        return view('category/index', compact('categories'));
    }

    public function edit($id = null){
        $category = Category::find($id);
        return view('category/edit')->with('category', $category);
    
    }

    public function update(Request $request) {
        
        $rules = array(
            'name' => 'required',
        );
        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 
        );

        $id = $request->id;
        $temp = array(
            'name' => $request->name,
        );
        
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('category/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }

        $category = Category::find($id);
        $category->name = $request->name;

        $category ->save();
        
        return redirect('category')->with('ok',true)
        ->with('msg', ' บันทึกข้อมูลเรียบร้อยเเล้ว ');
    }
}
