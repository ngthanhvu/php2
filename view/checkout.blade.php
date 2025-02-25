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
                        <div id="existing-addresses">
                            @foreach ($addresses as $address)
                                <div class="form-check">
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
                                value="{{ $user->name ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Nhập email"
                                value="{{ $user->email ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại"
                                value="{{ $user->phone ?? '' }}">
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

                    <!-- Tóm tắt đơn hàng -->
                    <h4 class="mt-4">Tóm tắt đơn hàng</h4>
                    <ul class="list-group mb-3">
                        <?php $totalPrice = 0; ?>
                        <?php foreach ($carts as $cart): ?>
                        <?php $subTotal = $cart['price'] * $cart['quantity']; ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><?= htmlspecialchars($cart['product_name']) ?></span>
                            <strong><?= number_format($subTotal, 0, ',', '.') ?>₫</strong>
                        </li>
                        <?php $totalPrice += $subTotal; ?>
                        <?php endforeach; ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Tổng cộng</strong>
                            <strong><?= number_format($totalPrice, 0, ',', '.') ?>₫</strong>
                            <input type="hidden" name="total_amount" value="<?= $totalPrice ?>">
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
    </script>
@endsection
