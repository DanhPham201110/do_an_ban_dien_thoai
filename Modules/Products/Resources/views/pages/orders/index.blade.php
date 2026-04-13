@extends('base::layouts.master')
@section("breadcrumb")
    {{--    {!! \Diglactic\Breadcrumbs\Breadcrumbs::render("books") !!}--}}
@endsection
@section('content')
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ !isset($query["status"])  ? "active" : "" }}" aria-current="page"
               href="{{ route("get.orders.index") }}">Tất cả</a>
        </li>
        @foreach(\Modules\Products\Enums\OrderEnum::ARR_STATUS as $index => $value)
            <li class="nav-item">
                <a href="{{ route("get.orders.index", ['status' => $index]) }}" class="nav-link {{ isset($query["status"]) && $query["status"] == $index ? 'active' : '' }}" aria-current="page" >{{ $value["text"] }}</a>
            </li>
        @endforeach
    </ul>
    <form method="get" class="form-inline">
        <input type="text" value="{{ form_query("id",$query) }}" name="id" placeholder="Nhập ID"
               class="form-control form-control-sm me-2">
        <input type="text" value="{{ form_query("name",$query) }}" name="name" placeholder="Nhập tên"
               class="form-control form-control-sm me-2">
        <select class="form-control form-control-sm me-2" name="status">
            <option value="">--Chọn trạng thái--</option>
            @foreach(\Modules\Products\Enums\OrderEnum::ARR_STATUS as $index => $value)
                <option {{ selectedCompareValue($query["status"] ?? [], $index) }}
                        value="{{ $index }}"> {{ $value["text"] }}
                </option>
            @endforeach
        </select>
        <br>
        <div class="mt-2">
            <button type="submit" class="btn btn-success btn-md">
                <i class="fa-solid fa-filter"></i>
                Lọc
            </button>
            <a href="{{ route("get.orders.index") }}" class="btn btn-light ">Xóa lọc</a>
        </div>
    </form>
    <br>
    <div class="">
        <table class="table ">
            <thead class="table-light sticky-top top-0">
            <tr>
                <th scope="col" width="5%">ID</th>
                <th scope="col" width="5%" class="text-center">#</th>
                <th scope="col" width="25%">Người đặt</th>
                <th scope="col" width="25%">Phương thức</th>
                <th scope="col" width="30%">Tổng tiền</th>
                <th scope="col" class="text-center" width="15%">Trạng thái</th>
                <th scope="col" width="20%">Ngày tạo đơn</th>
            </tr>
            </thead>
            <tbody>
            @if(count($items) > 0)
                @php
                    $status = \Modules\Products\Enums\OrderEnum::ARR_STATUS;
                @endphp
                @foreach($items as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-sm  btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route("get.orders.detail", $item->id) }}"
                                           target="_blank"> <i
                                                    class="fa-solid fa-eye"></i>
                                            Xem chi tiết</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route("get.orders.downloadPDF", $item->id) }}"
                                           target="_blank"> <i
                                                    class="fa-solid fa-download"></i>
                                            Tải hóa đơn</a>
                                    </li>
                                    @if(!in_array($item->status, [-1, 2]))
                                        <li>
                                            <form action="{{ route("post.orders.update") }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <input type="hidden" name="status"
                                                       value="{{ (int) $item->status + 1 }}">
                                                <button type="submit" class="dropdown-item">
                                                    <i class="fa-solid fa-check"></i>
                                                    <span>{{ $status[(int) $item->status + 1]["textBtn"] }}</span>
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route("post.orders.update") }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <input type="hidden" name="status"
                                                       value="{{ \Modules\Products\Enums\OrderEnum::CANCEL }}">
                                                <button type="submit" class="dropdown-item"
                                                        onclick="return confirm('Bạn chắc chắn muốn hủy?')">
                                                    <i class="fa-solid fa-xmark"></i>
                                                    <span>{{ $status[\Modules\Products\Enums\OrderEnum::CANCEL]["textBtn"] }}</span>
                                                </button>
                                            </form>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </td>
                        <td>
                            <div class="">
                                {{ $item->name  }}
                            </div>
                            <div class="fs-12px">
                                #Số điện thoại: {{ $item->number_phone }}
                            </div>
                            <div class="fs-12px">
                                #Địa chỉ: {{ $item->address }}
                            </div>
                        </td>
                        <td>
                            {{ $item->payment }}
                        </td>
                        <td>
                            {{ number_format($item->total) }} VNĐ
                        </td>
                        <td>
                            <span class="{{ $status[$item->status]["class"] }}">{{ $status[$item->status]["text"] }}</span>
                        </td>
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
