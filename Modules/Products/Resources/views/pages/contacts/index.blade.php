@extends('base::layouts.master')
@section("breadcrumb")
{{--    {!! \Diglactic\Breadcrumbs\Breadcrumbs::render("books") !!}--}}
@endsection
@section('content')
    <form method="get" class="form-inline">
        <input type="text" value="{{ form_query("id",$query) }}" name="id" placeholder="Nhập ID"
               class="form-control form-control-sm me-2">
        <input type="text" value="{{ form_query("name",$query) }}" name="name" placeholder="Nhập tên"
               class="form-control form-control-sm me-2">
        <input type="text" value="{{ form_query("number_phone",$query) }}" name="number_phone" placeholder="Nhập số điện thoại"
               class="form-control form-control-sm me-2">
        <input type="text" value="{{ form_query("email",$query) }}" name="email" placeholder="Nhập email"
               class="form-control form-control-sm me-2">
        <div class="">
            <button type="submit" class="btn btn-success btn-md">
                <i class="fa-solid fa-filter"></i>
                Lọc
            </button>
            <a href="{{ route("get.contacts.index") }}" class="btn btn-light ">Xóa lọc</a>
        </div>
    </form>
    <br>
    <div class="">
        <table class="table ">
            <thead class="table-light sticky-top top-0">
            <tr>
                <th scope="col" width="5%">ID</th>
                <th scope="col" width="15%">Họ tên</th>
                <th scope="col" width="25%">Số điện thoại</th>
                <th scope="col" width="25%">Email</th>
                <th scope="col" width="30%">Mô tả</th>
                <th scope="col" width="20%">Ngày tạo</th>
            </tr>
            </thead>
            <tbody>
            @if(count($items) > 0)
                @foreach($items as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>

                        <td>{{ $item->name }}</td>
                        <td>{{ $item->number_phone }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->content }}</td>
                        <td>{{ $item->updated_at }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7">Không có dữ liệu</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
        {!! \Modules\Base\Helpers\Classics\PaginateHelper::paginate($items, $query) !!}
@endsection
