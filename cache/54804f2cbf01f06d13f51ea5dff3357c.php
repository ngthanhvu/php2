

<?php $__env->startSection('content'); ?>
    <div class="row mt-3">
        <div class="col-3">
            <div class="list-group">
                <a href="#info" class="list-group-item list-group-item-action active" data-bs-toggle="tab">Thông tin tài
                    khoản</a>
                <a href="#history" class="list-group-item list-group-item-action" data-bs-toggle="tab">Lịch sử</a>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content" id="profileContent">
                        <div class="tab-pane fade show active" id="info">
                            <h5 class="card-title">Thông tin tài khoản</h5>
                            <?php
                                // var_dump($users);
                            ?>
                            <form action="/profile/update" method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Tên đăng nhập</label>
                                    <input type="text" name="username" class="form-control"
                                        value="<?php echo e($users['username']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <?php if($users['oauth_provider'] == 'google'): ?>
                                        <input type="email" class="form-control bg-light" name="email"
                                            value="<?php echo e($users['email']); ?>" readonly>
                                        <small class="text-muted">Địa chỉ email này được liên kết với tài khoản
                                            Google</small>
                                    <?php else: ?>
                                        <input type="email" class="form-control" name="email"
                                            value="<?php echo e($users['email']); ?>" placeholder="Chưa cập nhật">
                                    <?php endif; ?>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone" value="<?php echo e($users['phone']); ?>"
                                        placeholder="Chưa cập nhật">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" name="address"
                                        value="<?php echo e($users['address']); ?>"
                                        placeholder="Chưa cập nhật (ví du: 123 đường ABC, phường XYZ, quận TUV)">
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="history">
                            <h5 class="card-title">Lịch sử</h5>
                            <ul class="list-group">
                                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li class="list-group-item">
                                        Giao dịch #<?php echo e($order['id']); ?> -
                                        <?php echo e(number_format($order['total_amount'], 0, ',', '.')); ?> ₫ -
                                        <?php echo e($order['created_at']); ?>

                                        <button class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                                            data-bs-target="#orderDetail<?php echo e($order['id']); ?>">Chi tiết</button>
                                    </li>
                                    <div class="modal fade" id="orderDetail<?php echo e($order['id']); ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Chi tiết đơn hàng #<?php echo e($order['id']); ?></h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Phương thức thanh toán:</strong>
                                                        <?php echo e(ucfirst($order['payment_method'])); ?></p>
                                                    <p><strong>Địa chỉ giao hàng:</strong> <?php echo e($order['shipping_address']); ?>

                                                    </p>
                                                    <p><strong>Trạng thái:</strong> <?php echo e(ucfirst($order['status'])); ?></p>
                                                    <p><strong>Tổng tiền:</strong>
                                                        <?php echo e(number_format($order['total_amount'], 0, ',', '.')); ?> ₫</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p class='text-center mx-auto'>Không tìm thấy giao dịch</p>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let hash = window.location.hash;

            if (hash) {
                let tab = document.querySelector(`a[href="${hash}"]`);
                if (tab) {
                    new bootstrap.Tab(tab).show();
                }
            }

            document.querySelectorAll('.list-group-item').forEach(tab => {
                tab.addEventListener('click', function() {
                    history.replaceState(null, null, tab.getAttribute('href'));
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/profile/profile.blade.php ENDPATH**/ ?>