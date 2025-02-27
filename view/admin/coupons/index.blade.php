@extends('layouts.admin')
@section('content')
    <div class="p-3 mb-4 rounded-3 bg-light">
        <h2 class="fw-bold">Quản lý mã giảm giá</h2>
    </div>
    <div class="p-3 mb-4 rounded-3 bg-light">
        <a href="/admin/coupons/create" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i></a>
        <table class="table table-striped table-bordered table-hover text-center mt-3 rounded-4" style="overflow: hidden">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mã giảm giá</th>
                    <th scope="col">Giá trị giảm giá</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Ngày hết hản</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coupons as $coupon)
                    <tr>
                        <td scope="row">{{ $loop->index + 1 }}</td>
                        <td>{{ $coupon['code'] }}</td>
                        <td>{{ $coupon['discount'] }}</td>
                        <td>{{ $coupon['created_at'] }}</td>
                        <td>{{ $coupon['expiry_date'] }}</td>
                        <td>
                            <a href="/admin/coupons/update/{{ $coupon['id'] }}" class="btn btn-sm btn-outline-success"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <a href="/admin/coupons/delete/{{ $coupon['id'] }}" class="btn btn-sm btn-outline-danger"><i
                                    class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                @endforeach
                @if (empty($coupons))
                    <tr>
                        <td colspan="6" class="text-center">Không tìm thấy mã giảm giá!</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
