@extends('sell::layouts.master')
@section("title",$item->title)
@section("css")
    <link rel="stylesheet" href='{{ asset("plugins/nice-select2/nice-select2.css") }}'>
    <style>

    </style>
@stop
@section("script")
    <script src="{{ asset("plugins/nice-select2/nice-select2.js") }}"></script>
    <script>
        var options = {searchable: true};
        NiceSelect.bind(document.getElementById("seachable-select"), options);
    </script>
@stop
@section('content')
    <div class="container content">
        <div class="row mt-4">
            <div class="col-lg-8 mb-3">
                <div class="p-3 bg-white">
                    <h2>{{ $item->title }}</h2>
                    <div class="d-flex justify-content-between align-items-center mt-4 mb-5">
                        <div class="d-flex">
                            <img
                                src="{{ render_url_upload($item->admin->logo) }}"
                                onerror="this.onerror=null;this.src='{{ asset("images/avatar-default.png") }}';"
                                alt=""
                                style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover">
                            <div class="ms-3">
                                <b class="fs-14px">{{ $item->admin->name }} </b>
                                <div class="fs-12px">
                                    {{ calculate_time($item->updated_at) }} -
                                    {{ calculate_time_for_read($item->content) }} đọc

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        {!! $item->content !!}
                    </div>
                    @php
                        $tags = explode("|",$item->tag);
                    @endphp
                    <div class="">
                        <span class="me-2">Tag:</span>
                        @foreach($tags as $tag)
                            <a href="{{ route("get.blog.index", ["tag" => strtolower($tag)]) }}"
                               class="tag-gray">{{ $tag }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

