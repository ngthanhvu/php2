<h2>Tạo sản phẩm</h2>
<form method="POST" class="needs-validation" novalidate>
    <div class="mb-3">
        <label for="name" class="form-label">Tên sản phẩm</label>
        <input type="text" class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" id="name" name="name" placeholder="Nhập tên sản phẩm">
        <div class="invalid-feedback">
            <?php echo isset($errors['name']) ? $errors['name'] : 'Please enter the product name.'; ?>
        </div>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Giá</label>
        <input type="text" class="form-control <?php echo isset($errors['price']) ? 'is-invalid' : ''; ?>" id="price" name="price" placeholder="Nhập giá sản phẩm">
        <div class="invalid-feedback">
            <?php echo isset($errors['price']) ? $errors['price'] : 'Please enter the price.'; ?>
        </div>
    </div>

    <div class="mb-3">
        <label for="quantity" class="form-label">Số lượng</label>
        <input type="text" class="form-control <?php echo isset($errors['quantity']) ? 'is-invalid' : ''; ?>" id="quantity" name="quantity" placeholder="Nhập số lượng">
        <div class="invalid-feedback">
            <?php echo isset($errors['quantity']) ? $errors['quantity'] : 'Please enter the quantity.'; ?>
        </div>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Hình ảnh</label>
        <input type="text" class="form-control <?php echo isset($errors['image']) ? 'is-invalid' : ''; ?>" id="image" name="image" value="https://storage.googleapis.com/pr-newsroom-wp/1/2023/05/Spotify_Primary_Logo_RGB_Green.png" required>
        <div class="invalid-feedback">
            <?php echo isset($errors['image']) ? $errors['image'] : 'Please enter an image URL.'; ?>
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
        <textarea class="form-control <?php echo isset($errors['description']) ? 'is-invalid' : ''; ?>" id="description" name="description" placeholder="Nhập mô tả sản phẩm"></textarea>
        <div class="invalid-feedback">
            <?php echo isset($errors['description']) ? $errors['description'] : 'Please enter a product description.'; ?>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>