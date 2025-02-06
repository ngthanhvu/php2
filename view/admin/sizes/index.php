<?php
if (isset($_SESSION['message'])) {
    echo "<script>Swal.fire('Thành công', '" . $_SESSION['message'] . "', 'success');</script>";
    unset($_SESSION['message']);
}
?>
<h2>Quản lý kích cỡ</h2>
<a href="/admin/sizes/create" class="btn btn-primary">Tạo kích cỡ</a>
<table class="table table-striped table-bordered table-hover text-center mt-3">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên</th>
            <th scope="col">Hành dộng</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach ($sizes as $size) : ?>
            <tr>
                <th scope="row"><?= $index++ ?></th>
                <td><?= $size['name'] ?></td>
                <td>
                    <a href="/admin/sizes/update/<?= $size['id'] ?>" class="btn btn-success">Edit</a>
                    <a href="/admin/sizes/delete/<?= $size['id'] ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($sizes)) : ?>
            <tr>
                <td colspan="4" class="text-center">Danh sách rỗng!</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>