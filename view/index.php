<!-- <h2>Đây là trang chủ nhé :)))</h2> -->
<div class=" p-5 mb-4 rounded-3" style="background-color: #FE5722;">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold text-white">Shopp bán hàng <span class="fs-3">bán mọi thứ trên đời =))</span></h1>
        <p class="col-md-8 fs-4 text-white" id="text-container"></p>
        <button class="btn btn-light btn-lg" style="color: #FE5722;" type="button">Mua ngay!</button>
    </div>
</div>
<h2 style="color: #FE5722"><span class="me-2 fs-1">|</span>Danh sách sản phẩm</h2>
<div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
    <?php foreach ($products as $key => $product) : ?>
        <div class="col-md-2">
            <a href="/detail/<?php echo $product['id'] ?>" class="text-decoration-none text-black">
                <div class="card mb-3 border-0 hover-card" style="width: 13rem;">
                    <img src="<?php echo $product['image'] ?>" class="card-img-top" alt="No images"
                        style="object-fit: contain;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['name'] ?></h5>
                        <span class="card-text badge text-bg-success">Số lượng: <?php echo $product['quantity'] ?> cái</span><br>
                        <span class="card-text badge text-bg-danger">Danh mục: <?php echo $product['category_name'] ?></span>
                        <div class="mt-3">
                            <span class="float-start text-danger fw-bold"><?php echo number_format($product['price'], 0, ',', '.') ?>đ</span>
                            <span class="float-end text-muted text-decoration-line-through"><?php echo number_format(20000, 0, ',', '.') ?>đ</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
    <?php
    if (empty($products)) {
        echo "<p class='text-center mx-auto'>Không tìm thấy sản phẩm</p>";
    }
    ?>
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
<script>
    const text = "Xin chào, đây là website bán hàng của chúng tôi!";
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
<?php
// echo session_id();
echo "<pre>";
var_dump($products);
echo "</pre>";
?>