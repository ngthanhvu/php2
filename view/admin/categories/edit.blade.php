@extends('layouts.admin')
@section('content')
    <div class="p-3 mb-4 rounded-3 bg-light">
        <h2>Cập nhật danh mục</h2>
    </div>
    <div class="p-3 mb-4 rounded-3 bg-light w-50 mx-auto">
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Tên danh mục:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $category['name'] ?>"
                    required>
            </div>
            <button type="submit" class="btn btn-warning">Cập nhật</button>
        </form>
    </div>
@endsection
