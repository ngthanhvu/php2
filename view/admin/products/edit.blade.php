@extends('layouts.admin')
@section('content')
    <div class="p-3 mb-4 rounded-3 bg-light">
        <h2>Chỉnh sửa sản phẩm</h2>
    </div>
    <div class="p-3 mb-4 rounded-3 bg-light w-50 mx-auto">
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $product['name'] ?>">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá:</label>
                <input type="text" class="form-control" id="price" name="price" value="<?= $product['price'] ?>">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh:</label>
                <input type="text" class="form-control" id="image" name="image" value="<?= $product['image'] ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả:</label>
                <textarea type="text" class="form-control" id="description" name="description"><?= $product['description'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
@endsection
