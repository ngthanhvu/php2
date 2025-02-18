
<?php $__env->startSection('content'); ?>

<?php
if (isset($_SESSION['message_orders'])) {
    echo "<script>Swal.fire('Thành công', '" . $_SESSION['message_orders'] . "', 'success');</script>";
    unset($_SESSION['message_orders']);
}
?>

<h2>Quản lý đơn hàng</h2>
<table class="table table-striped table-bordered table-hover text-center mt-3">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Đơn hàng ID</th>
            <th scope="col">Phương thức thanh toán</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Ngày tạo</th>
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach ($orders as $order) : ?>
            <tr>
                <th scope="row"><?php echo $index++; ?></th>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo $order['payment_method']; ?></td>
                <td>
                    <?php echo $order['status']; ?>
                    <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#updateStatusModal<?php echo $order['id']; ?>">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                </td>
                <td><?php echo $order['created_at']; ?></td>
                <td>
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderModal<?php echo $order['id']; ?>">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                    <a href="/admin/orders/delete/<?php echo $order['id']; ?>" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>

            <!-- Modal Đổi Trạng Thái -->
            <div class="modal fade" id="updateStatusModal<?php echo $order['id']; ?>" tabindex="-1" aria-labelledby="updateStatusModalLabel<?php echo $order['id']; ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateStatusModalLabel<?php echo $order['id']; ?>">Cập nhật trạng thái đơn hàng #<?php echo $order['id']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/orders/update" method="POST">
                                <div class="mb-3">
                                    <label for="statusSelect<?php echo $order['id']; ?> class="form-label">Chọn trạng thái mới:</label>
                                    <select class="form-select" name="status" id="statusSelect<?php echo $order['id']; ?>">
                                        <option value="pending" <?php if ($order['status'] == 'pending') echo 'selected'; ?>>Chờ xử lý</option>
                                        <option value="completed" <?php if ($order['status'] == 'completed') echo 'selected'; ?>>Hoàn thành</option>
                                        <option value="canceled" <?php if ($order['status'] == 'canceled') echo 'selected'; ?>>Hủy bỏ</option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Chi Tiết Đơn Hàng -->
            <div class="modal fade" id="orderModal<?php echo $order['id']; ?>" tabindex="-1" aria-labelledby="orderModalLabel<?php echo $order['id']; ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="orderModalLabel<?php echo $order['id']; ?>">Chi Tiết Đơn Hàng #<?php echo $order['id']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Trạng thái:</strong> <?php echo $order['status']; ?></p>
                            <p><strong>Phương thức thanh toán:</strong> <?php echo $order['payment_method']; ?></p>
                            <p><strong>Tổng tiền:</strong> <?php echo number_format($order['total_amount'], 2); ?> VND</p>
                            <p><strong>Địa chỉ giao hàng:</strong> <?php echo $order['shipping_address']; ?></p>
                            <p><strong>Ngày tạo:</strong> <?php echo $order['created_at']; ?></p>
                            <p><strong>Ngày cập nhật:</strong> <?php echo $order['updated_at']; ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if (empty($orders)) : ?>
            <tr>
                <td colspan="6">Không tìm thấy đơn hàng</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".update-status-btn").forEach(function(button) {
            button.addEventListener("click", function() {
                let orderId = this.getAttribute("data-order-id");
                let newStatus = document.getElementById("statusSelect" + orderId).value;

                // Chuyển hướng sang trang cập nhật trạng thái
                window.location.href = `/admin/orders/update/${orderId}?status=${newStatus}`;
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/admin/orders/index.blade.php ENDPATH**/ ?>