@extends('layouts.admin')
@section('content')

<h2>Danh sách biến thể</h2>

<table class="table table-striped table-bordered table-hover text-center mt-3">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Màu sắc</th>
            <th scope="col">Kích thước</th>
            <th scope="col">Số lượng</th>
            <th scope="col">SKU</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Giá tiền</th>
            <th scope="col">Hành dộng</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php
        echo "<pre>";
        // var_dump($products);
        echo "</pre>";
        ?>
        <?php foreach ($products as $product) : ?>
            <tr>
                <th scope="row"><?= $index++ ?></th>
                <td><?= $product['color_name'] ?></td>
                <td><?= $product['size_name'] ?></td>
                <td><?= $product['variant_quantity'] ?></td>
                <td><?= $product['variant_sku'] ?></td>
                <td><img src="http://localhost:8000/<?= $product['product_image'] ?>" alt="No image" width="100"></td>
                <td><?= $product['variant_price'] ?></td>
                <td>
                    <a href="/admin/products/update/<?= $product['variant_id'] ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="/admin/products/deleteProductVariant/<?= $product['variant_id'] ?>" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
@endsection
