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
            <a href="/products/show/<?php echo $product['id'] ?>" class="text-decoration-none text-success">
                <div class="card border-0" style="width: 18rem;">
                    <img src="<?php echo $product['image'] ?>" class="card-img-top" alt="No images" width="290"
                        height="140" style="object-fit: contain;">
                    <div class="mt-2">
                        <h5 class="card-title"><?php echo $product['name'] ?></h5>
                        <span class="badge text-bg-success">Số lượng: 199 cái</span><span
                            class="badge text-bg-danger ms-2">Danger</span><br>
                        <div class="prices mt-2"><span><?php echo $product['price'] ?>đ</span><span
                                class="text-muted text-decoration-line-through ms-2"> 20.000đ</span></div>
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