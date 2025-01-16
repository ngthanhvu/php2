<h2>Create Post</h2>
<form method="POST" class="needs-validation" novalidate>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control <?php echo isset($errors['title']) ? 'is-invalid' : ''; ?>" id="title" name="title" required>
        <div class="invalid-feedback">
            <?php echo isset($errors['title']) ? $errors['title'] : 'Please enter the post title.'; ?>
        </div>
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control <?php echo isset($errors['content']) ? 'is-invalid' : ''; ?>" id="content" name="content" required></textarea>
        <div class="invalid-feedback">
            <?php echo isset($errors['content']) ? $errors['content'] : 'Please enter the post content.'; ?>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>