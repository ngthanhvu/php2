@extends('layouts.master')

@section('content')
    <div class="p-5 mb-4 rounded-3" style="background-image: url('<?= $banner['banner'] ?>');">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold text-white">Shopp bán hàng <span class="fs-3">bán mọi thứ trên đời =))</span></h1>
            <p class="col-md-8 fs-4 text-white" id="text-container"></p>
            <button class="btn btn-light btn-lg" style="color: #FE5722;" type="button">Mua ngay!</button>
        </div>
    </div>
    <h2 style="color: #FE5722"><span class="me-2 fs-1">|</span>Danh sách sản phẩm</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
        @forelse ($products as $product)
            <div class="col-md-2">
                <a href="/detail/{{ $product['id'] }}" class="text-decoration-none text-black">
                    <div class="card mb-3 border-0 hover-card" style="width: 13rem;">
                        <img src="{{ $product['image'] }}" class="card-img-top" alt="No images"
                            style="object-fit: contain;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product['name'] }}</h5>
                            <span class="card-text badge text-bg-success">Số lượng: {{ $product['quantity'] }}
                                cái</span><br>
                            <span class="card-text badge text-bg-danger">Danh mục: {{ $product['category_name'] }}</span>
                            <div class="mt-3">
                                <span
                                    class="float-start text-danger fw-bold">{{ number_format($product['price'], 0, ',', '.') }}đ</span>
                                <span
                                    class="float-end text-muted text-decoration-line-through">{{ number_format(20000, 0, ',', '.') }}đ</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <p class='text-center mx-auto'>Không tìm thấy sản phẩm</p>
        @endforelse
    </div>
    <style>
        .hover-card {
            overflow: hidden;
            position: relative;
        }

        .hover-card img {
            transition: transform 0.3s ease;
        }

        .hover-card:hover img {
            transform: scale(1.1);
        }
    </style>
    <script>
        const text = "Xin chào, đây là website bán hàng của chúng tôi!";
        const container = document.getElementById("text-container");

        let index = 0;

        function typeEffect() {
            if (index < text.length) {
                container.textContent += text[index];
                index++;
                setTimeout(typeEffect, 100);
            } else {
                setTimeout(() => {
                    container.textContent = "";
                    index = 0;
                    typeEffect();
                }, 1000);
            }
        }

        typeEffect();
    </script>
@endsection
