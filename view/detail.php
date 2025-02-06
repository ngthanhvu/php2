<div class="mt-3">
    <div class="row">
        <!-- Image -->
        <div class="col-md-6">
            <img src="http://localhost:8000/<?php echo $product['image']; ?>" class="img-fluid image-format" alt="Elden Ring">
            <a href="#" class="d-block mt-2 text-center">Xem thêm ảnh</a>
        </div>
        <!-- Product Details -->
        <div class="col-md-6">
            <h3><?php echo $product['name']; ?></h3>
            <!-- <p class="text-danger">Tình trạng: Hết hàng</p> -->
            <p><strong>Mã sản phẩm:</strong> <span class="sku-text">Không có SKU</span></p>
            <p><strong>Danh mục:</strong> <?php echo $product['category_name']; ?></p>
            <h4 class="text-primary"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</h4>
            <p class="text-muted">
                <del><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</del> <span class="badge bg-danger">-1%</span>
            </p>
            <!-- sku -->
            <hr>
            <!-- Màu sắc -->
            <p>Màu sắc: </p>
            <div class="mb-3 d-flex gap-2 flex-wrap">
                <?php foreach ($products_varriants as $variant) : ?>
                    <button class="btn btn-outline-primary color-button"><?php echo $variant['color_name']; ?></button>
                <?php endforeach; ?>
            </div>

            <!-- Kích cỡ -->
            <p>Kích cỡ: </p>
            <div class="mb-3 d-flex gap-2 flex-wrap">
                <?php foreach ($products_varriants as $variant) : ?>
                    <button class="btn btn-outline-primary size-button"><?php echo $variant['size_name']; ?></button>
                <?php endforeach; ?>
            </div>

            <hr>
            <div class="d-flex gap-2">
                <button class="btn btn-primary">Thông báo khi có hàng</button>
                <button class="btn btn-outline-secondary">Thêm vào giỏ</button>
            </div>
        </div>
    </div>
    <!-- Product Description -->
    <h4 class="mt-3">Chi tiết sản phẩm</h4>
    <p>
        <?php echo $product['description']; ?>
        <?php
        echo "<pre>";
        // var_dump($products_varriants);
        echo "</pre>";
        ?>
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
        const variants = <?php echo json_encode($products_varriants); ?>;
        const imageElement = document.querySelector(".image-format");
        const priceElement = document.querySelector(".text-primary");
        const skuElement = document.querySelector(".sku-text");
        const colorButtons = document.querySelectorAll(".color-button");
        const sizeButtons = document.querySelectorAll(".size-button");

        let selectedColor = null;
        let selectedSize = null;

        function updateVariantDisplay() {
            const selectedVariant = variants.find(variant =>
                (selectedColor === null || variant.color_name === selectedColor) &&
                (selectedSize === null || variant.size_name === selectedSize)
            );

            if (selectedVariant) {
                imageElement.src = "http://localhost:8000/" + selectedVariant.image;
                priceElement.textContent = new Intl.NumberFormat('vi-VN').format(selectedVariant.price) + "đ";
                skuElement.textContent = selectedVariant.sku ? selectedVariant.sku : "Không có SKU";
            } else {
                skuElement.textContent = "Không có SKU";
            }
        }

        // Xử lý sự kiện click trên nút màu sắc
        colorButtons.forEach(button => {
            button.addEventListener("click", function() {
                colorButtons.forEach(btn => btn.classList.remove("active"));
                this.classList.add("active");
                selectedColor = this.textContent.trim();
                updateVariantDisplay();
            });
        });

        // Xử lý sự kiện click trên nút kích cỡ
        sizeButtons.forEach(button => {
            button.addEventListener("click", function() {
                sizeButtons.forEach(btn => btn.classList.remove("active"));
                this.classList.add("active");
                selectedSize = this.textContent.trim();
                updateVariantDisplay();
            });
        });

        // Xử lý hiển thị ảnh lớn khi click vào ảnh sản phẩm
        const fullImage = document.getElementById("fullImage");
        imageElement.addEventListener("click", function() {
            fullImage.src = this.src;
            new bootstrap.Modal(document.getElementById("imageModal")).show();
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