
<?php $__env->startSection('content'); ?>
    <div class="p-3 mb-4 rounded-3 bg-light">
        <h2>Thêm biến thể sản phẩm</h2>
    </div>
    <div class="p-3 mb-4 rounded-3 bg-light w-50 mx-auto">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control bg-light" value="<?= $product['name'] ?>" readonly>
                <input type="hidden" class="form-control" id="product_id" name="product_id" value="<?= $product['id'] ?>">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Màu sắc</label>
                <select class="form-select" aria-label="Default select example" name="color_id">
                    <option selected>-- Chọn màu sắc --</option>
                    <?php foreach ($colors as $color) : ?>
                    <option value="<?= $color['id'] ?>"><?= $color['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <?php
                if (isset($errors['color_id'])) {
                    echo '<p class="text-danger">' . $errors['color_id'] . '</p>';
                }
                ?>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Kích cỡ</label>
                <select class="form-select" aria-label="Default select example" name="size_id">
                    <option selected>-- Chọn kích cỡ --</option>
                    <?php foreach ($sizes as $size) : ?>
                    <option value="<?= $size['id'] ?>"><?= $size['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <?php
                if (isset($errors['size_id'])) {
                    echo '<p class="text-danger">' . $errors['size_id'] . '</p>';
                }
                ?>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá tiền</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Nhập giá tiền">
                <?php
                if (isset($errors['price'])) {
                    echo '<p class="text-danger">' . $errors['price'] . '</p>';
                }
                ?>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Số lượng</label>
                <input type="text" class="form-control" id="price" name="quantity" placeholder="Nhập số lượng">
                <?php
                if (isset($errors['quantity'])) {
                    echo '<p class="text-danger">' . $errors['quantity'] . '</p>';
                }
                ?>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Hình ảnh</label>
                <input type="file" class="form-control" id="price" name="image" placeholder="Nhập link ảnh">
                <?php
                if (isset($errors['image'])) {
                    echo '<p class="text-danger">' . $errors['image'] . '</p>';
                }
                ?>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">SKU</label>
                <input type="text" class="form-control" id="sku" name="sku">
                <?php
                if (isset($errors['sku'])) {
                    echo '<p class="text-danger">' . $errors['sku'] . '</p>';
                }
                if (isset($errors['duplicate'])) {
                    echo '<p class="text-danger">' . $errors['duplicate'] . '</p>';
                }
                ?>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
            <a href="/admin/products" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Nếu có lỗi trùng lặp, hiển thị cảnh báo trước khi submit
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                const duplicateError = document.querySelector('.text-danger.duplicate');
                if (duplicateError) {
                    alert("Sản phẩm với SKU, màu sắc và kích thước này đã tồn tại!");
                    event.preventDefault(); // Chặn submit
                }
            });

            // Tự động tạo SKU nếu không nhập
            function generateSku() {
                const randSku = 'SKU-' + Math.floor(Math.random() * 1000000);
                const skuInput = document.getElementById('sku');
                if (skuInput.value.trim() === '') {
                    skuInput.value = randSku;
                }
            }

            generateSku();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/admin/products/addProductVarrant.blade.php ENDPATH**/ ?>