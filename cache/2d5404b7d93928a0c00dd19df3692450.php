

<?php $__env->startSection('content'); ?>
    <div class="mt-5">
        <div class="row">
            <!-- Filter Column -->
            <div class="col-md-3">
                <h4>Filters</h4>
                <div class="list-group">
                    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <button type="button" class="list-group-item list-group-item-action"><?php echo e($category['name']); ?></button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="list-group-item list-group-item-action">Không tìm thấy danh mục</div>
                    <?php endif; ?>
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
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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
                                            <span class="text-muted text-decoration-line-through ms-2">20.000đ</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="text-center mb-4">Không tìm thấy sản phẩm</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/product.blade.php ENDPATH**/ ?>