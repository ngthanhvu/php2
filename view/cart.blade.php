@extends('layouts.master')
@section('content')

<?php
unset($_SESSION['cart_message']);
echo "<pre>";
// var_dump($carts);
echo "</pre>";
?>
<div class="card border-success">
    <div class="card-header text-white" style="background-color: #FE5722; border-color: #FE5722">
        <h5 class="mb-0"><i class="fa-solid fa-cart-shopping"></i> Giỏ hàng</h5>
    </div>
</div>
<?php if (!empty($carts)): ?>
    <table class="table table-bordered table-hover table-striped text-center mt-2">
        <thead>
            <tr>
                <th>STT</th>
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
            <tr>
                <?php
                $index = 1;
                $totalPrice = 0;
                ?>
                <?php foreach ($carts as $cart): ?>
            <tr>
                <th scope="row"><?= $index++ ?></th>
                <td><img src="http://localhost:8000/<?= $cart['product_image'] ?>" alt="No image" width="100"></td>
                <td><?= $cart['product_name'] ?></td>
                <td><?= $cart['product_size'] ?>, <?= $cart['product_color'] ?></td>
                <td><?= $cart['price'] ?></td>
                <td>
                    <button class="btn btn-outline-secondary btn-decrease" data-id="<?= $cart['id'] ?>">-</button>
                    <!-- <?= $cart['quantity'] ?> -->
                    <input type="number" class="quantity-input form-control text-center mx-2 d-inline border-0 bg-transparent" value="<?= $cart['quantity'] ?>" min="1" data-id="<?= $cart['id'] ?>" style="width: 70px; text-align: center; font-size: 1rem; font-weight: 500;">
                    <button class="btn btn-outline-secondary btn-increase" data-id="<?= $cart['id'] ?>">+</button>
                </td>
                <td><?= $totalPrice = $cart['price'] * $cart['quantity'] ?></td>
                <td>
                    <a href="/cart/delete/<?= $cart['id'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (!empty($carts)): ?>
            <tr>
                <td colspan="8" class="text-end"><a href="/cart/deleteAll" class="btn btn-danger btn-sm">Xoa tat ca</a></td>
            </tr>
        <?php endif; ?>
        </tr>
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        <h4>Tổng tiền: <?= $totalPrice ?></h4>
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
            button.addEventListener("click", function() {
                let input = this.nextElementSibling;
                let id = this.getAttribute("data-id");
                let quantity = parseInt(input.value) - 1;
                if (quantity >= 1) {
                    input.value = quantity;
                    updateCart(id, quantity);
                }
            });
        });

        document.querySelectorAll(".btn-increase").forEach(button => {
            button.addEventListener("click", function() {
                let input = this.previousElementSibling;
                let id = this.getAttribute("data-id");
                let quantity = parseInt(input.value) + 1;
                input.value = quantity;
                updateCart(id, quantity);
            });
        });

        document.querySelectorAll(".quantity-input").forEach(input => {
            input.addEventListener("change", function() {
                let id = this.getAttribute("data-id");
                let quantity = parseInt(this.value);
                if (quantity < 1 || isNaN(quantity)) {
                    this.value = 1;
                    quantity = 1;
                }
                updateCart(id, quantity);
            });
        });

        function updateCart(id, quantity) {
            fetch(`/cart/updateQuantity/${id}/${quantity}`, {
                    method: "GET",
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert("Có lỗi xảy ra!");
                    }
                })
                .catch(error => console.error("Lỗi:", error));
        }
    });
</script>
@endsection
