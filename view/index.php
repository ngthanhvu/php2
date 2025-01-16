<!-- <h2>Đây là trang chủ nhé :)))</h2> -->
<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
        <img src="https://storage.googleapis.com/pr-newsroom-wp/1/2023/05/2024-spotify-brand-assets-media-kit.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
    </div>
    <div class="col-lg-6">
        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3 text-success">Spotify Shop</h1>
        <p class="lead text-muted" id="text-container"></p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <button type="button" class="btn btn-success btn-lg px-4 me-md-2">Mua ngay! <i class="bi bi bi-cursor"></i></button>
        </div>
    </div>
</div>

<h2 class="text-success"><span class="text-success me-2 fs-1">|</span>Danh sách sản phẩm</h2>
<div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
    <?php foreach ($products as $key => $product) : ?>
        <div class="col-md-4">
            <a href="/products/show/<?php echo $product['id'] ?>" class="text-decoration-none">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?php echo $product['image'] ?>" class="img-fluid rounded-start p-3" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h3 class="card-title text-success"><?php echo $product['name'] ?></h3>
                                <!-- <p class=" card-text"><?php echo $product['description'] ?></p> -->
                                <span class="badge text-bg-success">Còn: 888 cái</span>
                                <p class="card-text text-dark"><small class="text-body-secondary">Giá: <?php echo $product['price'] ?> đ</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
<script>
    const text = "Xin chào, đây là website bán hàng của chúng tôi. Hãy mua hàng ngay hôm nay!";
    const container = document.getElementById("text-container");

    let index = 0;

    function typeEffect() {
        if (index < text.length) {
            container.textContent += text[index];
            index++;
            setTimeout(typeEffect, 100);
        } else {
            setTimeout(() => {
                container.textContent = "";
                index = 0;
                typeEffect();
            }, 1000);
        }
    }

    typeEffect();
</script>