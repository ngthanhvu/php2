@extends('layouts.admin')
@section('content')
    <?php
    if (isset($_SESSION['message'])) {
        echo "<script>Swal.fire('Thành công', '" . $_SESSION['message'] . "', 'success');</script>";
        unset($_SESSION['message']);
    }
    ?>
    <div class="p-3 mb-4 rounded-3 bg-light">
        <h2>Quản lý màu sắc</h2>
    </div>
    <div class="p-3 mb-4 rounded-3 bg-light">
        <a href="/admin/colors/create" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i></a>
        <table class="table table-striped table-bordered table-hover text-center mt-3 rounded-4" style="overflow: hidden">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Hành dộng</th>
                </tr>
            </thead>
            <tbody>
                <?php $index = 1; ?>
                <?php foreach ($colors as $color) : ?>
                <tr>
                    <th scope="row"><?= $index++ ?></th>
                    <td><?= $color['name'] ?></td>
                    <td>
                        <a href="/admin/colors/update/<?= $color['id'] ?>" class="btn btn-outline-success btn-sm"><i
                                class="fa-solid fa-pen-to-square"></i></a>
                        <a href="/admin/colors/delete/<?= $color['id'] ?>" class="btn btn-outline-danger btn-sm"><i
                                class="fa-solid fa-trash-can"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($colors)) : ?>
                <tr>
                    <td colspan="4" class="text-center">Danh sách rỗng!</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
@endsection
