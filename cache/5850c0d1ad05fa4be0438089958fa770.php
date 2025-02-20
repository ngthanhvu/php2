
<?php $__env->startSection('content'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/admin/categories/edit.blade.php ENDPATH**/ ?>