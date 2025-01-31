<?php
if (isset($_SESSION['message'])) {
    echo "<script>Swal.fire('Thành công', '" . $_SESSION['message'] . "', 'success');</script>";
    unset($_SESSION['message']);
}
?>
<h1>Quản lý danh mục</h1>
<a href="/admin/categories/create" class="btn btn-primary">Tạo danh mục</a>
<table class="table table-bordered table-striped text-center mt-3 table-hover">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên danh mục</th>
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach ($categories as $category): ?>
            <tr>
                <td scope="row"><?= $index++ ?></td>
                <td><?= $category['name'] ?></td>
                <td>
                    <a href="/admin/categories/update/<?= $category['id'] ?>" class="btn btn-warning">Edit</a>
                    <button class="btn btn-danger" onclick="confirmDelete(<?= $category['id'] ?>)">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php
        if (empty($categories)) {
            echo "<tr><td colspan='3'>Không tìm thấy danh mục.</td></tr>";
        }
        ?>
    </tbody>
</table>
<script>
    function confirmDelete(categoryId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/admin/categories/delete/${categoryId}`;
            }
        });
    }
</script>