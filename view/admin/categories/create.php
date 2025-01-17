<h1>Create Category</h1>
<form method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input
            type="text"
            class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>"
            id="name"
            name="name" placeholder="Enter name">
        <?php if (isset($errors['name'])): ?>
            <div class="invalid-feedback">
                <?= $errors['name'] ?>
            </div>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-success">Create</button>
</form>