
<?php $__env->startSection('content'); ?>
    <div class="p-3 mb-4 rounded-3 bg-light">
        <h2>Tạo kích cỡ</h2>
    </div>
    <div class="p-3 mb-4 rounded-3 bg-light w-50 mx-auto">
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Tên kích cỡ</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên kích cỡ">
                <?php
                if (isset($errors['name'])) {
                    echo '<p class="text-danger">' . $errors['name'] . '</p>';
                }
                ?>
            </div>
            <button type="submit" class="btn btn-primary">Tạo kích cỡ</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/admin/sizes/create.blade.php ENDPATH**/ ?>