<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Config, Validator;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    var $rp = 2;

    public function index(){
        $products = Product::paginate($this->rp);
        return view('product/index', compact('products'));
    }

    
    public function insert(Request $request){

        $rules = array(
            'code' => 'required', 
            'name' => 'required',
            'category_id' => 'required|numeric',
            'price' => 'numeric',
            'stock_qty' => 'numeric'
        );
        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 
            'numeric' => 'กรุณากรอกข้อมูล:attribute ให้เป็นตัวเลข'
        );

        $id = $request->id;
        $temp = array(
            'code' => $request->code,
            'name' => $request->name,
            'category_id' => $request->category_id, 
            'price' => $request->price,  
            'stock_qty' => $request->stock_qty  
        );
        
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('product/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }

        $product = new Product();
        $product->code = $request->code;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock_qty = $request->stock_qty;

        $product->save();

        //$product->save(); < ถ้าไม่ชัวร์ อย่าเพิ่งพิมพ์ save
        if($request->hasFile('image')) //ไว้เขียนทีหลัง ความสําคัญน้อยกว่า วิธีเอาค่าจากฟอร์ม มาบันทึก
        {
            $f = $request->file('image');
            $upload_to = 'upload/images'; //แปลว่า คุณต้องไปสร้างโฟลเดอร์ชื่อนี้ไว้ในโปรเจคคุณด้วยนะ

            // get path
            $relative_path = $upload_to.'/'.$f->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;
            // upload file
            $f->move($absolute_path, $f->getClientOriginalName());

            // save image path to database
            $product->image_url = $relative_path;
            $product->save(); //< บันทึกลงฐานข้อมูล อย่าเพิ่งพิมพ์จนกว่าจะไม่มี error นะครับ
        }

        return redirect('product')->with('ok',true)
        ->with('msg', ' บันทึกข้อมูลเรียบร้อยเเล้ว ');

    }


    public function search(Request $request){
        $query = $request->q;
        if($query) {
            $products = Product::where('code', 'like', '%'.$query.'%')
            ->orWhere('name', 'like', '%'.$query.'%')
            ->paginate($this->rp);
        }else {
            $products = Product::paginate($this->rp);
        }
        return view('product/index', compact('products'));
    }

    public function edit($id = null){
       $categories = Category::pluck('name', 'id')->prepend('เลือกรายการ', '');
        if($id) {
        // edit view
            $product = Product::where('id', $id)->first(); return view('product/edit')
            ->with('product', $product)
            ->with('categories', $categories);
        } else {
        // add view
            return view('product/add')
            ->with('categories', $categories);
}
    
    }

    public function update(Request $request) {
        

        $rules = array(
            'code' => 'required', 
            'name' => 'required',
            'category_id' => 'required|numeric',
            'price' => 'numeric',
            'stock_qty' => 'numeric'
        );
        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 
            'numeric' => 'กรุณากรอกข้อมูล:attribute ให้เป็นตัวเลข'
        );

        $id = $request->id;
        $temp = array(
            'code' => $request->code,
            'name' => $request->name,
            'category_id' => $request->category_id, 
            'price' => $request->price,  
            'stock_qty' => $request->stock_qty  
        );
        
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('product/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }

        $product = Product::find($id);
        $product->code = $request->code;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock_qty = $request->stock_qty;

        $product->save();
        if($request->hasFile('image')){
            $f = $request->file('image');
            $upload_to = 'upload/images'; //แปลว่า คุณต้องไปสร้างโฟลเดอร์ชื่อนี้ไว้ในโปรเจคคุณด้วยนะ

            // get path
            $relative_path = $upload_to.'/'.$f->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;
            // upload file
            $f->move($absolute_path, $f->getClientOriginalName());

            // save image path to database
            $product->image_url = $relative_path;
            $product->save(); //< บันทึกลงฐานข้อมูล อย่าเพิ่งพิมพ์จนกว่าจะไม่มี error นะครับ
}
        return redirect('product')->with('ok',true)
        ->with('msg', ' บันทึกข้อมูลเรียบร้อยเเล้ว ');
    }
    public function remove($id) {
        Product::find($id)->delete();
        return redirect('product')
        ->with('ok', true)
        ->with('msg', 'ลบข้อมูลสําเร็จ');
    }
}
