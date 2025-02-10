<div class="row mt-3">
    <!-- Hình ảnh sản phẩm -->
    <div class="col-md-6">
        <div class="d-flex flex-column align-items-center">
            <img id="mainImage" src="http://localhost:8000/<?php echo $product['image']; ?>" class="img-fluid rounded" alt="Product Image" data-bs-toggle="modal" data-bs-target="#imageModal">
            <div class="d-flex mt-3">
                <?php foreach ($products_varriants as $variant): ?>
                    <img src="http://localhost:8000/<?php echo $variant['image']; ?>" class="img-thumbnail me-2 thumbnail" width="60" height="60" data-image="http://localhost:8000/<?php echo $variant['image']; ?>">
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Thông tin sản phẩm -->
    <div class="col-md-6">
        <h2 id="productName"><?php echo $product['name']; ?></h2>
        <p class="text-muted">Danh mục: <?php echo $product['category_name']; ?></p>

        <div class="mb-3">
            <strong>Size:</strong>
            <div class="d-flex flex-wrap gap-2">
                <?php foreach ($products_varriants as $variant): ?>
                    <button class="btn btn-outline-danger size-btn"
                        data-size="<?php echo $variant['size_name']; ?>"
                        data-color="<?php echo $variant['color_name']; ?>"
                        data-price="<?php echo $variant['price']; ?>"
                        data-quantity="<?php echo $variant['quantity']; ?>"
                        data-image="http://localhost:8000/<?php echo $variant['image']; ?>">
                        <?php echo $variant['size_name']; ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="mb-3">
            <strong>Màu sắc:</strong>
            <div class="d-flex flex-wrap gap-2">
                <?php foreach ($products_varriants as $variant): ?>
                    <button class="btn btn-outline-danger color-btn"
                        data-size="<?php echo $variant['size_name']; ?>"
                        data-color="<?php echo $variant['color_name']; ?>"
                        data-price="<?php echo $variant['price']; ?>"
                        data-quantity="<?php echo $variant['quantity']; ?>"
                        data-image="http://localhost:8000/<?php echo $variant['image']; ?>">
                        <?php echo $variant['color_name']; ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="mb-3">
            <strong>Giá tiền:</strong> <span id="productPrice" class="fs-4 text-danger"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</span>
        </div>

        <div class="mb-3 d-flex align-items-center">
            <strong class="me-2">Số lượng:</strong>
            <button class="btn btn-outline-secondary" onclick="updateQuantity(-1)">-</button>
            <input type="text" id="quantity" class="form-control text-center mx-2" value="1" style="width: 50px;" readonly>
            <button class="btn btn-outline-secondary" onclick="updateQuantity(1)">+</button>
        </div>

        <button class="btn btn-danger w-50">Thêm Vào Giỏ Hàng</button>
    </div>
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


<?php
// var_dump($products_varriants);
?>

<script>
    // Cập nhật số lượng
    function updateQuantity(change) {
        let quantityInput = document.getElementById("quantity");
        let newQuantity = parseInt(quantityInput.value) + change;
        if (newQuantity >= 1) {
            quantityInput.value = newQuantity;
        }
    }
</script>