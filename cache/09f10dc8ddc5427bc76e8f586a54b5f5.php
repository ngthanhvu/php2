
<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <h2 class="mb-4">Thanh toán</h2>
        <form action="/checkout/create" method="POST">
            <div class="row">
                <!-- Thông tin khách hàng -->
                <div class="col-md-6">
                    <h4>Thông tin khách hàng</h4>
                    <?php if(!empty($addresses)): ?>
                        <div id="existing-addresses" class="mt-3 border p-3">
                            <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-check border p-2 mb-2 rounded-3">
                                    <input class="form-check-input" type="radio" name="address_id"
                                        id="address<?php echo e($address['id']); ?>" value="<?php echo e($address['id']); ?>"
                                        <?php echo e($loop->first ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="address<?php echo e($address['id']); ?>">
                                        <?php echo e($address['full_name']); ?> - <?php echo e($address['phone']); ?> <br>
                                        <?php echo e($address['address']); ?>

                                    </label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <button type="button" class="btn btn-link mt-2" id="add-new-address-btn">Thêm địa chỉ
                                khác</button>
                        </div>
                    <?php endif; ?>

                    <!-- Form thêm địa chỉ mới -->
                    <div id="new-address-form" style="display: <?php echo e(empty($addresses) ? 'block' : 'none'); ?>;" class="mt-3">
                        <div class="mb-3">
                            <label class="form-label">Họ và Tên</label>
                            <input type="text" class="form-control" name="name" placeholder="Nhập họ và tên"
                                value="<?php echo e($user['name'] ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Nhập email"
                                value="<?php echo e($user['email'] ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại"
                                value="<?php echo e($user['phone'] ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Địa chỉ giao hàng</label>
                            <textarea class="form-control" name="new_address" rows="3" placeholder="Nhập địa chỉ mới"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Phương thức thanh toán -->
                <div class="col-md-6">
                    <h4>Phương thức thanh toán</h4>
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input me-2" type="radio" name="payment_method" id="cod"
                            value="cod" checked>
                        <label class="form-check-label d-flex align-items-center" for="cod">
                            <img src="https://cdn-icons-png.flaticon.com/512/2897/2897832.png" alt="COD" width="20"
                                height="20" class="me-2">
                            Thanh toán khi nhận hàng (COD)
                        </label>
                    </div>
                    <div class="form-check d-flex align-items-center mt-2">
                        <input class="form-check-input me-2" type="radio" name="payment_method" id="vnpay"
                            value="vnpay">
                        <label class="form-check-label d-flex align-items-center" for="vnpay">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTp1v7T287-ikP1m7dEUbs2n1SbbLEqkMd1ZA&s"
                                alt="VNPay" width="20" height="20" class="me-2">
                            VNPay
                        </label>
                    </div>
                    <div class="form-check d-flex align-items-center mt-2">
                        <input class="form-check-input me-2" type="radio" name="payment_method" id="momo"
                            value="momo">
                        <label class="form-check-label d-flex align-items-center" for="momo">
                            <img src="https://play-lh.googleusercontent.com/uCtnppeJ9ENYdJaSL5av-ZL1ZM1f3b35u9k8EOEjK3ZdyG509_2osbXGH5qzXVmoFv0"
                                alt="MOMO" width="20" height="20" class="me-2">
                            MOMO
                        </label>
                    </div>

                    

                    

                    <h4 class="mt-4">Tóm tắt đơn hàng</h4>
                    <ul class="list-group mb-3">
                        <?php
                            $totalPrice = 0;
                            $shippingFee = 20000; // Phí ship mặc định 20,000đ
                            $freeShippingThreshold = 300000; // Miễn phí ship từ 300,000đ trở lên
                        ?>
                        <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $subTotal = $cart['price'] * $cart['quantity'];
                                $totalPrice += $subTotal;
                            ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><?php echo e(htmlspecialchars($cart['product_name'])); ?></span>
                                <strong><?php echo e(number_format($subTotal, 0, ',', '.')); ?>₫</strong>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <!-- Ô nhập mã giảm giá -->
                        <li class="list-group-item">
                            <label for="coupon_code">Mã giảm giá</label>
                            <div class="input-group mt-1">
                                <input type="text" id="coupon_code" class="form-control" placeholder="Nhập mã giảm giá">
                                <button type="button" id="apply_coupon" class="btn btn-success">Áp dụng</button>
                            </div>
                            <small id="coupon_message" class="text-danger"></small>
                        </li>

                        <!-- Hiển thị phí vận chuyển -->
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Phí vận chuyển</strong>
                            <strong id="shipping_fee_display">
                                <?php if($totalPrice >= $freeShippingThreshold): ?>
                                    0₫ (Miễn phí)
                                <?php else: ?>
                                    <?php echo e(number_format($shippingFee, 0, ',', '.')); ?>₫
                                <?php endif; ?>
                            </strong>
                        </li>

                        <!-- Tổng tiền -->
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Tổng cộng</strong>
                            <strong id="total_amount_display">
                                <?php echo e(number_format($totalPrice + ($totalPrice >= $freeShippingThreshold ? 0 : $shippingFee), 0, ',', '.')); ?>₫
                            </strong>
                            <input type="hidden" name="total_amount" id="total_amount" value="<?php echo e($totalPrice); ?>">
                            <input type="hidden" id="base_total" value="<?php echo e($totalPrice); ?>"> <!-- Lưu tổng gốc -->
                        </li>
                    </ul>


                    <button type="submit" class="btn btn-primary w-100">Đặt hàng <i
                            class="fa-solid fa-bag-shopping"></i></button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-new-address-btn').addEventListener('click', function() {
            document.getElementById('new-address-form').style.display = 'block';
            document.querySelectorAll('input[name="address_id"]').forEach(input => input.checked = false);
        });
        // document.getElementById('apply_coupon').addEventListener('click', async function() {
        //     let couponCode = document.getElementById('coupon_code').value.trim();
        //     let totalAmount = parseFloat(document.getElementById('total_amount').value);

        //     if (couponCode === '') {
        //         document.getElementById('coupon_message').textContent = "Vui lòng nhập mã giảm giá.";
        //         return;
        //     }

        //     try {
        //         let response = await fetch(`/get-coupon?code=${couponCode}`);
        //         let data = await response.json();

        //         if (!data || !data.code) {
        //             document.getElementById('coupon_message').textContent =
        //                 "Mã giảm giá không hợp lệ hoặc đã hết hạn.";
        //             document.getElementById('coupon_message').classList.remove('text-success');
        //             document.getElementById('coupon_message').classList.add('text-danger');
        //             return;
        //         }

        //         let discount = data.discount;
        //         let discountType = data.type;
        //         let newTotal = totalAmount;

        //         if (discountType === 'percentage') {
        //             newTotal -= (totalAmount * (discount / 100));
        //         } else if (discountType === 'fixed') {
        //             newTotal -= discount;
        //         }

        //         newTotal = Math.max(0, newTotal); // Không cho tổng tiền nhỏ hơn 0

        //         document.getElementById('total_amount_display').textContent = new Intl.NumberFormat('vi-VN')
        //             .format(newTotal) + '₫';
        //         document.getElementById('total_amount').value = newTotal;
        //         document.getElementById('coupon_message').textContent = "Mã giảm giá đã được áp dụng!";
        //         document.getElementById('coupon_message').classList.remove('text-danger');
        //         document.getElementById('coupon_message').classList.add('text-success');
        //     } catch (error) {
        //         console.error('Lỗi:', error);
        //         document.getElementById('coupon_message').textContent = "Có lỗi xảy ra, vui lòng thử lại.";
        //         document.getElementById('coupon_message').classList.remove('text-success');
        //         document.getElementById('coupon_message').classList.add('text-danger');
        //     }
        // });

        // document.addEventListener("DOMContentLoaded", function() {
        //     updateTotal(); // Tính tổng ban đầu

        //     document.getElementById('apply_coupon').addEventListener('click', async function() {
        //         let couponCode = document.getElementById('coupon_code').value.trim();
        //         let baseTotal = parseFloat(document.getElementById('base_total').value); // Tổng gốc

        //         if (couponCode === '') {
        //             document.getElementById('coupon_message').textContent =
        //             "Vui lòng nhập mã giảm giá.";
        //             return;
        //         }

        //         try {
        //             let response = await fetch(`/get-coupon?code=${couponCode}`);
        //             let data = await response.json();

        //             if (!data || !data.code) {
        //                 document.getElementById('coupon_message').textContent =
        //                     "Mã giảm giá không hợp lệ hoặc đã hết hạn.";
        //                 document.getElementById('coupon_message').classList.remove('text-success');
        //                 document.getElementById('coupon_message').classList.add('text-danger');
        //                 return;
        //             }

        //             let discount = data.discount;
        //             let discountType = data.type;
        //             let discountedTotal = baseTotal;

        //             if (discountType === 'percentage') {
        //                 discountedTotal -= (baseTotal * (discount / 100));
        //             } else if (discountType === 'fixed') {
        //                 discountedTotal -= discount;
        //             }

        //             discountedTotal = Math.max(0, discountedTotal); // Đảm bảo tổng tiền không âm
        //             document.getElementById('total_amount').value =
        //             discountedTotal; // Cập nhật tổng sau giảm giá

        //             document.getElementById('coupon_message').textContent =
        //                 "Mã giảm giá đã được áp dụng!";
        //             document.getElementById('coupon_message').classList.remove('text-danger');
        //             document.getElementById('coupon_message').classList.add('text-success');

        //             updateTotal(); // Cập nhật lại hiển thị với phí ship

        //         } catch (error) {
        //             console.error('Lỗi:', error);
        //             document.getElementById('coupon_message').textContent =
        //                 "Có lỗi xảy ra, vui lòng thử lại.";
        //             document.getElementById('coupon_message').classList.remove('text-success');
        //             document.getElementById('coupon_message').classList.add('text-danger');
        //         }
        //     });
        // });

        // /**
        //  * Hàm cập nhật tổng tiền và kiểm tra miễn phí vận chuyển
        //  */
        // function updateTotal() {
        //     let totalAmount = parseFloat(document.getElementById('total_amount').value); // Tổng sau giảm giá
        //     let shippingFee = calculateShippingFee(totalAmount); // Kiểm tra điều kiện free ship

        //     // Cập nhật phí ship hiển thị
        //     document.getElementById('shipping_fee_display').textContent = shippingFee === 0 ? `0₫ (Miễn phí)` :
        //         new Intl.NumberFormat('vi-VN').format(shippingFee) + "₫";

        //     // Tổng tiền cuối cùng
        //     let finalTotal = totalAmount + shippingFee;
        //     document.getElementById('total_amount_display').textContent = new Intl.NumberFormat('vi-VN')
        //         .format(finalTotal) + '₫';
        // }

        // /**
        //  * Hàm kiểm tra và tính phí vận chuyển
        //  * Nếu tổng >= 300.000đ thì free ship
        //  */
        // function calculateShippingFee(totalAmount) {
        //     let freeShippingThreshold = 300000;
        //     let shippingFee = 20000; // Phí ship mặc định

        //     return totalAmount >= freeShippingThreshold ? 0 : shippingFee;
        // }

        document.addEventListener("DOMContentLoaded", function() {
            updateTotal(); // Tính tổng ban đầu

            document.getElementById('apply_coupon').addEventListener('click', async function() {
                let couponCode = document.getElementById('coupon_code').value.trim();
                let baseTotal = parseFloat(document.getElementById('base_total').value); // Tổng gốc

                if (couponCode === '') {
                    document.getElementById('coupon_message').textContent =
                    "Vui lòng nhập mã giảm giá.";
                    return;
                }

                try {
                    let response = await fetch(`/get-coupon?code=${couponCode}`);
                    let data = await response.json();

                    if (!data || !data.code) {
                        document.getElementById('coupon_message').textContent =
                            "Mã giảm giá không hợp lệ hoặc đã hết hạn.";
                        document.getElementById('coupon_message').classList.remove('text-success');
                        document.getElementById('coupon_message').classList.add('text-danger');
                        return;
                    }

                    let discount = data.discount;
                    let discountType = data.type;
                    let discountedTotal = baseTotal;

                    if (discountType === 'percentage') {
                        discountedTotal -= (baseTotal * (discount / 100));
                    } else if (discountType === 'fixed') {
                        discountedTotal -= discount;
                    }

                    discountedTotal = Math.max(0, discountedTotal); // Đảm bảo tổng tiền không âm
                    document.getElementById('total_amount').value =
                    discountedTotal; // Cập nhật tổng sau giảm giá

                    document.getElementById('coupon_message').textContent =
                        "Mã giảm giá đã được áp dụng!";
                    document.getElementById('coupon_message').classList.remove('text-danger');
                    document.getElementById('coupon_message').classList.add('text-success');

                    updateTotal(); // Cập nhật lại hiển thị và total_amount với phí ship

                } catch (error) {
                    console.error('Lỗi:', error);
                    document.getElementById('coupon_message').textContent =
                        "Có lỗi xảy ra, vui lòng thử lại.";
                    document.getElementById('coupon_message').classList.remove('text-success');
                    document.getElementById('coupon_message').classList.add('text-danger');
                }
            });
        });

        /**
         * Hàm cập nhật tổng tiền và kiểm tra miễn phí vận chuyển
         */
        function updateTotal() {
            let totalAmount = parseFloat(document.getElementById('total_amount').value); // Tổng sau giảm giá
            let shippingFee = calculateShippingFee(totalAmount); // Kiểm tra điều kiện free ship

            // Cập nhật phí ship hiển thị
            document.getElementById('shipping_fee_display').textContent = shippingFee === 0 ? `0₫ (Miễn phí)` :
                new Intl.NumberFormat('vi-VN').format(shippingFee) + "₫";

            // Tổng tiền cuối cùng
            let finalTotal = totalAmount + shippingFee;
            document.getElementById('total_amount_display').textContent = new Intl.NumberFormat('vi-VN')
                .format(finalTotal) + '₫';
            document.getElementById('total_amount').value = finalTotal; // Cập nhật total_amount với tổng cuối cùng
        }

        /**
         * Hàm kiểm tra và tính phí vận chuyển
         * Nếu tổng >= 300.000đ thì free ship
         */
        function calculateShippingFee(totalAmount) {
            let freeShippingThreshold = 300000;
            let shippingFee = 20000; // Phí ship mặc định

            return totalAmount >= freeShippingThreshold ? 0 : shippingFee;
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/checkout.blade.php ENDPATH**/ ?>