<h2>Edit Product</h2>
<form method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $product['name'] ?>">
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="text" class="form-control" id="price" name="price" value="<?= $product['price'] ?>">
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="text" class="form-control" id="image" name="image" value="<?= $product['image'] ?>">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea type="text" class="form-control" id="description" name="description"><?= $product['description'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>