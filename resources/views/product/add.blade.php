@extends("layouts.master") @section('title') BikeShop | เพิ่มข้อมูลสินค้า @stop
@section('content')
<h1>เพิ่มข้อมูลสินค้า</h1>
<ul class="breadcrumb">
    <li><a href="{{ URL::to('product') }}">หน้าแรก</a></li>
    <li class="active">แก้ไขสินค้า</li>
</ul>

{!! Form::open(array('action' => 'App\Http\Controllers\ProductController@insert','method'=>'post', 'enctype' => 'multipart/form-data')) !!}

<div class="panel panel-default">
  
    <div class="panel-heading">
        <div class="panel-title">
            <strong>ข้อมูลสินค้า</strong>
        </div>
    </div>
    <div class="panel-body">
    
        <table>
            <tr>
            <td>{{ Form::label('code', 'รหัสสินค้า ') }}</td>
            <td>{{ Form::text('code', Request::old('code'), ['class' => 'form-control']) }}</td>
            </tr>
            <tr>
            <td>{{ Form::label('name', 'ชื่อสินค้า ') }}</td>
            <td>{{ Form::text('name', Request::old('name'), ['class' => 'form-control']) }}</td>
            </tr>
            <tr>
            <td>{{ Form::label('category_id', 'ประเภทสินค้า ') }}</td>
            <td>{{ Form::select('category_id', $categories, Request::old('category_id'),
            ['class' => 'form-control']) }}</td>
            </tr>
            
            <tr>
            <td>{{ Form::label('stock_qty', 'คงเหลือ') }}</td>
            <td>{{ Form::text('stock_qty', Request::old('stock_qty'), ['class' => 'form- control']) }}</td>
            </tr>
            
            <tr>
            <td>{{ Form::label('price', 'ราคาขายต่อ หน่วย') }}</td>
            <td>{{ Form::text('price', Request::old('price'), ['class' => 'form-control']) }}</td>
            </tr>
            <tr>
            
            <td>{{ Form::label('image', 'เลือกรูปภาพสินค้า ') }}</td>
            <td>{{ Form::file('image') }}</td>
            </tr>
            
            </table>
    </div>
    
    <br>
    <div class="panel-footer">
    
    <button type="reset" class="btn btn-danger">ยกเลิก</button>
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
    </div>
    </div>
    



{!! Form::close() !!}

@endsection
