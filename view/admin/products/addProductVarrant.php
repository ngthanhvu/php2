<h2>Thêm products varriant</h2>
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
</form>
<script>
    function generateSku() {
        const randSku = 'SKU-' + Math.floor(Math.random() * 1000000);
        const skuInput = document.getElementById('sku');
        skuInput.value = randSku;
    }

    document.addEventListener('DOMContentLoaded', function() {
        generateSku();
    });
</script>