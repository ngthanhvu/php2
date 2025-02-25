

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
                            <h5 class="card-title">Lịch sử đơn hàng</h5>
                            <ul class="list-group" id="order-list">
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item order-item">
                                        <strong>Giao dịch #<?php echo e($order['id']); ?></strong> -
                                        <span
                                            class="badge bg-<?php echo e($order['status'] == 'completed' ? 'success' : ($order['status'] == 'canceled' ? 'danger' : 'warning')); ?>">
                                            <?php echo e(ucfirst($order['status'])); ?>

                                        </span>
                                        <br>
                                        <strong>Số tiền:</strong> <?php echo e(number_format($order['total_amount'], 0, ',', '.')); ?>

                                        ₫ <br>
                                        <strong>Ngày tạo:</strong> <?php echo e($order['created_at']); ?>


                                        <button class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                                            data-bs-target="#orderDetail<?php echo e($order['id']); ?>">Chi tiết</button>
                                    </li>

                                    <!-- Modal chi tiết đơn hàng -->
                                    <div class="modal fade" id="orderDetail<?php echo e($order['id']); ?>" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Chi tiết đơn hàng #<?php echo e($order['id']); ?></h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Mã đơn hàng:</strong> <?php echo e($order['code'] ?? 'Chưa có mã'); ?>

                                                    </p>
                                                    <p><strong>Trạng thái:</strong>
                                                        <span
                                                            class="badge bg-<?php echo e($order['status'] == 'completed' ? 'success' : ($order['status'] == 'canceled' ? 'danger' : 'warning')); ?>">
                                                            <?php echo e(ucfirst($order['status'])); ?>

                                                        </span>
                                                    </p>
                                                    <p><strong>Phương thức thanh toán:</strong>
                                                        <?php echo e(strtoupper($order['payment_method'])); ?></p>
                                                    <p><strong>Tổng tiền:</strong>
                                                        <?php echo e(number_format($order['total_amount'], 0, ',', '.')); ?> ₫</p>
                                                    <p><strong>Địa chỉ giao hàng:</strong> <?php echo e($order['shipping_address']); ?>

                                                    </p>
                                                    <p><strong>Ngày tạo:</strong> <?php echo e($order['created_at']); ?></p>
                                                    <p><strong>Ngày cập nhật:</strong> <?php echo e($order['updated_at']); ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>

                            <!-- Nút phân trang -->
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center mt-3" id="pagination"></ul>
                            </nav>
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

        document.addEventListener("DOMContentLoaded", function() {
            const ordersPerPage = 5; // Số lượng đơn hàng hiển thị trên mỗi trang
            const orderItems = document.querySelectorAll(".order-item");
            const pagination = document.getElementById("pagination");
            let currentPage = 1;
            let totalPages = Math.ceil(orderItems.length / ordersPerPage);

            function showPage(page) {
                let start = (page - 1) * ordersPerPage;
                let end = start + ordersPerPage;

                orderItems.forEach((item, index) => {
                    item.style.display = (index >= start && index < end) ? "block" : "none";
                });

                renderPagination();
            }

            function renderPagination() {
                pagination.innerHTML = "";

                if (totalPages > 1) {
                    // Nút Previous
                    let prevLi = document.createElement("li");
                    prevLi.classList.add("page-item");
                    prevLi.innerHTML = `<a class="page-link" href="#" aria-label="Previous">&laquo;</a>`;
                    prevLi.addEventListener("click", function() {
                        if (currentPage > 1) {
                            currentPage--;
                            showPage(currentPage);
                        }
                    });
                    pagination.appendChild(prevLi);

                    // Các số trang
                    for (let i = 1; i <= totalPages; i++) {
                        let li = document.createElement("li");
                        li.classList.add("page-item");
                        if (i === currentPage) li.classList.add("active");
                        li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                        li.addEventListener("click", function() {
                            currentPage = i;
                            showPage(currentPage);
                        });
                        pagination.appendChild(li);
                    }

                    // Nút Next
                    let nextLi = document.createElement("li");
                    nextLi.classList.add("page-item");
                    nextLi.innerHTML = `<a class="page-link" href="#" aria-label="Next">&raquo;</a>`;
                    nextLi.addEventListener("click", function() {
                        if (currentPage < totalPages) {
                            currentPage++;
                            showPage(currentPage);
                        }
                    });
                    pagination.appendChild(nextLi);
                }
            }

            showPage(currentPage);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/profile/profile.blade.php ENDPATH**/ ?>