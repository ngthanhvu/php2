

<?php $__env->startSection('content'); ?>
    <div class="mt-5">
        <div class="row">
            <div class="col-md-2">
                <h4>Bộ lọc</h4>
                <div class="list-group">
                    <button type="button" class="list-group-item list-group-item-action filter-category active"
                        data-id="">Tất cả</button>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button" class="list-group-item list-group-item-action filter-category"
                            data-id="<?php echo e($category['id']); ?>"><?php echo e($category['name']); ?></button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="mt-4">
                    <h5>Khoảng giá</h5>
                    <input type="number" id="min_price" class="form-control mb-2" placeholder="Giá thấp nhất">
                    <input type="number" id="max_price" class="form-control mb-2" placeholder="Giá cao nhất">
                    <button class="btn w-100 mb-2 buton-color" id="applyFilter">Lọc</button>
                    <button class="btn btn-secondary w-100" id="clearFilter">Xóa bộ lọc</button>
                </div>
            </div>
            <div class="col-md-10">
                <div class="d-flex justify-content-end align-items-center mb-3">
                    <select class="form-select w-auto" id="sort">
                        <option selected>Sắp sếp theo</option>
                        <option value="low_to_high">Giá: Thấp đến Cao</option>
                        <option value="high_to_low">Giá: Cao đến Thấp</option>
                        <option value="newest">Mới nhất</option>
                    </select>
                </div>
                <div class="row" id="product-list">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 hover-card" style="width: 13rem;">
                                <a href="/detail/<?php echo e($product['id']); ?>" class="text-decoration-none text-success">
                                    <img src="<?php echo e($product['image']); ?>" class="card-img-top" alt="No images"
                                        style="object-fit: contain;">
                                    <div class="mt-2">
                                        <h5 class="card-title"><?php echo e($product['name']); ?></h5>
                                        <span class="badge text-bg-success">Số lượng: <?php echo e($product['quantity']); ?> cái</span>
                                        <span class="badge text-bg-danger ms-2"><?php echo e($product['category_name']); ?></span><br>
                                        <div class="prices mt-2">
                                            <span><?php echo e(number_format($product['price'], 0, ',', '.')); ?>đ</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <nav>
                    <ul class="pagination justify-content-center">
                        <?php for($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?php echo e($page == $i ? 'active' : ''); ?>">
                                <a class="page-link" href="?page=<?php echo e($i); ?>"><?php echo e($i); ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let selectedCategory = "";
            let minPrice = "";
            let maxPrice = "";

            document.querySelectorAll(".filter-category").forEach(button => {
                button.addEventListener("click", function() {
                    document.querySelectorAll(".filter-category").forEach(btn => btn.classList
                        .remove("active"));
                    this.classList.add("active");
                    selectedCategory = this.getAttribute("data-id");
                    applyFilters();
                });
            });

            document.getElementById("applyFilter").addEventListener("click", function() {
                minPrice = document.getElementById("min_price").value;
                maxPrice = document.getElementById("max_price").value;
                applyFilters();
            });

            document.getElementById("clearFilter").addEventListener("click", function() {
                document.getElementById("min_price").value = "";
                document.getElementById("max_price").value = "";
                document.querySelectorAll(".filter-category").forEach(btn => btn.classList.remove(
                    "active"));
                document.querySelector(".filter-category[data-id='']").classList.add("active");
                selectedCategory = "";
                minPrice = "";
                maxPrice = "";
                applyFilters();
            });

            function applyFilters() {
                fetch(`/product/filter?category_id=${selectedCategory}&min_price=${minPrice}&max_price=${maxPrice}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("product-list").innerHTML = "";
                        if (data.length > 0) {
                            data.forEach(product => {
                                let productHTML = `
                            <div class="col-md-3 mb-3">
                                <div class="card border-0 hover-card" style="width: 13rem;">
                                    <a href="/detail/${product.id}" class="text-decoration-none text-success">
                                        <img src="http://localhost:8000/${product.image}" class="card-img-top" alt="No images" style="object-fit: contain;">
                                        <div class="mt-2">
                                            <h5 class="card-title">${product.name}</h5>
                                            <span class="badge text-bg-success">Số lượng: ${product.quantity} cái</span>
                                            <span class="badge text-bg-danger ms-2">${product.category_name}</span><br>
                                            <div class="prices mt-2">
                                                <span>${new Intl.NumberFormat("vi-VN").format(product.price)}đ</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        `;
                                document.getElementById("product-list").insertAdjacentHTML("beforeend",
                                    productHTML);
                            });
                        } else {
                            document.getElementById("product-list").innerHTML =
                                `<div class="text-center mb-4">Không tìm thấy sản phẩm</div>`;
                        }
                    })
                    .catch(error => console.error("Lỗi:", error));
            }
        });
    </script>
    <style>
        .buton-color {
            background-color: #FE5722 !important;
            color: #fff !important;
        }

        .active {
            background-color: #FE5722 !important;
            color: #fff !important;
            border: #FE5722 !important;
            border-radius: 5px !important;
        }

        .page-link {
            background-color: #FE5722 !important;
            color: #fff !important;
            border: #FE5722 !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/product.blade.php ENDPATH**/ ?>