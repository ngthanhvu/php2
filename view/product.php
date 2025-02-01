<?php
// var_dump($products);
?>
<div class="mt-5">
    <div class="row">
        <!-- Filter Column -->
        <div class="col-md-3">
            <h4>Filters</h4>
            <div class="list-group">
                <?php foreach ($categories as $category): ?>
                <button type="button" class="list-group-item list-group-item-action"><?= $category['name'] ?></button>
                <?php endforeach ?>
                
            </div>
            <div class="mt-4">
                <h5>Price Range</h5>
                <input type="range" class="form-range" min="0" max="1000" step="10">
                <div class="d-flex justify-content-between">
                    <span>$0</span>
                    <span>$1000</span>
                </div>
            </div>
        </div>

        <!-- Products Column -->
        <div class="col-md-9">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <select class="form-select w-auto">
                    <option selected>Sort by</option>
                    <option value="1">Price: Low to High</option>
                    <option value="2">Price: High to Low</option>
                    <option value="3">Newest</option>
                </select>
            </div>
            <div class="row">
                <!-- Product 1 -->
                <?php foreach ($products as $product): ?>
                <a href="/detail/<?php echo $product['id'] ?>" class="text-decoration-none text-success">
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 hover-card" style="width: 18rem;">
                            <img src="<?php echo $product['image'] ?>" class="card-img-top" alt="No images" width="290"
                                height="140" style="object-fit: contain;">
                            <div class="mt-2">
                                <h5 class="card-title"><?php echo $product['name'] ?></h5>
                                <span class="badge text-bg-success">Số lượng: <?php echo $product['quantity'] ?> cái</span><span
                                    class="badge text-bg-danger ms-2"><?php echo $product['category_name'] ?></span><br>
                                <div class="prices mt-2"><span><?php echo number_format($product['price'], 0, ',', '.') ?>đ</span><span
                                        class="text-muted text-decoration-line-through ms-2"> 20.000đ</span></div>
                            </div>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<style>
    .hover-card {
        overflow: hidden;
        /* Đảm bảo nội dung không tràn ra ngoài */
        position: relative;
        /* Để giữ phần ảnh trong card */
    }

    .hover-card img {
        transition: transform 0.3s ease;
        /* Tạo hiệu ứng chuyển đổi mượt mà */
    }

    .hover-card:hover img {
        transform: scale(1.1);
        /* Phóng to ảnh khi hover */
    }
</style>