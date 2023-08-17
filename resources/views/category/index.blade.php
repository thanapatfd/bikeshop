@extends('layouts.master')
@section("title") Bikeshop | รายการประเภทสินค้า @stop
@section('content')
    <div class="contrainer">
    <h1>รายการประเภทสินค้า</h1>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <strong>รายการ</strong>
            </div>
        </div>
        <div class="panel-body">
            {{-- search form --}}
            <form action="{{ URL::to('category/search') }}" method="POST" class="form-inline">
                {{ csrf_field() }}
                <input type="text" name="q" class="form-control" placeholder="พิมพ์รหัสหรือชื่อเพื่อค้นหา">
                <button type="submit" class="btn btn-primary">ค้นหา</button>
                <a href="{{ URL::to('category/edit') }}" class="btn btn-success pull-right"> เพิ่มประเภทสินค้า </a>
            </form>
        </div>

    </div>

    <table class="table table-bordered bs-table">
        <thead>
            <tr>
                <th>ชื่อประเภทสินค้า</th>
                <th>การทำงาน</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $p)
                <tr>
                    <td>{{ $p->name }}</td>

                    <td class="bs-center">
                        <a href="{{ URL::to('category/edit/'.$p->id) }}" class="btn btn-info"><i class="fa fa-edit"> แก้ไข</i></a>
                        <a href="{{ URL::to('category/remove/'.$p->id) }}"onclick="return confirm('คุณต้องการลบประเภทสินค้าหรือไม่?')" class="btn btn-danger btn-delete"><i class="fa fa-trash"> ลบ</i></a>

                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
           
        </tfoot>
    </table>
    <div class="panel-footer">
        <span>แสดงข้อมูลจํานวน {{ count($categories) }} รายการ</span>
    </div>
    {{ $categories->links() }}
</div>




@endsection