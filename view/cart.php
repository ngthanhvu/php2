<div class="card border-success">
    <div class="card-header text-white" style="background-color: #FE5722; border-color: #FE5722">
        <h5 class="mb-0"><i class="fa-solid fa-cart-shopping"></i> Giỏ hàng</h5>
    </div>
</div>
<table class="table table-bordered table-hover table-striped text-center mt-2">
    <thead>
        <tr>
            <th>STT</th>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <!-- <td>1</td>
            <td><img src="https://picsum.photos/200/300" alt="No image" width="100"></td>
            <td>iPhone 13 Pro Max</td>
            <td>20.000.000đ</td>
            <td>1</td>
            <td>20.000.000đ</td> -->
        </tr>
    </tbody>
    <?php
    if (empty($carts)) {
        echo "<tr><td colspan='6'>Khong tim thay san pham</td></tr>";
    }
    ?>
</table>