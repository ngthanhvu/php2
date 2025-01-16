<h2>Products List</h2>
<a href="/products/create" class="btn btn-primary">Create Product</a>
<table class="table table-striped table-bordered table-hover text-center mt-3">
    <thead class="table-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product) : ?>
            <tr>
                <th scope="row"><?= $product['id'] ?></th>
                <td><?= $product['name'] ?></td>
                <td><?= $product['price'] ?></td>
                <td><?= $product['description'] ?></td>
                <td><img src="<?= $product['image'] ?>" alt="No image" width="100"></td>
                <td>
                    <a href="/products/update/<?= $product['id'] ?>" class="btn btn-success">Edit</a>
                    <a href="/products/delete/<?= $product['id'] ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($products)) : ?>
            <tr>
                <td colspan="6">No products</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>