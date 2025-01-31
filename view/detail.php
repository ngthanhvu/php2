<div class="mt-3">
    <div class="row">
        <!-- Image -->
        <div class="col-md-6">
            <img src="<?php echo $product['image']; ?>" class="img-fluid image-format" alt="Elden Ring">
            <a href="#" class="d-block mt-2 text-center text-primary">Xem thêm ảnh</a>
        </div>
        <!-- Product Details -->
        <div class="col-md-6">
            <h3><?php echo $product['name']; ?></h3>
            <p class="text-danger">Tình trạng: Hết hàng</p>
            <p><strong>Mã sản phẩm:</strong> cdkey 1245620</p>
            <p><strong>Danh mục:</strong> <?php echo $product['category_name']; ?></p>
            <h4 class="text-primary"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</h4>
            <p class="text-muted">
                <del><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</del> <span class="badge bg-danger">-1%</span>
            </p>
            <!-- sku -->
            <hr>
            <p>Loại: </p>
            <div class="mb-3 d-flex gap-2 flex-wrap">
                <button class="btn btn-outline-primary">Mua bằng Steam Wallet</button>
                <button class="btn btn-outline-primary">Mua bằng Steam Wallet</button>
                <button class="btn btn-outline-primary">Mua bằng Steam Wallet</button>
                <button class="btn btn-outline-primary">Mua bằng Steam Wallet</button>
                <button class="btn btn-outline-primary">Mua bằng Steam Wallet</button>
                <button class="btn btn-outline-primary">Mua bằng Steam Wallet</button>
            </div>
            <hr>
            <div class="d-flex gap-2">
                <button class="btn btn-primary">Thông báo khi có hàng</button>
                <button class="btn btn-outline-secondary">Thêm vào giỏ</button>
            </div>
        </div>
    </div>

    <!-- Notice -->
    <div class="alert alert-success mt-4">
        Để mua game này bạn click vào nút <strong>"Mua bằng Steam Wallet"</strong> để hệ thống lựa chọn các sản phẩm
        phù hợp.<br>
        Tham khảo hướng dẫn tại <a href="#" class="text-primary">ĐÂY</a> nhé ^^
    </div>
    <p class="text-danger"><strong>Lưu ý:</strong> Giá game trên Divine có thể chưa cập nhật do Steam thay đổi...
    </p>

    <!-- Region Notice -->
    <div class="alert alert-warning">
        CD KEY kích hoạt trên hệ thống STEAM và chỉ dành cho tài khoản region Việt Nam.
    </div>

    <!-- Product Description -->
    <h4>Chi tiết sản phẩm</h4>
    <p>
        <?php echo $product['description']; ?>
    </p>
</div>

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img id="fullImage" src="" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const image = document.querySelector(".image-format");
        const fullImage = document.getElementById("fullImage");

        image.addEventListener("click", function() {
            fullImage.src = this.src; // Lấy src từ ảnh nhỏ
            new bootstrap.Modal(document.getElementById("imageModal")).show(); // Mở modal
        });
    });
</script>


<style>
    .image-format {
        width: 700px;
        height: 400px;
        object-fit: contain;
        cursor: pointer;
    }
</style>