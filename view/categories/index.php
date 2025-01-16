<?php
if (isset($_SESSION['message'])) {
    echo "<script>Swal.fire('Thành công', '" . $_SESSION['message'] . "', 'success');</script>";
    unset($_SESSION['message']);
}
?>
<h1>Category List</h1>
<a href="/categories/create" class="btn btn-primary mb-3">Create Category</a>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category): ?>
            <tr>
                <td><?= $category['id'] ?></td>
                <td><?= $category['name'] ?></td>
                <td>
                    <a href="/categories/update/<?= $category['id'] ?>" class="btn btn-warning">Edit</a>
                    <button class="btn btn-danger" onclick="confirmDelete(<?= $category['id'] ?>)">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
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
                window.location.href = `/categories/delete/${categoryId}`;
            }
        });
    }
</script>