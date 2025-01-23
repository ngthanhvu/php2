<!-- <h2>Đây là trang chủ nhé :)))</h2> -->
<div class=" p-5 mb-4 bg-success rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold text-white">Taphoaonline <span class="fs-3">Shop Bán Acc Spotify</span></h1>
        <p class="col-md-8 fs-4 text-white" id="text-container"></p>
        <button class="btn btn-light btn-lg text-success" type="button">Mua ngay!</button>
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