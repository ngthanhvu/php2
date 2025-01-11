<h2>Đây là trang chủ nhé :)))</h2>
<?php foreach ($posts as $post) : ?>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title"><?php echo $post['title']; ?></h5>
            <p class="card-text"><?php echo $post['content']; ?></p>
            <a href="<?php echo '/posts/show/' . $post['id']; ?>" class="btn btn-primary">View</a>
        </div>
    </div>
<?php endforeach; ?>