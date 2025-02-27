
<?php $__env->startSection('content'); ?>

    

    <div class="card border-success">
        <div class="card-header text-white" style="background-color: #FE5722; border-color: #FE5722">
            <h5 class="mb-0"><i class="fa-solid fa-cart-shopping"></i> Giỏ hàng</h5>
        </div>
    </div>
    <?php if(!empty($carts)): ?>
        <table class="table table-bordered table-hover table-striped text-center mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Biến thể</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $index = 1;
                    $totalPrice = 0;
                ?>
                <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $itemTotal = $cart['price'] * $cart['quantity'];
                        $totalPrice += $itemTotal;
                        // var_dump($cart);
                    ?>
                    <tr>
                        <th scope="row"><?php echo e($index++); ?></th>
                        <td><img src="http://localhost:8000/<?php echo e($cart['product_image']); ?>" alt="No image" width="100"></td>
                        <td><?php echo e($cart['product_name']); ?></td>
                        <td><?php echo e($cart['product_size']); ?>, <?php echo e($cart['product_color']); ?></td>
                        <td><?php echo e(number_format($cart['price'], 0, ',', '.')); ?>đ</td>
                        <td>
                            <button class="btn btn-outline-secondary btn-decrease" data-id="<?php echo e($cart['id']); ?>"
                                data-sku="<?php echo e($cart['sku']); ?>">-</button>
                            <input type="number"
                                class="quantity-input form-control text-center mx-2 d-inline border-0 bg-transparent"
                                value="<?php echo e($cart['quantity']); ?>" min="1" data-id="<?php echo e($cart['id']); ?>"
                                data-sku="<?php echo e($cart['sku']); ?>"
                                style="width: 70px; text-align: center; font-size: 1rem; font-weight: 500;">
                            <button class="btn btn-outline-secondary btn-increase" data-id="<?php echo e($cart['id']); ?>"
                                data-sku="<?php echo e($cart['sku']); ?>">+</button>
                        </td>
                        <td><?php echo e(number_format($itemTotal, 0, ',', '.')); ?>đ</td>
                        <td>
                            <a href="/cart/delete/<?php echo e($cart['id']); ?>" class="btn btn-danger"><i
                                    class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($carts)): ?>
                    <tr>
                        <td colspan="8" class="text-end">
                            <a href="/cart/deleteAll" class="btn btn-danger btn-sm">Xóa tất cả</a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            <h4>Tổng tiền: <?php echo e(number_format($totalPrice, 0, ',', '.')); ?>đ</h4>
        </div>
        <div class="d-flex justify-content-end">
            <a href="/checkout" class="btn btn-success">Tới trang thanh toán <i class="fa-solid fa-credit-card"></i></a>
        </div>
    <?php else: ?>
        <div class="d-flex flex-column align-items-center mt-3">
            <i class="bi bi-cart-x fa-3x text-muted"></i>
            <h4>Giỏ hàng trống</h4>
            <a href="/" class="btn btn-primary btn-sm mt-3">Tiếp tục mua hàng</a>
        </div>
    <?php endif; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".btn-decrease").forEach(button => {
                button.addEventListener("click", async function() {
                    const input = this.nextElementSibling;
                    const id = this.getAttribute("data-id");
                    // const sku = this.getAttribute("data-sku");
                    let quantity = parseInt(input.value) - 1;
                    if (quantity >= 1) {
                        input.value = quantity;
                        await updateCart(id, quantity);
                    }
                });
            });

            document.querySelectorAll(".btn-increase").forEach(button => {
                button.addEventListener("click", async function() {
                    const input = this.previousElementSibling;
                    const id = this.getAttribute("data-id");
                    // const sku = this.getAttribute("data-sku");
                    let quantity = parseInt(input.value) + 1;
                    input.value = quantity;
                    await updateCart(id, quantity);
                });
            });

            document.querySelectorAll(".quantity-input").forEach(input => {
                input.addEventListener("change", async function() {
                    const id = this.getAttribute("data-id");
                    // const sku = this.getAttribute("data-sku");
                    let quantity = parseInt(this.value);
                    if (quantity < 1 || isNaN(quantity)) {
                        this.value = 1;
                        quantity = 1;
                    }
                    await updateCart(id, quantity);
                });
            });

            async function updateCart(id, quantity) {
                try {
                    const response = await fetch(`/cart/updateQuantity/${id}/${quantity}`, {
                        method: "GET",
                    });
                    const data = await response.json();

                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert("Có lỗi xảy ra!");
                    }
                } catch (error) {
                    console.error("Lỗi:", error);
                }
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/cart.blade.php ENDPATH**/ ?>