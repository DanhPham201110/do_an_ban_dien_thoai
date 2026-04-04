@extends('base::layouts.master')
@section("breadcrumb")
@endsection
@section("css")
    <style>
        .bg-custom {
            background-color: #f8f9fe !important;
        }
    </style>
@endsection
@section("script")
    <script src="{{ asset("plugins/chart-js/chart.min.js") }}"></script>
     <script>
        $(document).ready(function () {
            new Chart(document.getElementById('chartUser'), {
                type: 'line',
                data: {
                    datasets: [{
                        label: 'Số người tạo',
                        data: {!! json_encode($dataChart["dataChartLineAccount"]) !!},
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Thời gian'
                            },
                            ticks: {
                                maxRotation: 360,
                                minRotation: 360,
                                padding: 10,
                                autoSkip: true,
                                maxTicksLimit: 12
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });

            new Chart(document.getElementById('chartTotal'), {
                type: 'line',
                data: {
                    datasets: [{
                        label: 'VNĐ',
                        data: {!! json_encode($dataChart["dataChartLineOrder"]) !!},
                        borderWidth: 1,
                        borderColor: "red",
                        backgroundColor: "red",                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Ngày'
                            },
                            ticks: {
                                maxRotation: 360,
                                minRotation: 360,
                                padding: 10,
                                autoSkip: true,
                                maxTicksLimit: 12
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });

        })
    </script>
@endsection
@section('content')
     <div class="p-3">
        <h1>Thống kê báo cáo</h1>
        <p class="opacity-100">Nơi phân tích dữ liệu</p>
        <form action="" method="get" class="mb-3">
            <div class="form-inline">
                <select name="month" class="form-control form-control-sm">
                    <option value="">-- Chọn tháng --</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option {{ selectedCompareValue((int) ($query["month"] ?? ""), $i) }} value="{{ $i }}">Tháng {{ $i }}</option>
                    @endfor
                </select>
                <select name="year" class="form-control form-control-sm ms-2">
                    <option value="">-- Chọn năm --</option>
                    @for($i = now()->year; $i >= 2022; $i--)
                        <option {{ selectedCompareValue((int) ($query["year"] ?? now()->year), $i) }} value="{{ $i }}">Năm {{ $i }}</option>
                    @endfor
                </select>
                <button type="submit" class="btn btn-primary ms-2">Lọc</button>
            </div>

        </form>
        <div class="">
            <h3>
                Báo cáo tổng quan
            </h3>
            <div class="me-0 ms-0 row">
                <div class="col-md-4">
                    <div class="shadow-lg bg-white p-3">
                        <div class="mb-3">
                            <i class="fa-solid fa-user bg-lighter p-2 rounded-circle"></i>
                        </div>
                        <div class="opacity-75 fs-14px">Người dùng</div>
                        <div class="fs-28px fw-bold">{{ $userCreateInDay ?? 0 }} <span class="fs-12px">người</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="shadow-lg bg-white p-3">
                        <div class="mb-3">
                            <i class="fa-solid fa-clipboard-question bg-lighter p-2 rounded-circle"></i>
                        </div>
                        <div class="opacity-75 fs-14px">Lợi nhuận trong tháng</div>
                        <div class="fs-28px fw-bold">{{ number_format($orderTotalInDay) ?? 0 }} <span class="fs-12px">VNĐ</span></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="shadow-lg bg-white p-3">
                        <div class="mb-3">
                            <i class="fa-brands fa-blogger bg-lighter p-2 rounded-circle"></i>
                        </div>
                        <div class="opacity-75 fs-14px">Blog</div>
                        <div class="fs-28px fw-bold">{{ $blogCreateInDay ?? 0 }} <span class="fs-12px">bài</span></div>
                    </div>
                </div>
            </div>

        </div>
        <div class="mt-5 p-3">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="p-3 bg-white shadow-sm ">
                        <h3>
                            Biểu đồ người dùng
                        </h3>
                        <div class="d-flex justify-content-center align-items-center" style="height: 300px">
                            <canvas id="chartUser"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="p-3 bg-white shadow-sm ">
                        <h3>
                            Biểu đồ lợi nhuận
                        </h3>
                        <div class="d-flex justify-content-center align-items-center" style="height: 300px">
                            <canvas id="chartTotal"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="mt-5">
             <h3>
                 Danh sách sản phẩm bán chạy
             </h3>
             <table class="table ">
                 <thead class="table-light sticky-top top-0">
                 <tr>
                     <th scope="col" width="5%">ID</th>
                     <th scope="col" width="5%" class="text-center">#</th>
                     <th scope="col" width="25%">Sản phẩm</th>
                     <th scope="col" width="10%">Đã bán</th>
                     <th scope="col" width="25%">Giá</th>
                     <th scope="col" width="30%">Mô tả</th>
                     <th scope="col" class="text-center" width="15%">Trạng thái</th>
                     <th scope="col" width="20%">Ngày cập nhật</th>
                 </tr>
                 </thead>
                 <tbody>
                 @if(count($topSellProducts) > 0)
                     @foreach($topSellProducts as $item)
                         <tr>
                             <th scope="row">{{ $item->id }}</th>
                             <td class="text-center">
                                 <div class="dropdown">
                                     <button class="btn btn-sm  btn-secondary dropdown-toggle" type="button"
                                             data-bs-toggle="dropdown" aria-expanded="false">
                                     </button>
                                     <ul class="dropdown-menu">
                                         <li>
                                             <a class="dropdown-item" href="{{ route("get.products.edit", $item->id) }}">
                                                 <i class="fa-regular fa-pen-to-square"></i>
                                                 <span>Sửa</span>
                                             </a>
                                         </li>
                                         <li>
                                             <form method="post" action="{{ route("post.products.delete") }}">
                                                 @csrf
                                                 <input type="hidden" name="id" value="{{ $item->id }}">
                                                 <button type="submit"
                                                         onclick="return confirm('Bạn chắc chắn muốn xóa?')"
                                                         class="dropdown-item">
                                                     <i class="fa-solid fa-trash-can"></i>
                                                     <span>Xóa</span>
                                                 </button>
                                             </form>
                                         </li>
                                     </ul>
                                 </div>
                             </td>
                             <td width="25%">
                                 <b class="d-block">
                                     <a href="">{{ $item->name }}</a>
                                 </b>
                                 <div class="badge badge-info mt-1 fw-bold">
                                     {{ $item->category->name  }}
                                 </div>
                                 <br>
                                 <div class="avatar avatar-lg rounded-circle mt-2  me-2">
                                     <img alt="Image placeholder"
                                          onerror="this.onerror=null;this.src='{{ asset("images/image-default.jpg") }}';"
                                          src="{{ render_url_upload($item->image) }}">
                                 </div>
                             </td>
                             <td class="text-center">{{ $item->number_sell }}</td>
                             <td>
                                 <div class="">
                                     #Giá gốc: {{ number_format($item->price) }}
                                 </div>
                                 <div class="">
                                     #Khuyến mãi: {{ $item->percent_sale }}
                                 </div>
                             </td>
                             <td width="30%" style="white-space: break-spaces !important;">{{ limit_text($item->description, 200) }}</td>
                             <td class="text-center">
                                 @if($item->status)
                                     <span class="badge bg-success">Hiển thị</span>
                                 @else
                                     <span class="badge bg-danger">Không hiển thị</span>
                                 @endif
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
         <div class="mt-5">
             <h3>
                 Danh sách sản phẩm không bán chạy
             </h3>
             <table class="table ">
                 <thead class="table-light sticky-top top-0">
                 <tr>
                     <th scope="col" width="5%">ID</th>
                     <th scope="col" width="5%" class="text-center">#</th>
                     <th scope="col" width="25%">Sản phẩm</th>
                     <th scope="col" width="10%">Đã bán</th>
                     <th scope="col" width="25%">Giá</th>
                     <th scope="col" width="30%">Mô tả</th>
                     <th scope="col" class="text-center" width="15%">Trạng thái</th>
                     <th scope="col" width="20%">Ngày cập nhật</th>
                 </tr>
                 </thead>
                 <tbody>
                 @if(count($topLessSellProducts) > 0)
                     @foreach($topLessSellProducts as $item)
                         <tr>
                             <th scope="row">{{ $item->id }}</th>
                             <td class="text-center">
                                 <div class="dropdown">
                                     <button class="btn btn-sm  btn-secondary dropdown-toggle" type="button"
                                             data-bs-toggle="dropdown" aria-expanded="false">
                                     </button>
                                     <ul class="dropdown-menu">
                                         <li>
                                             <a class="dropdown-item" href="{{ route("get.products.edit", $item->id) }}">
                                                 <i class="fa-regular fa-pen-to-square"></i>
                                                 <span>Sửa</span>
                                             </a>
                                         </li>
                                         <li>
                                             <form method="post" action="{{ route("post.products.delete") }}">
                                                 @csrf
                                                 <input type="hidden" name="id" value="{{ $item->id }}">
                                                 <button type="submit"
                                                         onclick="return confirm('Bạn chắc chắn muốn xóa?')"
                                                         class="dropdown-item">
                                                     <i class="fa-solid fa-trash-can"></i>
                                                     <span>Xóa</span>
                                                 </button>
                                             </form>
                                         </li>
                                     </ul>
                                 </div>
                             </td>
                             <td width="25%">
                                 <b class="d-block">
                                     <a href="">{{ $item->name }}</a>
                                 </b>
                                 <div class="badge badge-info mt-1 fw-bold">
                                     {{ $item->category->name  }}
                                 </div>
                                 <br>
                                 <div class="avatar avatar-lg rounded-circle mt-2  me-2">
                                     <img alt="Image placeholder"
                                          onerror="this.onerror=null;this.src='{{ asset("images/image-default.jpg") }}';"
                                          src="{{ render_url_upload($item->image) }}">
                                 </div>
                             </td>
                             <td class="text-center">{{ $item->number_sell }}</td>
                             <td>
                                 <div class="">
                                     #Giá gốc: {{ number_format($item->price) }}
                                 </div>
                                 <div class="">
                                     #Khuyến mãi: {{ $item->percent_sale }}
                                 </div>
                             </td>
                             <td width="30%" style="white-space: break-spaces !important;">{{ limit_text($item->description, 200) }}</td>
                             <td class="text-center">
                                 @if($item->status)
                                     <span class="badge bg-success">Hiển thị</span>
                                 @else
                                     <span class="badge bg-danger">Không hiển thị</span>
                                 @endif
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
    </div>
@endsection
