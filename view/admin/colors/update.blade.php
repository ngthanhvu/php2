@extends('layouts.admin')
@section('content')
    <div class="p-3 mb-4 rounded-3 bg-light">
        <h2>Cập nhật màu sắc</h2>
    </div>
    <div class="p-3 mb-4 rounded-3 bg-light w-50 mx-auto">
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Tên màu sắc</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $color['name'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Tạo màu sắc</button>
        </form>
    </div>
@endsection
