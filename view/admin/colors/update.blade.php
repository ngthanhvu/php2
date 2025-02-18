@extends('layouts.admin')
@section('content')
<h2>Tạo màu sắc</h2>
<form method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Tên màu sắc</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $color['name'] ?>">
    </div>
    <button type="submit" class="btn btn-primary">Tạo màu sắc</button>
</form>
@endsection