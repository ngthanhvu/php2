

<?php $__env->startSection('content'); ?>


    <?php if(!empty($_SESSION['cart_message'])): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: "Thất bại",
                text: "<?php echo e($_SESSION['cart_message']); ?>",
                icon: "error"
            });
        </script>
        <?php unset($_SESSION['cart_message']); ?>
    <?php endif; ?>

    <div class="row mt-3">
        <!-- Hình ảnh sản phẩm -->
        <div class="col-md-6">
            <div class="d-flex flex-column align-items-center">
                <img id="mainImage" src="http://localhost:8000/<?php echo e($product['image']); ?>" class="img-fluid rounded"
                    alt="Product Image" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <div class="d-flex mt-3">
                    <?php $__currentLoopData = $products_varriants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="http://localhost:8000/<?php echo e($variant['image']); ?>" class="img-thumbnail me-2 thumbnail"
                            width="60" height="60" data-image="http://localhost:8000/<?php echo e($variant['image']); ?>">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="col-md-6">
            <h2 id="productName"><?php echo e($product['name']); ?></h2>
            <p class="text-muted">Danh mục: <?php echo e($product['category_name']); ?></p>
            <p class="text-muted" id="productSku">SKU: <?php echo e($product['sku']); ?></p>

            <?php if(!empty($products_varriants)): ?>
                <div class="mb-3">
                    <strong>Size:</strong>
                    <div class="d-flex flex-wrap gap-2">
                        <?php $__currentLoopData = $products_varriants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button class="btn btn-outline-danger size-btn" data-size="<?php echo e($variant['size_name']); ?>"
                                data-color="<?php echo e($variant['color_name']); ?>" data-price="<?php echo e($variant['price']); ?>"
                                data-quantity="<?php echo e($variant['quantity']); ?>" data-sku="<?php echo e($variant['sku']); ?>">
                                <?php echo e($variant['size_name']); ?>

                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="mb-3">
                    <strong>Màu sắc:</strong>
                    <div class="d-flex flex-wrap gap-2">
                        <?php $__currentLoopData = $products_varriants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button class="btn btn-outline-danger color-btn" data-size="<?php echo e($variant['size_name']); ?>"
                                data-color="<?php echo e($variant['color_name']); ?>">
                                <?php echo e($variant['color_name']); ?>

                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <strong>Số lượng:</strong> <span id="productQuantity"><?php echo e($product['quantity']); ?> cái</span>
            </div>
            <div class="mb-3">
                <strong>Giá tiền:</strong> <span id="productPrice"
                    class="fs-4 text-danger"><?php echo e(number_format($product['price'], 0, ',', '.')); ?>đ</span>
            </div>

            <div class="mb-3 d-flex align-items-center">
                <strong class="me-2">Số lượng:</strong>
                <button class="btn btn-outline-secondary" onclick="updateQuantity(-1)">-</button>
                <input type="text" id="quantity" class="form-control text-center mx-2" value="1"
                    style="width: 50px;">
                <button class="btn btn-outline-secondary" onclick="updateQuantity(1)">+</button>
            </div>

            <form action="/cart/create" method="POST">
                <input type="hidden" name="sku" id="sku_add_cart"
                    value="<?php echo e(!empty($products_varriants) ? '' : $product['sku']); ?>">
                <input type="hidden" name="quantity" id="quantity_add_cart" value="1">
                <input type="hidden" name="price" id="price_add_cart"
                    value="<?php echo e(!empty($products_varriants) ? '' : $product['price']); ?>">
                <input type="hidden" name="product_id" value="<?php echo e($product['id']); ?>">
                <input type="hidden" name="variant_id" id="variant_id_add_cart" value="">
                <button class="btn btn-danger w-50">Thêm Vào Giỏ Hàng</button>
            </form>
        </div>
        <div class="col-md-12 mt-3">
            <p class="text-muted"><b>Mô tả:</b> <?php echo e($product['description']); ?></p>
        </div>
        <div class="col-md-12 mt-3">
            <h3>Đánh giá sản phẩm</h3>
            <form action="/products/rate/<?php echo e($product['id']); ?>" method="POST">
                <div class="mb-3">
                    <label><strong>Chọn số sao:</strong></label>
                    <div class="star-rating">
                        <input type="radio" name="rating" value="5" id="star5" required><label
                            for="star5">★</label>
                        <input type="radio" name="rating" value="4" id="star4"><label for="star4">★</label>
                        <input type="radio" name="rating" value="3" id="star3"><label for="star3">★</label>
                        <input type="radio" name="rating" value="2" id="star2"><label for="star2">★</label>
                        <input type="radio" name="rating" value="1" id="star1"><label
                            for="star1">★</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label><strong>Bình luận:</strong></label>
                    <textarea name="comment" class="form-control" rows="3" placeholder="Nhập bình luận của bạn"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
            </form>
        </div>

        <!-- Danh sách đánh giá -->
        <div class="col-md-12 mt-3">
            <h3>Danh sách đánh giá</h3>
            <?php if(empty($ratings)): ?>
                <p>Chưa có đánh giá nào cho sản phẩm này.</p>
            <?php else: ?>
                <?php $__currentLoopData = $ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="border p-3 mb-2">
                        <p><strong><?php echo e($rating['username']); ?></strong> -
                            <?php echo e($rating['rating']); ?> <span class="star">★</span>
                            (<?php echo e(date('d/m/Y H:i', strtotime($rating['created_at']))); ?>)
                            <i class="fa-solid fa-heart float-end" id="like"
                                data-rating-id="<?php echo e($rating['id']); ?>"><span id="like-count"
                                    data-rating="<?php echo e($rating['favorite'] ?? 0); ?>"><?php echo e($rating['favorite'] ?? 0); ?></span></i>
                        </p>
                        <p><?php echo e($rating['comment'] ?? 'Không có bình luận'); ?></p>
                        <div class="d-flex justify-content-end">
                            <form
                                action="/products/deleteRate/<?php echo e($rating['id']); ?>/<?php echo e($rating['user_id']); ?>/<?php echo e($rating['product_id']); ?>"
                                method="POST" class="float-end">
                                <button type="submit" class="btn btn-danger btn-sm">Xoa</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
        
        <div class="col-md-12 mt-3">
            <h2>Sản phẩm liên quan</h2>
            <div class="row">
                <?php $__currentLoopData = $related_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3 mb-3">
                        <div class="card border hover-card p-2">
                            <a href="/detail/<?php echo e($related_product['id']); ?>" class="text-decoration-none text-success">
                                <img src="http://localhost:8000/<?php echo e($related_product['image']); ?>" class="card-img-top"
                                    alt="No images" style="object-fit: contain;">
                                <div class="mt-2">
                                    <h5 class="card-title"><?php echo e($related_product['name']); ?></h5>
                                    <span class="badge text-bg-success">Số lượng: <?php echo e($related_product['quantity']); ?>

                                        cái</span>
                                    <span
                                        class="badge text-bg-danger ms-2"><?php echo e($related_product['category_name']); ?></span><br>
                                    <div class="prices mt-2">
                                        <span><?php echo e(number_format($related_product['price'], 0, ',', '.')); ?>đ</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <img src="" id="showImage" class="img-fluid rounded" alt="Product Image">
            </div>
        </div>
    </div>

    <style>
        .star-rating input {
            display: none;
        }

        .star-rating label {
            font-size: 30px;
            color: #ccc;
            cursor: pointer;
        }

        .star-rating input:checked~label {
            color: #f90;
        }

        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #fc0;
        }

        .star {
            color: #f90;
        }
    </style>

    <script>
        console.log(document.getElementById('like-count').getAttribute('data-rating'));

        document.addEventListener("DOMContentLoaded", function() {
            const sizeButtons = document.querySelectorAll(".size-btn");
            const colorButtons = document.querySelectorAll(".color-btn");
            const productPrice = document.getElementById("productPrice");
            const productQuantity = document.getElementById("productQuantity");
            const productSku = document.getElementById("productSku");
            const hiddenSku = document.getElementById("sku_add_cart");
            const hiddenPrice = document.getElementById("price_add_cart");
            const hiddenQuantity = document.getElementById("quantity_add_cart");
            const hiddenVariantId = document.getElementById("variant_id_add_cart");

            let selectedSize = null;
            let selectedColor = null;

            const variants = <?php echo json_encode($products_varriants, 15, 512) ?>;

            function updateVariant() {
                const matchedVariant = variants.find(variant =>
                    variant.size_name === selectedSize && variant.color_name === selectedColor
                );

                if (matchedVariant) {
                    productPrice.textContent = new Intl.NumberFormat("vi-VN").format(matchedVariant.price) + "đ";
                    productQuantity.textContent = matchedVariant.quantity + " cái";
                    productSku.textContent = "SKU: " + matchedVariant.sku;
                    document.getElementById("mainImage").src = "http://localhost:8000/" + matchedVariant.image;

                    // Cập nhật dữ liệu vào form
                    hiddenSku.value = matchedVariant.sku;
                    hiddenPrice.value = matchedVariant.price;
                    hiddenQuantity.value = document.getElementById("quantity").value;
                    hiddenVariantId.value = matchedVariant.id;
                } else {
                    // Nếu không có variant, dùng dữ liệu sản phẩm chính
                    hiddenSku.value = "<?php echo $product['sku']; ?>";
                    hiddenPrice.value = "<?php echo $product['price']; ?>";
                    hiddenQuantity.value = document.getElementById("quantity").value;
                    hiddenVariantId.value = "";
                }
            }

            sizeButtons.forEach(button => {
                button.addEventListener("click", function() {
                    sizeButtons.forEach(btn => btn.classList.remove("active"));
                    selectedSize = this.getAttribute("data-size");
                    this.classList.add("active");
                    updateVariant();
                });
            });

            colorButtons.forEach(button => {
                button.addEventListener("click", function() {
                    colorButtons.forEach(btn => btn.classList.remove("active"));
                    selectedColor = this.getAttribute("data-color");
                    this.classList.add("active");
                    updateVariant();
                });
            });

            // Nếu không có variant, đặt giá trị mặc định từ sản phẩm chính khi tải trang
            if (variants.length === 0) {
                updateVariant();
            }
        });


        document.addEventListener("DOMContentLoaded", function() {
            const quantityInput = document.getElementById("quantity");
            const hiddenQuantity = document.getElementById("quantity_add_cart");

            function updateQuantity(change) {
                let newQuantity = parseInt(quantityInput.value) + change;
                if (newQuantity >= 1) {
                    quantityInput.value = newQuantity;
                    hiddenQuantity.value = newQuantity;
                }
            }

            document.querySelectorAll(".btn-outline-secondary").forEach(button => {
                button.addEventListener("click", function() {
                    let change = this.textContent === "+" ? 1 : -1;
                    updateQuantity(change);
                });
            });

            quantityInput.addEventListener("input", function() {
                let newQuantity = parseInt(quantityInput.value);
                if (isNaN(newQuantity) || newQuantity < 1) {
                    quantityInput.value = 1;
                    hiddenQuantity.value = 1;
                } else {
                    hiddenQuantity.value = newQuantity;
                }
            });
        });

        const img = document.getElementById("mainImage");
        img.addEventListener("click", function() {
            const imageUrl = img.getAttribute("src");
            const modalImage = document.getElementById("showImage");
            modalImage.src = imageUrl;
        });

        document.addEventListener("click", function(event) {
            const like = document.getElementById('like');
            if (like.contains(event.target)) {
                like.classList.toggle('text-danger');
                const count_id = document.getElementById('like-count').getAttribute('data-rating');
                const count = parseInt(count_id) + 1;
                console.log(count);
                addFavorite(count);
            }
        })
        async function addFavorite(favorite) {
            try {
                const productId = '<?php echo $product['id']; ?>';
                const userId = '<?php echo $_SESSION['user']['id']; ?>';
                const rating_id = like.getAttribute('data-rating-id');
                console.log(productId, userId, rating_id);

                const response = await fetch(`/favorite/${rating_id}/${favorite}`, {
                    method: "POST",
                });
                const data = await response.json();
                if (data.success) {
                    window.location.reload();
                    document.getElementById('like').classList.toggle('text-danger');
                } else {
                    alert(data.message);
                }
            } catch (error) {
                console.error("Lỗi:", error);
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/detail.blade.php ENDPATH**/ ?>