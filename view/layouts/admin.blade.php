<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $title ? $title . '' : 'My App'; ?> | Shopp</title>
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/2875/2875381.png" type="image/x-icon">
    <!-- boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <!-- boostrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- swal alert  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- chartjs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/751e818311.js" crossorigin="anonymous"></script>
    {{-- quid sand font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>

<style>
    * {
        font-family: 'Quicksand', sans-serif;
    }

    body {
        background-color: #EAEAEA;
        margin: 0;
        padding-left: 250px;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        height: 100vh;
        background-color: #343a40;
        padding-top: 20px;
        overflow-y: auto;
    }

    .sidebar a {
        color: #fff;
        padding: 15px;
        text-decoration: none;
        display: block;
    }

    .sidebar a:hover {
        background-color: #495057;
    }

    .sidebar a.active {
        background-color: #007bff;
        font-weight: bold;
    }

    .content {
        padding: 20px;
    }
</style>
</head>

<body>
    <div class="sidebar">
        <h4 class="text-white text-center">Admin</h4>
        <a href="/admin" id="dashboardLink">Bảng điều khiển</a>
        <a href="/admin/products" id="produuctLink">Quản lý sản phẩm</a>
        <a href="/admin/colors" id="produuctLink">Quản lý màu sắc</a>
        <a href="/admin/sizes" id="produuctLink">Quản lý kích cỡ</a>
        <a href="/admin/categories" id="categoryLink">Quản lý danh mục</a>
        <a href="/admin/users" id="userLink">Quản lý người dùng</a>
        <a href="/admin/orders" id="userLink">Quản lý đơn hàng</a>
        <a href="/" id="statsLink"><i class="bi bi-box-arrow-in-left"></i> Trở về trang chủ</a>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
