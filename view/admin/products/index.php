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
                <td><img src="<?= $product['image'] ?>" alt="No image" width="100"></td>
                <td>
                    <a href="/products/update/<?= $product['id'] ?>" class="btn btn-success">Edit</a>
                    <a href="/products/delete/<?= $product['id'] ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($products)) : ?>
            <tr>
                <td colspan="6">Không tìm thấy danh sách sản phẩm.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>