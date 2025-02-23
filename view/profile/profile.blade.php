@extends('layouts.master')

@section('content')
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
                            @php
                                // var_dump($users);
                            @endphp
                            <form action="/profile/update" method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Tên đăng nhập</label>
                                    <input type="text" name="username" class="form-control"
                                        value="{{ $users['username'] }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    @if ($users['oauth_provider'] == 'google')
                                        <input type="email" class="form-control bg-light" name="email"
                                            value="{{ $users['email'] }}" readonly>
                                        <small class="text-muted">Địa chỉ email này được liên kết với tài khoản
                                            Google</small>
                                    @else
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $users['email'] }}" placeholder="Chưa cập nhật">
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $users['phone'] }}"
                                        placeholder="Chưa cập nhật">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" name="address"
                                        value="{{ $users['address'] }}"
                                        placeholder="Chưa cập nhật (ví du: 123 đường ABC, phường XYZ, quận TUV)">
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="history">
                            <h5 class="card-title">Lịch sử</h5>
                            <ul class="list-group">
                                @forelse ($orders as $order)
                                    <li class="list-group-item">
                                        Giao dịch #{{ $order['id'] }} -
                                        {{ number_format($order['total_amount'], 0, ',', '.') }} ₫ -
                                        {{ $order['created_at'] }}
                                        <button class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                                            data-bs-target="#orderDetail{{ $order['id'] }}">Chi tiết</button>
                                    </li>
                                    <div class="modal fade" id="orderDetail{{ $order['id'] }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Chi tiết đơn hàng #{{ $order['id'] }}</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Phương thức thanh toán:</strong>
                                                        {{ ucfirst($order['payment_method']) }}</p>
                                                    <p><strong>Địa chỉ giao hàng:</strong> {{ $order['shipping_address'] }}
                                                    </p>
                                                    <p><strong>Trạng thái:</strong> {{ ucfirst($order['status']) }}</p>
                                                    <p><strong>Tổng tiền:</strong>
                                                        {{ number_format($order['total_amount'], 0, ',', '.') }} ₫</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class='text-center mx-auto'>Không tìm thấy giao dịch</p>
                                @endforelse
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
@endsection
