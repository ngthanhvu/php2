<h2>Thêm products varriant</h2>
<form method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Tên sản phẩm</label>
        <input type="text" class="form-control bg-light" value="<?= $product['name'] ?>" readonly>
        <input type="hidden" class="form-control" id="product_id" name="product_id" value="<?= $product['id'] ?>">
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Tên biến thể</label>
        <input type="text" class="form-control" id="price" name="variant_name" placeholder="Nhập tên biến thể">
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Giá tiền</label>
        <input type="text" class="form-control" id="price" name="price" placeholder="Nhập giá tiền">
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Số lượng</label>
        <input type="text" class="form-control" id="price" name="quantity" placeholder="Nhập số lượng">
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Hình ảnh</label>
        <input type="text" class="form-control" id="price" name="image" placeholder="Nhập link ảnh">
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Mô tả</label>
        <textarea type="text" class="form-control" id="price" name="description" placeholder="Nhập mô tả"></textarea>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">SKU</label>
        <input type="text" class="form-control" id="sku" name="sku">
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