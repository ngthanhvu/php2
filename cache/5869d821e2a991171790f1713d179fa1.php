
<?php $__env->startSection('content'); ?>
    <div class="container mt-5 text-center">
        <i class="bi bi-check-circle-fill text-success" style="font-size: 80px;"></i>
        <h1 class="text-success fw-bold mt-3">Giao dịch thành công!</h1>
        <?php if(isset($_GET['code'])): ?>
            <p class="text-center">Mã đơn hàng: <?php echo e($_GET['code']); ?></p>
        <?php else: ?>
            <p class="text-center"></p>
        <?php endif; ?>
        <div class="mt-4">
            <a href="/" class="btn btn-success me-2"><i class="fa-solid fa-house-chimney"></i> Về trang chủ</a>
            <a href="/profile#history" class="btn btn-outline-secondary"><i class="fa-regular fa-clock"></i> Xem lịch
                sử</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/success.blade.php ENDPATH**/ ?>