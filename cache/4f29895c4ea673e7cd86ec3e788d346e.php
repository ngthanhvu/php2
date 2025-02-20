
<?php $__env->startSection('content'); ?>
    <div class="p-3 mb-4 rounded-3 bg-light">

        <h2>Tạo sản phẩm</h2>
    </div>
    <div class="p-3 mb-4 rounded-3 bg-light w-50 mx-auto">
        <form method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" id="name" name="name"
                    placeholder="Nhập tên sản phẩm">
                <div class="invalid-feedback">
                    <?php echo isset($errors['name']) ? $errors['name'] : 'Please enter the product name.'; ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="text" class="form-control <?php echo isset($errors['price']) ? 'is-invalid' : ''; ?>" id="price" name="price"
                    placeholder="Nhập giá sản phẩm">
                <div class="invalid-feedback">
                    <?php echo isset($errors['price']) ? $errors['price'] : 'Please enter the price.'; ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Số lượng</label>
                <input type="text" class="form-control <?php echo isset($errors['quantity']) ? 'is-invalid' : ''; ?>" id="quantity" name="quantity"
                    placeholder="Nhập số lượng">
                <div class="invalid-feedback">
                    <?php echo isset($errors['quantity']) ? $errors['quantity'] : 'Please enter the quantity.'; ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh chính</label>
                <input type="file" class="form-control <?php echo isset($errors['image']) ? 'is-invalid' : ''; ?>" id="image" name="image"
                    placeholder="Nhập URL hình ảnh">
                <div class="invalid-feedback">
                    <?php echo isset($errors['image']) ? $errors['image'] : 'Please enter an image URL.'; ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh phụ</label>
                <input type="file" class="form-control <?php echo isset($errors['image']) ? 'is-invalid' : ''; ?>" id="sub_images" name="sub_images[]"
                    placeholder="Nhập URL hình ảnh" multiple>
                <div class="invalid-feedback">
                    <?php echo isset($errors['image_secondary']) ? $errors['image_secondary'] : 'Please enter an image URL.'; ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="categories" class="form-label">Danh mục</label>
                <select class="form-control <?php echo isset($errors['categories_id']) ? 'is-invalid' : ''; ?>" id="categories" name="categories_id" required>
                    <option value="">-- Chọn danh mục --</option>
                    <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <?php echo isset($errors['categories_id']) ? $errors['categories_id'] : 'Please select a category.'; ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control <?php echo isset($errors['description']) ? 'is-invalid' : ''; ?>" id="description" name="description"
                    placeholder="Nhập mô tả sản phẩm"></textarea>
                <div class="invalid-feedback">
                    <?php echo isset($errors['description']) ? $errors['description'] : 'Please enter a product description.'; ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">SKU</label>
                <input type="text" class="form-control" id="sku" name="sku">
                <?php
                if (isset($errors['sku'])) {
                    echo '<p class="text-danger">' . $errors['sku'] . '</p>';
                }
                ?>
            </div>

            <button type="submit" class="btn btn-primary">Tạo sản phẩm</button>
        </form>
    </div>

    <script>
        function generateSku() {
            const randSku = 'SKU-' + Math.floor(Math.random() * 1000000);
            const skuInput = document.getElementById('sku');
            if (skuInput.value.trim() === '') {
                skuInput.value = randSku;
            }
        }

        generateSku();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/admin/products/create.blade.php ENDPATH**/ ?>