
<?php $__env->startSection('content'); ?>
<div class="row mt-3">
    <div class="col-3">
        <div class="list-group">
            <a href="#info" class="list-group-item list-group-item-action active" data-bs-toggle="tab">Thông tin tài khoản</a>
            <a href="#history" class="list-group-item list-group-item-action" data-bs-toggle="tab">Lịch sử</a>
        </div>
    </div>
    <div class="col-9">
        <div class="card">
            <div class="card-body">
                <div class="tab-content" id="profileContent">
                    <div class="tab-pane fade show active" id="info">
                        <h5 class="card-title">Thông tin tài khoản</h5>
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Họ tên</label>
                                <input type="text" class="form-control" value="Nguyễn Văn A">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="example@gmail.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" value="0123456789">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" value="123 Đường ABC, Quận XYZ, TP.HCM">
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="history">
                        <h5 class="card-title">Lịch sử</h5>
                        <ul class="list-group">
                            <?php foreach ($orders as $order): ?>
                                <li class="list-group-item">
                                    Giao dịch #<?= $order['id'] ?> - <?= number_format($order['total_amount'], 0, ',', '.') . ' ₫'; ?> - <?= $order['created_at'] ?>
                                    <!-- Nút Chi tiết với data-bs-target liên kết tới modal của đơn hàng này -->
                                    <button class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#orderDetail<?= $order['id'] ?>">Chi tiết</button>
                                </li>

                                <!-- Modal cho mỗi đơn hàng, sử dụng order['id'] để tạo ID modal duy nhất -->
                                <div class="modal fade" id="orderDetail<?= $order['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Chi tiết đơn hàng #<?= $order['id'] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Hiển thị thông tin chi tiết của đơn hàng -->
                                                <p><strong>Phương thức thanh toán:</strong> <?= ucfirst($order['payment_method']) ?></p>
                                                <p><strong>Địa chỉ giao hàng:</strong> <?= $order['shipping_address'] ?></p>
                                                <p><strong>Trạng thái:</strong> <?= ucfirst($order['status']) ?></p>
                                                <p><strong>Tổng tiền:</strong> <?= number_format($order['total_amount'], 0, ',', '.') . ' ₫' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </ul>
                    </div>
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