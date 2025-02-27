@extends('layouts.master')
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Thanh toán</h2>
        <form action="/checkout/create" method="POST">
            <div class="row">
                <!-- Thông tin khách hàng -->
                <div class="col-md-6">
                    <h4>Thông tin khách hàng</h4>
                    @if (!empty($addresses))
                        <div id="existing-addresses" class="mt-3 border p-3">
                            @foreach ($addresses as $address)
                                <div class="form-check border p-2 mb-2 rounded-3">
                                    <input class="form-check-input" type="radio" name="address_id"
                                        id="address{{ $address['id'] }}" value="{{ $address['id'] }}"
                                        {{ $loop->first ? 'checked' : '' }}>
                                    <label class="form-check-label" for="address{{ $address['id'] }}">
                                        {{ $address['full_name'] }} - {{ $address['phone'] }} <br>
                                        {{ $address['address'] }}
                                    </label>
                                </div>
                            @endforeach
                            <button type="button" class="btn btn-link mt-2" id="add-new-address-btn">Thêm địa chỉ
                                khác</button>
                        </div>
                    @endif

                    <!-- Form thêm địa chỉ mới -->
                    <div id="new-address-form" style="display: {{ empty($addresses) ? 'block' : 'none' }};" class="mt-3">
                        <div class="mb-3">
                            <label class="form-label">Họ và Tên</label>
                            <input type="text" class="form-control" name="name" placeholder="Nhập họ và tên"
                                value="{{ $user['name'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Nhập email"
                                value="{{ $user['email'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại"
                                value="{{ $user['phone'] ?? '' }}">
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
                        @php
                            $totalPrice = 0;
                            $shippingFee = 20000; // Phí ship mặc định 20,000đ
                            $freeShippingThreshold = 300000; // Miễn phí ship từ 300,000đ trở lên
                        @endphp
                        @foreach ($carts as $cart)
                            @php
                                $subTotal = $cart['price'] * $cart['quantity'];
                                $totalPrice += $subTotal;
                            @endphp
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ htmlspecialchars($cart['product_name']) }}</span>
                                <strong>{{ number_format($subTotal, 0, ',', '.') }}₫</strong>
                            </li>
                        @endforeach

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
                                @if ($totalPrice >= $freeShippingThreshold)
                                    0₫ (Miễn phí)
                                @else
                                    {{ number_format($shippingFee, 0, ',', '.') }}₫
                                @endif
                            </strong>
                        </li>

                        <!-- Tổng tiền -->
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Tổng cộng</strong>
                            <strong id="total_amount_display">
                                {{ number_format($totalPrice + ($totalPrice >= $freeShippingThreshold ? 0 : $shippingFee), 0, ',', '.') }}₫
                            </strong>
                            <input type="hidden" name="total_amount" id="total_amount" value="{{ $totalPrice }}">
                            <input type="hidden" id="base_total" value="{{ $totalPrice }}"> <!-- Lưu tổng gốc -->
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

        document.addEventListener("DOMContentLoaded", function() {
            updateTotal();

            document.getElementById('apply_coupon').addEventListener('click', async function() {
                let couponCode = document.getElementById('coupon_code').value.trim();
                let baseTotal = parseFloat(document.getElementById('base_total').value);
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

                    discountedTotal = Math.max(0, discountedTotal);
                    document.getElementById('total_amount').value =
                        discountedTotal;

                    document.getElementById('coupon_message').textContent =
                        "Mã giảm giá đã được áp dụng!";
                    document.getElementById('coupon_message').classList.remove('text-danger');
                    document.getElementById('coupon_message').classList.add('text-success');

                    updateTotal();

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
            let totalAmount = parseFloat(document.getElementById('total_amount').value);
            let shippingFee = calculateShippingFee(totalAmount);

            // Cập nhật phí ship hiển thị
            document.getElementById('shipping_fee_display').textContent = shippingFee === 0 ? `0₫ (Miễn phí)` :
                new Intl.NumberFormat('vi-VN').format(shippingFee) + "₫";

            // Tổng tiền cuối cùng
            let finalTotal = totalAmount + shippingFee;
            document.getElementById('total_amount_display').textContent = new Intl.NumberFormat('vi-VN')
                .format(finalTotal) + '₫';
            document.getElementById('total_amount').value = finalTotal;
        }

        /**
         * Hàm kiểm tra và tính phí vận chuyển
         * Nếu tổng >= 300.000đ thì free ship
         */
        function calculateShippingFee(totalAmount) {
            let freeShippingThreshold = 300000;
            let shippingFee = 20000;

            return totalAmount >= freeShippingThreshold ? 0 : shippingFee;
        }
    </script>
@endsection
