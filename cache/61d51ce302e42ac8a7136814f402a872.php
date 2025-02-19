
<?php $__env->startSection('content'); ?>
<?php
if (isset($_SESSION['message'])) {
    echo "<script>Swal.fire('Thành công', '" . $_SESSION['message'] . "', 'success');</script>";
    unset($_SESSION['message']);
}
?>
<h2>Quản lý màu sắc</h2>
<a href="/admin/colors/create" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i></a>
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
        <?php foreach ($colors as $color) : ?>
            <tr>
                <th scope="row"><?= $index++ ?></th>
                <td><?= $color['name'] ?></td>
                <td>
                    <a href="/admin/colors/update/<?= $color['id'] ?>" class="btn btn-outline-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="/admin/colors/delete/<?= $color['id'] ?>" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($colors)) : ?>
            <tr>
                <td colspan="4" class="text-center">Danh sách rỗng!</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/admin/colors/index.blade.php ENDPATH**/ ?>