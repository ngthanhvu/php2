<?php
if (isset($_SESSION['message'])) {
    echo "<script>Swal.fire('Thành công', '" . $_SESSION['message'] . "', 'success');</script>";
    unset($_SESSION['message']);
}
?>
<h2>Danh sách sản phẩm</h2>
<a href="/admin/products/create" class="btn btn-primary">Tạo sản phẩm</a>
<table class="table table-striped table-bordered table-hover text-center mt-3">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên sản phẩm</th>
            <th scope="col">Giá</th>
            <th scope="col">Mô tả</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Biến thể</th>
            <th scope="col">Hành dộng</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach ($products as $product) : ?>
            <tr>
                <th scope="row"><?= $index++ ?></th>
                <td><?= $product['name'] ?></td>
                <td><?= $product['price'] ?></td>
                <td><?= $product['description'] ?></td>
                <td><img src="http://localhost:8000/<?= $product['image'] ?>" alt="No image" width="100"></td>
                <td><a href="/admin/products/products-variants/<?= $product['id'] ?>" class="btn btn-outline-primary">Xem biến thể</a></td>
                <td>
                    <a href="/admin/products/addProductVarrant/<?= $product['id'] ?>" class="btn btn-primary btn-sm">Add varriant</a>
                    <a href="/admin/products/update/<?= $product['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                    <a href="/admin/products/delete/<?= $product['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($products)) : ?>
            <tr>
                <td colspan="7">Không tìm thấy danh sách sản phẩm.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>