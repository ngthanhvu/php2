@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12 text-center">
        <h1 class="display-5 fw-bold"><?php echo $product['name']; ?></h1>
        <p class="text-muted">Mã sản phẩm: #<?php echo $product['id']; ?></p>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-6">
        <img src="https://storage.googleapis.com/pr-newsroom-wp/1/2023/05/2024-spotify-brand-assets-media-kit.jpg" alt="Sản phẩm" class="img-fluid rounded">
    </div>
    <div class="col-md-6 mt-4">
        <h3>Mô tả sản phẩm</h3>
        <p class="text-muted fst-italic">
            <?php echo $product['description']; ?>
        </p>
        <p>Danh mục: <b>Sản phẩm danh mục</b></p>
        <p>Số lượng: <span class="badge text-bg-success">888 cái</span></p>
        <h4 class="text-danger">Giá: <?php echo $product['price']; ?> VNĐ</h4>
        <button class="btn btn-outline-primary btn-lg mt-3">Thêm vào giỏ hàng</button>
        <button class="btn btn-outline-danger btn-lg mt-3"><i class="bi bi-heart"></i></button>
    </div>
</div>
<div class="row mt-5">
    <div class="col-md-12">
        <h3>Chi tiết bổ sung</h3>
        <p class="text-muted">
            <?php
            $nothing = $product['description'] == '' ? 'Không có thông tin chi tiết' : $product['description'];
            echo $nothing;
            ?>
        </p>
    </div>
</div>
@endsection
