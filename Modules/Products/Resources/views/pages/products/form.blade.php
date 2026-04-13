<form method="post" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    <h3>Thông tin cơ bản</h3>
    <div class="form-group {{ has_error($errors,"name") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Tiêu đề <span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <input class="form-control form-control-sm" name="name" type="text" placeholder="Nhập tên sản phẩm"
                       value="{{ old_input("name",$item ?? []) }}">
                {!! get_error($errors,"name") !!}
            </div>
        </div>
    </div>
    <div class="form-group {{ has_error($errors,"image") }}">
        <div class="row">
            <div class="col-lg-2 col-sm-12">
                <b class="form-text mb-2">Ảnh</b>
            </div>
            <div class="col-lg-10 col-sm-12">
                <label class="btn btn-success" for="image">
                    Chọn ảnh
                </label>
                <input class="form-control form-control-sm hide" id="image" name="image"
                       type="file"
                       onchange="document.getElementById('img-preview').src = window.URL.createObjectURL(this.files[0])"
                       value="">
                <br>
                <img id="img-preview" alt="your image" class=""
                     onerror="this.onerror=null;this.src='{{ asset("images/image-default.jpg") }}';"
                     src="{{ render_url_upload($item->image ?? "") }}" width="250" height="200">

            </div>
        </div>
    </div>
    @if($type != "create")
        <input type="hidden" name="id" value="{{ $item->id }}">
    @endif

    <div class="form-group {{ has_error($errors,"amount") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Số lượng<span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <input type="number" class="form-control" name="amount" value="{{ $item->amount ?? 1 }}"
                       placeholder="Nhập số tiền gốc">
                {!! get_error($errors,"amount") !!}
            </div>
        </div>
    </div>
    <div class="form-group {{ has_error($errors,"price") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Giá tiền gốc<span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <input type="number" class="form-control" name="price" value="{{ $item->price ?? 0 }}"
                       placeholder="Nhập số tiền gốc">
                {!! get_error($errors,"price") !!}
            </div>
        </div>
    </div>
    <div class="form-group {{ has_error($errors,"percent_sale") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Giảm giá<span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <input type="number" class="form-control" name="percent_sale" value="{{ $item->percent_sale ?? 0 }}"
                       placeholder="Nhập số tiền gốc">
                {!! get_error($errors,"percent_sale") !!}
            </div>
        </div>
    </div>

    <div class="form-group {{ has_error($errors,"category_id") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Danh mục <span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <select class="form-control form-control-sm" name="category_id">
                    <option value="">--Chọn danh mục--</option>
                    @foreach($categories as $category)
                        <option
                                {{ old_selected("category_id",$item ?? [] , $category->id) }}
                                value="{{ $category->id }}">{{ $category->name }}
                        </option>
                    @endforeach
                </select>
                {!! get_error($errors,"category_id") !!}
            </div>
        </div>
    </div>
    <div class="form-group {{ has_error($errors,"description") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Mô tả <span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <textarea class="form-control form-control-sm editor" name="description" placeholder="Mô tả"
                >{{ old_input("description",$item ?? []) }}</textarea>
                {!! get_error($errors,"description") !!}
            </div>
        </div>
    </div>
    <div class="form-group {{ has_error($errors,"status") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Trạng thái <span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <select class="form-control form-control-sm" name="status">
                    <option value="">--Chọn trạng thái--</option>
                    @foreach(\Modules\Products\Enums\ProductEnum::ARR_STATUS as $index => $value)
                        <option
                                {{ old_selected("status", $item ?? [], $index) }}
                                value="{{ $index }}">{{ $value }}
                        </option>
                    @endforeach
                </select>
                {!! get_error($errors,"status") !!}
            </div>
        </div>
    </div>
    <hr>
    <h3>Thông tin chi tiết</h3>
    <div class="form-group {{ has_error($errors,"screen_size") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Kích thước màn hình <span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <input type="number" class="form-control form-control-sm" name="screen_size"
                       value="{{ old_input("screen_size",$item ?? []) }}" placeholder="Like 7 inch">
                {!! get_error($errors,"screen_size") !!}
            </div>
        </div>
    </div>
    <div class="form-group {{ has_error($errors,"screen_features") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Tính năng màn hình <span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <textarea class="form-control form-control-sm" name="screen_features"
                          placeholder="Nhập tính năng màn hình"
                >{{ old_input("screen_features",$item ?? []) }}</textarea>
                {!! get_error($errors,"screen_features") !!}
            </div>
        </div>
    </div>
    <div class="form-group {{ has_error($errors,"scanning_frequency") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Tần số quét <span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <input type="number" class="form-control form-control-sm" name="scanning_frequency"
                       value="{{ old_input("scanning_frequency",$item ?? []) }}" placeholder="Like 120hz">
                {!! get_error($errors,"scanning_frequency") !!}
            </div>
        </div>
    </div>
    <div class="form-group {{ has_error($errors,"rear_camera") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Camera sau <span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <textarea class="form-control form-control-sm" name="rear_camera"
                          placeholder="Nhập thông tin camera sau"
                >{{ old_input("rear_camera",$item ?? []) }}</textarea>
                {!! get_error($errors,"rear_camera") !!}
            </div>
        </div>
    </div>
    <div class="form-group {{ has_error($errors,"video") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Quay video <span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <textarea class="form-control form-control-sm" name="video" placeholder="Nhập thông tin quay video"
                >{{ old_input("video",$item ?? []) }}</textarea>
                {!! get_error($errors,"video") !!}
            </div>
        </div>
    </div>
    <div class="form-group {{ has_error($errors,"front_camera") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Camera trước <span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <textarea class="form-control form-control-sm" name="front_camera"
                          placeholder="Nhập thông tin camera trước"
                >{{ old_input("front_camera",$item ?? []) }}</textarea>
                {!! get_error($errors,"front_camera") !!}
            </div>
        </div>
    </div>
    <div class="form-group {{ has_error($errors,"chipset") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Chipset <span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <textarea class="form-control form-control-sm" name="chipset" placeholder="Nhập thông tin chipset"
                >{{ old_input("chipset",$item ?? []) }}</textarea>
                {!! get_error($errors,"chipset") !!}
            </div>
        </div>
    </div>
    <div class="form-group {{ has_error($errors,"ram") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Ram <span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <select class="form-control form-control-sm" name="ram">
                    <option value="">--Ram--</option>
                    @foreach(\Modules\Products\Enums\ProductEnum::ARR_RAM as $value => $ram )
                        <option
                                {{ old_selected("ram",$item ?? [] , $value) }}
                                value="{{ $value }}">{{ $ram }}
                        </option>
                    @endforeach
                </select>
                {!! get_error($errors,"ram") !!}
            </div>
        </div>
    </div>
    <div class="form-group {{ has_error($errors,"memory") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Bộ nhớ trong <span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <select class="form-control form-control-sm" name="memory">
                    <option value="">--Bộ nhớ trong--</option>
                    @foreach(\Modules\Products\Enums\ProductEnum::ARR_STORAGE as $value => $memory )
                        <option
                                {{ old_selected("memory",$item ?? [] , $value) }}
                                value="{{ $value }}">{{ $memory }}
                        </option>
                    @endforeach
                </select>
                {!! get_error($errors,"memory") !!}
            </div>
        </div>
    </div>
    <div class="form-group {{ has_error($errors,"battery") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Dung lượng pin <span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <input type="number" class="form-control form-control-sm" name="battery"
                       value="{{ old_input("battery",$item ?? []) }}"
                       placeholder="Nhập dung lượng pin">
                {!! get_error($errors,"battery") !!}
            </div>
        </div>
    </div>
{{--    <div class="form-group {{ has_error($errors,"size") }}">--}}
{{--        <div class="row">--}}
{{--            <div class="col-2">--}}
{{--                <b class="form-text mb-2">Kích thước màn hình <span class="text-danger">*</span></b>--}}
{{--            </div>--}}
{{--            <div class="col-10">--}}
{{--                <input type="text" class="form-control form-control-sm" name="size"--}}
{{--                       value="{{ old_input("size",$item ?? []) }}"--}}
{{--                       placeholder="Nhập kích thước màn hình">--}}
{{--                {!! get_error($errors,"size") !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="form-group {{ has_error($errors,"weight") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Trọng lượng <span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <input type="number" class="form-control form-control-sm" name="weight"
                       value="{{ old_input("weight",$item ?? []) }}"
                       placeholder="Nhập trọng lượng">
                {!! get_error($errors,"weight") !!}
            </div>
        </div>
    </div>
    <div class="form-group {{ has_error($errors,"special_features") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Tính năng đặc biệt <span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <textarea class="form-control form-control-sm" name="special_features"
                          placeholder="Nhập tính năng đặc biệt"
                >{{ old_input("special_features",$item ?? []) }}</textarea>
                {!! get_error($errors,"special_features") !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Sau khi lưu</b>
            </div>
            <div class="col-10 form-inline">
                <div class="form-check">
                    <input class="form-check-input" name="rdo_option" checked type="radio" value="0" id="continuce">
                    <label class="form-check-label ms-1" for="continuce">
                        Tiếp tục
                    </label>
                </div>
                <div class="form-check ms-3">
                    <input class="form-check-input" name="rdo_option" type="radio" value="1" id="returnList">
                    <label class="form-check-label ms-1" for="returnList">
                        Trở về danh sách
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-10">
            @if($type == "create")
                <button type="submit" class="btn btn-primary btn-md">
                    <i class="fa-solid fa-filter"></i>
                    Thêm
                </button>
            @else
                <button type="submit" class="btn btn-primary btn-md">
                    <i class="fa-solid fa-filter"></i>
                    Cập nhật
                </button>
            @endif

            <a href="{{ route("get.products.index") }}" class="btn btn-light "><i
                        class="fa-solid fa-rotate-left"></i> Trở
                về danh sách</a>
        </div>
    </div>
</form>
<script type="text/javascript" src="{{ asset("plugins/ckeditor4/ckeditor.js") }}"></script>
<script>
    document.querySelectorAll('.editor').forEach(element => {
        CKEDITOR.replace(element, {
            filebrowserUploadUrl: '{{ route("api.file.upload", ["_token" => csrf_token() ]) }}',
            filebrowserUploadMethod: 'form',
            extraPlugins: 'image2, ckeditor_wiris',
            image2_disableResizer: true,
            allowedContent: true,
        });
    });


</script>