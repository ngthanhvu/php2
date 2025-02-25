@extends('layouts.master')

@section('content')
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
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="address">
                            <h5 class="card-title">Địa chỉ</h5>
                            <ul class="list-group">
                                @foreach ($addresses as $address)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            Họ tên: <strong>{{ $address['full_name'] }}</strong><br>
                                            Số điện: <strong>{{ $address['phone'] }}</strong><br>
                                            Địa chỉ: <strong>{{ $address['address'] }}</strong>
                                        </div>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editAddress{{ $address['id'] }}">Chỉnh sửa</button>
                                    </li>
                                    <div class="modal fade" id="editAddress{{ $address['id'] }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Chỉnh sửa địa chỉ</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/profile/address/update/{{ $address['id'] }}"
                                                        method="POST">
                                                        <div class="mb-2">
                                                            <label class="form-label">Họ và tên</label>
                                                            <input type="text" class="form-control" name="full_name"
                                                                value="{{ $address['full_name'] }}">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label">Số điện thoại</label>
                                                            <input type="text" class="form-control" name="phone"
                                                                value="{{ $address['phone'] }}">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label">Địa chỉ</label>
                                                            <input type="text" class="form-control" name="address"
                                                                value="{{ $address['address'] }}">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
                        {{-- <div class="tab-pane fade" id="history">
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
                                @empty
                                    <p class='text-center mx-auto'>Không tìm thấy giao dịch</p>
                                @endforelse
                            </ul>
                        </div> --}}
                        <div class="tab-pane fade" id="history">
                            <h5 class="card-title">Lịch sử đơn hàng</h5>
                            <ul class="list-group" id="order-list">
                                @foreach ($orders as $order)
                                    <li class="list-group-item order-item">
                                        <strong>Giao dịch #{{ $order['id'] }}</strong> -
                                        <span
                                            class="badge bg-{{ $order['status'] == 'completed' ? 'success' : ($order['status'] == 'canceled' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($order['status']) }}
                                        </span>
                                        <br>
                                        <strong>Số tiền:</strong> {{ number_format($order['total_amount'], 0, ',', '.') }}
                                        ₫ <br>
                                        <strong>Ngày tạo:</strong> {{ $order['created_at'] }}

                                        <button class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                                            data-bs-target="#orderDetail{{ $order['id'] }}">Chi tiết</button>
                                    </li>

                                    <!-- Modal chi tiết đơn hàng -->
                                    <div class="modal fade" id="orderDetail{{ $order['id'] }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Chi tiết đơn hàng #{{ $order['id'] }}</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Mã đơn hàng:</strong> {{ $order['code'] ?? 'Chưa có mã' }}
                                                    </p>
                                                    <p><strong>Trạng thái:</strong>
                                                        <span
                                                            class="badge bg-{{ $order['status'] == 'completed' ? 'success' : ($order['status'] == 'canceled' ? 'danger' : 'warning') }}">
                                                            {{ ucfirst($order['status']) }}
                                                        </span>
                                                    </p>
                                                    <p><strong>Phương thức thanh toán:</strong>
                                                        {{ strtoupper($order['payment_method']) }}</p>
                                                    <p><strong>Tổng tiền:</strong>
                                                        {{ number_format($order['total_amount'], 0, ',', '.') }} ₫</p>
                                                    <p><strong>Địa chỉ giao hàng:</strong> {{ $order['shipping_address'] }}
                                                    </p>
                                                    <p><strong>Ngày tạo:</strong> {{ $order['created_at'] }}</p>
                                                    <p><strong>Ngày cập nhật:</strong> {{ $order['updated_at'] }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
            const ordersPerPage = 5;
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
@endsection
