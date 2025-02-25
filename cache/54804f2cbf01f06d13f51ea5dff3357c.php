

<?php $__env->startSection('content'); ?>
    <div class="row mt-3">
        <div class="col-3">
            <div class="list-group">
                <a href="#info" class="list-group-item list-group-item-action active" data-bs-toggle="tab">Thông tin tài
                    khoản</a>
                <a href="#address" class="list-group-item list-group-item-action" data-bs-toggle="tab">Địa chỉ</a>
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
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="address">
                            <h5 class="card-title">Địa chỉ</h5>
                            <ul class="list-group">
                                <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            Họ tên: <strong><?php echo e($address['full_name']); ?></strong><br>
                                            Số điện: <strong><?php echo e($address['phone']); ?></strong><br>
                                            Địa chỉ: <strong><?php echo e($address['address']); ?></strong>
                                        </div>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editAddress<?php echo e($address['id']); ?>">Chỉnh sửa</button>
                                    </li>
                                    <div class="modal fade" id="editAddress<?php echo e($address['id']); ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Chỉnh sửa địa chỉ</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/profile/address/update/<?php echo e($address['id']); ?>"
                                                        method="POST">
                                                        <div class="mb-2">
                                                            <label class="form-label">Họ và tên</label>
                                                            <input type="text" class="form-control" name="full_name"
                                                                value="<?php echo e($address['full_name']); ?>">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label">Số điện thoại</label>
                                                            <input type="text" class="form-control" name="phone"
                                                                value="<?php echo e($address['phone']); ?>">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label">Địa chỉ</label>
                                                            <input type="text" class="form-control" name="address"
                                                                value="<?php echo e($address['address']); ?>">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <h5 class="card-title mt-4">Thêm địa chỉ mới</h5>
                            <form action="/profile/address/add" method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Họ tên</label>
                                    <input type="text" class="form-control" name="full_name"
                                        placeholder="Nhập họ và tên">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone"
                                        placeholder="Nhập số điện thoại">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" name="address"
                                        placeholder="Nhập địa chỉ">
                                </div>
                                <button type="submit" class="btn btn-success">Thêm địa chỉ</button>
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