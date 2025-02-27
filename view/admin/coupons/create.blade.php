@extends('layouts.admin')
@section('content')
    <div class="p-3 mb-4 rounded-3 bg-light">
        <h2>Tạo mã giảm giá</h2>
    </div>
    <div class="p-3 mb-4 rounded-3 bg-light w-50 mx-auto">
        <form method="POST">
            <div class="mb-3">
                <label for="code" class="form-label">Mã giảm giá</label>
                <input type="text" class="form-control" id="code" name="code" placeholder="Nhập mã giảm giá">
                @if (isset($errors['code']))
                    <p class="text-danger">{{ $errors['code'] }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="discount" class="form-label">Số tiền giảm giá</label>
                <input type="number" class="form-control" id="discount" name="discount"
                    placeholder="Nhập số tiền giảm giá">
                @if (isset($errors['discount']))
                    <p class="text-danger">{{ $errors['discount'] }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Loại giảm giá</label>
                <select name="type" id="type" class="form-select">
                    <option value="" selected>-- Chọn loại giảm giá --</option>
                    <option value="fixed">Giảm theo tiền</option>
                    <option value="percentage">Giảm theo phần trăm</option>
                </select>
                @if (isset($errors['type']))
                    <p class="text-danger">{{ $errors['type'] }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="expiry_date" class="form-label">Ngày hết hành</label>
                <input type="date" class="form-control" id="expiry_date" name="expiry_date">
                @if (isset($errors['expiry_date']))
                    <p class="text-danger">{{ $errors['expiry_date'] }}</p>
                @endif
            </div>
            {{-- <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select name="status" id="status" class="form-select">
                    <option value="" selected>-- Chọn trạng thái --</option>
                    <option value="active">Kích hoạt</option>
                    <option value="expired">Hết hạn</option>
                    <option value="used">Đang sử dụng</option>
                </select>
            </div> --}}
            <button type="submit" class="btn btn-primary">Tạo mã giảm giá</button>
        </form>
    </div>
@endsection
