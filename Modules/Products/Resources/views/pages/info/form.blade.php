<style>
    .ck-editor__editable {
        min-height: 500px;
    }
</style>
<form method="post" action="{{ $action }}" enctype="multipart/form-data">
    <input name="id" type="hidden" value="{{ $item->id ?? 0 }}">
    @csrf
    <div class="form-group {{ has_error($errors,"introduce") }}">
        <div class="row">
            <div class="col-2">
                <b class="form-text mb-2">Giới thiệu <span class="text-danger">*</span></b>
            </div>
            <div class="col-10">
                <textarea  class="form-control form-control-sm" id="editor" name="introduce" placeholder="Giới thiệu"
                >{{ old_input("introduce",$item ?? []) }}</textarea>
                {!! get_error($errors,"introduce") !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-2"></div>
        <div class="col-10">
            <button type="submit" class="btn btn-primary btn-md">
                <i class="fa-solid fa-filter"></i>
                Lưu
            </button>
        </div>
    </div>
</form>
<script type="text/javascript" src="{{ asset("plugins/ckeditor4/ckeditor.js") }}"></script>
<script >
    var editor = CKEDITOR.replace('editor'
        , {
            filebrowserUploadUrl: '{{ route("api.file.upload", ['_token' => csrf_token() ]) }}',
            filebrowserUploadMethod: 'form',
            extraPlugins: 'image2, ckeditor_wiris',
            image2_disableResizer: true,
            allowedContent: true,
            height: '600px'
        }
    );

</script>