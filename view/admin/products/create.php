<h2>Create Product</h2>
<form method="POST" class="needs-validation" novalidate>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" id="name" name="name" required>
        <div class="invalid-feedback">
            <?php echo isset($errors['name']) ? $errors['name'] : 'Please enter the product name.'; ?>
        </div>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="text" class="form-control <?php echo isset($errors['price']) ? 'is-invalid' : ''; ?>" id="price" name="price" required>
        <div class="invalid-feedback">
            <?php echo isset($errors['price']) ? $errors['price'] : 'Please enter the price.'; ?>
        </div>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="text" class="form-control <?php echo isset($errors['image']) ? 'is-invalid' : ''; ?>" id="image" name="image" value="https://storage.googleapis.com/pr-newsroom-wp/1/2023/05/Spotify_Primary_Logo_RGB_Green.png" required>
        <div class="invalid-feedback">
            <?php echo isset($errors['image']) ? $errors['image'] : 'Please enter an image URL.'; ?>
        </div>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control <?php echo isset($errors['description']) ? 'is-invalid' : ''; ?>" id="description" name="description" required></textarea>
        <div class="invalid-feedback">
            <?php echo isset($errors['description']) ? $errors['description'] : 'Please enter a product description.'; ?>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>