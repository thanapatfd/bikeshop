@extends("layouts.master") @section('title') BikeShop | แก้ไขข้อมูลประเภทสินค้า @stop @section('content')
<h1>แก้ไขประข้อมูลสินค้า</h1>
<ul class="breadcrumb">
    <li><a href="{{ URL::to('product') }}">หน้าแรก</a></li>
    <li class="active">แก้ไขข้อมูลประเภทสินค้า</li>
</ul>
{!! Form::model($category, array('action' =>'App\Http\Controllers\CategoryController@insert','method' => 'post', 'enctype'=> 'multipart/form-data')) !!}


<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <strong>เพิ่มข้อมูลประเภทสินค้า</strong>
        </div>
    </div>
    <div class="panel-body">
        <table>
            <tr>
                <tr>
                    <td>{{ Form::label('name', 'ชื่อประเภทสินค้า ') }}</td>
                    <td>{{ Form::text('name', Request::old('name'), ['class' => 'form-control']) }}</td>
                </tr>
            </tr>

            <br />
        </table>
    </div>

    <br />
    <div class="panel-footer">
        <button type="reset" class="btn btn-danger">ยกเลิก</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
    </div>
</div>

{!! Form::close() !!} 
@endsection
