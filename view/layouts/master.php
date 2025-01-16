<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? "My App" ?> | Spotify shop</title>
    <link rel="shortcut icon" href="https://storage.googleapis.com/pr-newsroom-wp/1/2023/05/Spotify_Primary_Logo_RGB_Green.png" type="image/x-icon">
    <!-- boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- boostrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
    .hover-success:hover {
        color: #198754 !important;
        text-decoration: none;
        transition: color 0.3s ease-in-out;
    }
</style>

<body>

    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="https://i.imgur.com/RR02dHL.png" alt="Geeks" />
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-3">
                    <li><a href="/" class="nav-link px-2 text-white hover-success">Home</a></li>
                    <li><a href="/posts" class="nav-link px-2 text-white hover-success">Posts</a></li>
                    <li><a href="/products" class="nav-link px-2 text-white hover-success">Products</a></li>
                    <li><a href="/categories" class="nav-link px-2 text-white hover-success">Categories</a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
                </form>

                <div class="text-end d-flex">
                    <button class="btn btn-outline-light me-2" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-light text-dark ms-1 rounded-pill">0</span>
                    </button>
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo '<a href="/logout" class="btn btn-danger">Logout</a>';
                    } else {
                        echo '<a href="/login" type="button" class="btn btn-outline-success me-2">Login</a>';
                        // echo '<a href="/register" type="button" class="btn btn-warning">Sign up</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </header>

    <main class="main" style="min-height: calc(100vh - 100px);">
        <div class="container mt-3">
            <?= $content ?>
        </div>
    </main>

    <footer class="bg-dark text-white py-3 mt-4">
        <div class="container">
            <p class="mb-0">&copy; <?= date("Y") ?> My App</p>
        </div>
    </footer>
</body>

</html>