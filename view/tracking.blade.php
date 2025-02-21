@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Tra Cứu Đơn Hàng</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" id="trackingCode" class="form-control" placeholder="Nhập mã đơn hàng">
                    <button class="btn btn-primary" id="trackOrder">Tra cứu</button>
                </div>
            </div>
        </div>

        <div id="orderInfo" class="mt-4" style="display: none;">
            <h4>Thông tin đơn hàng</h4>
            <div class="card">
                <div class="card-body">
                    <div class="progress-tracker d-flex justify-content-between align-items-center">
                        <div class="step completed">
                            <span class="icon">📦</span>
                            <p>Đơn Hàng Đã Đặt</p>
                        </div>
                        <div class="step completed">
                            <span class="icon">💰</span>
                            <p>Đã Xác Nhận Thanh Toán</p>
                        </div>
                        <div class="step active">
                            <span class="icon">🚚</span>
                            <p>Chờ Lấy Hàng</p>
                        </div>
                        <div class="step">
                            <span class="icon">📦</span>
                            <p>Đang Giao</p>
                        </div>
                        <div class="step">
                            <span class="icon">⭐</span>
                            <p>Đánh Giá</p>
                        </div>
                    </div>
                    <hr>
                    <p><strong>Mã đơn hàng:</strong> <span id="orderId"></span></p>
                    <p><strong>Ngày đặt:</strong> <span id="orderDate"></span></p>
                    <p><strong>Trạng thái:</strong> <span id="orderStatus"></span> <span id="orderIcon"></span></p>
                    <p><strong>Tổng tiền:</strong> <span id="orderTotal"></span></p>
                    <p><strong>Địa chỉ giao hàng:</strong> <span id="orderAddress"></span></p>
                </div>
            </div>
        </div>

        <div id="noOrderMessage" class="text-center text-danger mt-4" style="display: none;">
            <h5>Không tìm thấy đơn hàng với mã <span id="enteredTrackingCode"></span></h5>
        </div>
    </div>

    <style>
        .progress-tracker {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .step {
            text-align: center;
            opacity: 0.5;
        }

        .step.completed {
            opacity: 1;
        }

        .step.active {
            font-weight: bold;
            opacity: 1;
        }

        .icon {
            font-size: 24px;
        }
    </style>

    <script>
        document.getElementById("trackOrder").addEventListener("click", async function() {
            let trackingCode = document.getElementById("trackingCode").value.trim();
            document.getElementById("enteredTrackingCode").textContent = trackingCode;
            if (trackingCode === "") {
                alert("Vui lòng nhập mã đơn hàng.");
                return;
            }

            try {
                let response = await fetch(`/tracking/get/${trackingCode}`);
                let orderData = await response.json();

                if (!response.ok || orderData.success === false) {
                    document.getElementById("orderInfo").style.display = "none";
                    document.getElementById("noOrderMessage").style.display = "block";
                    return;
                }

                let statusMap = {
                    "pending": "🕒 Chờ thanh toán",
                    "processing": "💰 Đã xác nhận thanh toán",
                    "shipping": "🚚 Đang giao hàng",
                    "delivered": "✅ Đã giao",
                    "cancelled": "❌ Đã hủy"
                };

                document.getElementById("orderId").textContent = orderData.id;
                document.getElementById("orderDate").textContent = orderData.created_at;
                document.getElementById("orderStatus").textContent = statusMap[orderData.status] ||
                "❓ Không rõ";
                document.getElementById("orderIcon").textContent = statusMap[orderData.status] ? statusMap[
                    orderData.status][0] : "❓";
                document.getElementById("orderTotal").textContent = orderData.total_amount + " ₫";
                document.getElementById("orderAddress").textContent = orderData.shipping_address;
                document.getElementById("orderInfo").style.display = "block";
                document.getElementById("noOrderMessage").style.display = "none";
            } catch (error) {
                document.getElementById("orderInfo").style.display = "none";
                document.getElementById("noOrderMessage").style.display = "block";
            }
        });
    </script>
@endsection
