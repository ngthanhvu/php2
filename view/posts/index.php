<h2>List posts</h2>
<a href="/posts/create" class="btn btn-primary mb-3">Create Posts</a>
<table class="table table-striped table-bordered table-hover text-center">
    <thead class="table-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($posts as $post) : ?>
            <tr>
                <th scope="row"><?= $post['id'] ?></th>
                <td><?= $post['title'] ?></td>
                <td><?= $post['content'] ?></td>
                <td>
                    <a href="/posts/show/<?= $post['id'] ?>" class="btn btn-primary">View</a>
                    <a href="/posts/update/<?= $post['id'] ?>" class="btn btn-success">Edit</a>
                    <a href="/posts/delete/<?= $post['id'] ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($posts)) echo "<tr><td colspan='4'>No posts found.</td></tr>"; ?>
    </tbody>
</table>