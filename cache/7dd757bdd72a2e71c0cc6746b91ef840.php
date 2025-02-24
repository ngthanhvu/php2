
<?php $__env->startSection('content'); ?>
    <?php if(isset($_SESSION['message'])): ?>
        <script>
            Swal.fire('Thành công', '<?php echo e($_SESSION['message']); ?>', 'success');
        </script>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <div class="p-3 mb-4 rounded-3 bg-light">
        <h2>Danh sách sản phẩm</h2>
    </div>
    <div class="p-3 mb-4 rounded-3 bg-light">
        <a href="/admin/products/create" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i></a>
        <table class="table table-striped table-bordered table-hover text-center mt-3 rounded-4" style="overflow: hidden">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Biến thể</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $index = 1; ?>
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <th scope="row"><?php echo e($index++); ?></th>
                        <td><?php echo e($product['name']); ?></td>
                        <td><?php echo e(number_format($product['price'], 0, ',', '.')); ?>đ</td>
                        <td><?php echo e($product['description']); ?></td>
                        <td><img src="http://localhost:8000/<?php echo e($product['image']); ?>" alt="No image" width="100"></td>
                        <td><a href="/admin/products/products-variants/<?php echo e($product['id']); ?>"
                                class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-eye"></i> Xem biến thể</a></td>
                        <td>
                            <a href="/admin/products/addProductVarrant/<?php echo e($product['id']); ?>"
                                class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-circle-plus"></i></a>
                            <a href="/admin/products/update/<?php echo e($product['id']); ?>" class="btn btn-outline-success btn-sm"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <a href="/admin/products/delete/<?php echo e($product['id']); ?>" class="btn btn-outline-danger btn-sm"><i
                                    class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7">Không tìm thấy danh sách sản phẩm.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/admin/products/index.blade.php ENDPATH**/ ?>