<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? "My App" ?></title>
    <!-- boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- boostrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
    <nav class="py-2 bg-body-tertiary border-bottom bg-dark text-white">
        <div class="container d-flex flex-wrap text-white">
            <ul class="nav me-auto text-white">
                <li class="nav-item"><a href="/" class="nav-link link-body-emphasis px-2 active text-white text-white" aria-current="page">Home</a></li>
                <li class="nav-item"><a href="/posts" class="nav-link link-body-emphasis px-2 text-white">Manage Posts</a></li>
            </ul>
            <ul class="nav">
                <?php
                if (isset($_SESSION['user'])) {
                    echo '<p class="text-white"><p class="text-white mb-0 me-2 mt-2">Xin chào, ' . $_SESSION['user']['username'] . '</p>';
                    echo '<li class="nav-item"><a href="/logout" class="nav-link link-body-emphasis px-2 text-white btn btn-danger">Logout</a></li>';
                } else {
                    echo '<li class="nav-item"><a href="/login" class="nav-link link-body-emphasis px-2 text-white btn btn-primary me-2">Login</a></li>';
                    echo '<li class="nav-item"><a href="/register" class="nav-link link-body-emphasis px-2 text-dark btn btn-warning">Sign up</a></li>';
                }
                ?>
            </ul>
        </div>
    </nav>
    <div class="container mt-3">
        <?= $content ?>
    </div>
</body>

</html>