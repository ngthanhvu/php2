
<?php $__env->startSection('content'); ?>
    <div class="p-3 mb-4 rounded-3 bg-light">
        <h1>Tạo danh mục</h1>
    </div>
    <div class="p-3 mb-4 rounded-3 bg-light w-50 mx-auto">
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Tên danh mục</label>
                <input type="text" class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" id="name" name="name"
                    placeholder="Nhập tên danh mục">
                <?php if (isset($errors['name'])): ?>
                <div class="invalid-feedback">
                    <?= $errors['name'] ?>
                </div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-success">Tạo</button>
        </form>
        </dic>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/admin/categories/create.blade.php ENDPATH**/ ?>