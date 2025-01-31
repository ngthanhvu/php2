<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $title ?? "Errors" ?> | TapHoaOnline
    </title>
    <!-- icon -->
    <link rel="shortcut icon" href="https://storage.googleapis.com/pr-newsroom-wp/1/2023/05/Spotify_Primary_Logo_RGB_Green.png" type="image/x-icon">
    <!-- boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <!-- boostrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Saira+Semi+Condensed:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/751e818311.js" crossorigin="anonymous"></script>
</head>
<style>
    * {
        font-family: 'Saira Semi Condensed', sans-serif;
    }
</style>

<body>
    <nav class="bg-body-tertiary bg-success">
        <div class="container d-flex flex-wrap">
            <ul class="nav me-auto d-flex align-items-center">
                <li class="nav-item">
                    <p class="text-white m-0">TAPHOAONLINE SHOP BÁN ACC SPOTIFY</p>
                </li>
            </ul>
            <ul class="nav">
                <li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2 text-white">Chính sách</a></li>
                <li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2 text-white">FAQ</a></li>
                <li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2 text-white">Liên hệ</a></li>
            </ul>
        </div>
    </nav>
    <div style="background-color: #F5F6F7;">
        <div class="py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <a href="/">
                            <img class="img-fluid d-flex mx-auto justify-content-center mt-3"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/26/Spotify_logo_with_text.svg/1200px-Spotify_logo_with_text.svg.png"
                                alt="no logo" width="200">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <form action="" method="post">
                            <div class="input-group mb-3 mt-3 d-flex justify-content-center">
                                <input type="text" class="form-control" placeholder="Nhập từ khóa tìm kiếm">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-end mt-3 mb-3 gap-2">
                            <!-- Icon giỏ hàng -->
                            <div class="text-center me-3">
                                <a href="#" class="text-decoration-none text-dark">
                                    <i class="bi bi-heart fs-4"></i>
                                </a>
                            </div>
                            <!-- Icon yêu thích -->
                            <div class="text-center me-3 position-relative">
                                <a href="#" class="text-decoration-none text-dark">
                                    <i class="bi bi-cart2 fs-4"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">0</span>
                                </a>
                            </div>
                            <!-- Avatar và tên -->

                            <?php
                            if (isset($_SESSION['user'])) {
                                echo '
                                <div class="d-flex align-items-center">
                                    <img src="https://muaclone247.com/assets/storage/images/avatar4N0.png" alt="avatar" class="rounded-circle me-2" width="40" height="40">
                                    <div class="text-end">
                                        <div class="text-center">' . (isset($_SESSION['user']) ? strtoupper($_SESSION['user']['username']) : 'NGƯỜI DÙNG') . '</div>
                                        <span href="#" class="text-success text-decoration-none me-2">0đ</span>
                                        <a href="/logout" class="text-danger text-decoration-none">Đăng xuất</a>
                                    </div>
                                </div>
                                ';
                            } else {
                                echo '
                                <div class="d-flex align-items-center">
                                    <img src="https://muaclone247.com/assets/storage/images/avatar4N0.png" alt="avatar" class="rounded-circle me-2" width="40" height="40">
                                    <div class="text-end">
                                        <div><a href="/login" class="text-primary text-decoration-none">login</a href="/login"></div>
                                    </div>
                                </div>
                                ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="py-2 bg-body-tertiary">
            <div class="container d-flex flex-wrap border-top">
                <ul class="nav me-auto mt-3">
                    <li class="nav-item"><a href="/" class="nav-link link-body-emphasis px-2 text-secondary fw-bold">Trang chủ</a>
                    </li>
                    <li class="nav-item"><a href="/product"
                            class="nav-link link-body-emphasis px-2 text-secondary fw-bold">Sản phẩm</a></li>
                    <li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2 text-secondary fw-bold">Về chúng tôi</a>
                    </li>
                    <li class="nav-item"><a href="/payment" class="nav-link link-body-emphasis px-2 text-secondary fw-bold">Nạp thẻ</a>
                    </li>
                    <?php
                    if (isset($_SESSION['user']['role'])) {
                        if ($_SESSION['user']['role'] == 'admin') {
                            echo '<li class="nav-item"><a href="/admin" class="nav-link link-body-emphasis px-2 text-secondary fw-bold">Admin</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </div>

    <main class="main container mt-3" style="min-height: calc(70vh - 70px);">
        <?= $content ?>
    </main>

    <footer class="bg-success text-white py-2 mt-4">
        <div class="container">
            <p class="mb-0">&copy;
                <?= date("Y") ?> My App
            </p>
        </div>
    </footer>
</body>

</html>

<?php
// var_dump($_SESSION['user']);
?>