<h2>Edit Post</h2>
<form method="POST">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $post['title'] ?>">
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content"><?= $post['content'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>