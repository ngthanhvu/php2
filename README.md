# Base PHP MVC.

Xin chào, đây là cấu trúc cơ bản của một dự án PHP mvc thuần

## Cách chạy dự án

Chuyển đổi .env.example thành .env

```bash
mv .env.example .env
```

Chạy dự án php với localhost:8000

```bash
php -S localhost:8000
```

Đoạn SQL để chạy với dự án

```bash
CREATE TABLE `posts` (
  `id` int NOT NULL PRIMARY KEY,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL
)
CREATE TABLE `users` (
  `id` int NOT NULL PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `oauth_provider` varchar(255) NOT NULL,
  `oauth_id` varchar(255) NOT NULL
)
```

Cài thư viện Google và Facebook để dùng login with social

```bash
composer require google/apiclient facebook/graph-sdk
```

Cài thư viện PHPMailer

```bash
composer require phpmailer/phpmailer
```
Cài thư viện illuminate/view
```bash
composer require illuminate/view illuminate/filesystem illuminate/events
```
# Laravel Blade Cheatsheet

## 1. Cú pháp cơ bản
```blade
{{-- Hiển thị biến --}}
{{ $variable }}

{{-- Kiểm tra tồn tại --}}
{{ $variable ?? 'Giá trị mặc định' }}

{{-- Escape dữ liệu --}}
{!! $html !!}

{{-- Comment trong Blade --}}
{{-- Đây là một comment --}}
```

## 2. Câu lệnh điều kiện
```blade
{{-- If - Else --}}
@if ($condition)
    <p>Điều kiện đúng</p>
@elseif ($otherCondition)
    <p>Điều kiện khác đúng</p>
@else
    <p>Không có điều kiện nào đúng</p>
@endif

{{-- Unless (ngược với if) --}}
@unless ($condition)
    <p>Điều kiện sai</p>
@endunless

{{-- Kiểm tra biến tồn tại --}}
@isset($variable)
    <p>Biến tồn tại</p>
@endisset

{{-- Kiểm tra biến rỗng --}}
@empty($variable)
    <p>Biến rỗng</p>
@endempty
```

## 3. Vòng lặp
```blade
{{-- Foreach --}}
@foreach ($items as $item)
    <p>{{ $item }}</p>
@endforeach

{{-- Forelse (tương tự foreach nhưng xử lý trường hợp mảng rỗng) --}}
@forelse ($items as $item)
    <p>{{ $item }}</p>
@empty
    <p>Không có dữ liệu</p>
@endforelse

{{-- For --}}
@for ($i = 0; $i < 5; $i++)
    <p>Vòng lặp thứ {{ $i }}</p>
@endfor

{{-- While --}}
@while ($condition)
    <p>Chạy khi điều kiện đúng</p>
@endwhile

{{-- Lệnh Break và Continue --}}
@foreach ($items as $item)
    @if ($item == 'skip')
        @continue
    @endif
    @if ($item == 'stop')
        @break
    @endif
    <p>{{ $item }}</p>
@endforeach
```

## 4. Include & Extends
```blade
{{-- Kế thừa layout --}}
@extends('layouts.master')

{{-- Định nghĩa section --}}
@section('content')
    <p>Nội dung của trang con</p>
@endsection

{{-- Thêm nội dung vào section đã có --}}
@section('content')
    @parent
    <p>Nội dung thêm</p>
@endsection

{{-- Include một file khác --}}
@include('partials.header')

{{-- Include với dữ liệu --}}
@include('partials.card', ['title' => 'Hello'])
```

## 5. Component & Slot
```blade
{{-- Định nghĩa component --}}
<x-alert type="success" message="Thành công!" />

{{-- Component với slot --}}
<x-card>
    <x-slot name="header">Tiêu đề</x-slot>
    Nội dung của thẻ card
</x-card>
```

## 6. Switch Case
```blade
@switch($status)
    @case('active')
        <p>Hoạt động</p>
        @break
    @case('inactive')
        <p>Không hoạt động</p>
        @break
    @default
        <p>Trạng thái khác</p>
@endswitch
```

## 7. Form & CSRF
```blade
{{-- Form CSRF --}}
<form method="POST" action="/submit">
    @csrf
    <input type="text" name="name">
    <button type="submit">Gửi</button>
</form>
```

## 8. Debugging
```blade
{{-- Debug --}}
@dump($variable)
@dd($variable)
```

## 9. Tạo URL & Route
```blade
{{-- Link đến route --}}
<a href="{{ route('home') }}">Trang chủ</a>

{{-- Link với tham số --}}
<a href="{{ route('user.profile', ['id' => 1]) }}">Hồ sơ</a>
```

## 10. Lệnh PHP trong Blade
```blade
{{-- Chạy đoạn PHP --}}
@php
    $name = "Laravel";
@endphp
<p>Học {{ $name }}</p>
```

