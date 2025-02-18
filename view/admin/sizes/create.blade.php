@extends('layouts.admin')
@section('content')
<h2>Tạo kích cỡ</h2>
<form method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Tên kích cỡ</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên kích cỡ">
        <?php
        if (isset($errors['name'])) {
            echo '<p class="text-danger">' . $errors['name'] . '</p>';
        }
        ?>
    </div>
    <button type="submit" class="btn btn-primary">Tạo kích cỡ</button>
</form>
@endsection

