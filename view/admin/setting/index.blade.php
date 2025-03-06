@extends('layouts.admin')
@section('content')
    <div class="p-3 mb-4 rounded-3 bg-light">
        <h2>Cài đặt</h2>
    </div>
    <div class="p-3 mb-4 rounded-3 bg-light w-50 mx-auto">
        <form method="POST" enctype="multipart/form-data" action="/admin/setting/create">
            <div class="mb-3">
                <label for="name" class="form-label">Hình ảnh banner</label>
                <input type="file" class="form-control" id="banner" name="banner">
            </div>
            <button type="submit" class="btn btn-primary">Cap nhat</button>
        </form>
    </div>
    <div class="mt-3 p-3 mb-4 rounded-3 bg-light">
        <h3>Hình ảnh banner</h3>
        <div class="text-center"><img src="http://localhost:8000/{{ $setting['banner'] }}" alt="" class="w-50">
        </div>
    </div>
@endsection
