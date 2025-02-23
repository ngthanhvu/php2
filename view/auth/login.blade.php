@extends('layouts.master')

@section('content')
    @if (isset($_SESSION['message']))
        <script>
            Swal.fire('Thành công', '{{ $_SESSION['message'] }}', 'success');
        </script>
        <?php unset($_SESSION['message']); ?>
    @endif

    <h2 class="text-center">Đăng nhập</h2>
    <form method="POST" class="form-control mt-3 w-50 mx-auto p-3 needs-validation" novalidate>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control {{ isset($errors['email']) ? 'is-invalid' : '' }}" id="email"
                name="email" placeholder="Nhập email của bạn" required>
            <div class="invalid-feedback">
                {{ isset($errors['email']) ? $errors['email'] : 'Please enter a valid email.' }}
            </div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control {{ isset($errors['password']) ? 'is-invalid' : '' }}" id="password"
                name="password" placeholder="Nhập mật khẩu" required>
            <div class="invalid-feedback">
                {{ isset($errors['password']) ? $errors['password'] : 'Please enter your password.' }}
            </div>
            @if (isset($errors['login']))
                <div class="text-danger">
                    {{ $errors['login'] }}
                </div>
            @endif
        </div>

        <div class="mb-3 text-end">
            <p><a href="/forgotpassword" class="text-decoration-none" style="color: #FE5722;">Quên mật khẩu?</a></p>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn w-100 text-white" style="background-color: #FE5722;">Đăng nhập</button>
        </div>

        <div class="mb-3 text-center">
            <p>Chưa có tài khoản? <a href="/register" class="text-decoration-none" style="color: #FE5722;">Đăng ký</a>
            </p>
        </div>

        <hr>

        <div class="text-center mt-4">
            <a href="/auth/facebook" type="button" class="btn btn-primary w-70">
                <i class="fa-brands fa-facebook"></i> Facebook
            </a>
            <a href="/auth/google" type="button" class="btn btn-danger w-70">
                <i class="fa-brands fa-google"></i> Google
            </a>
        </div>
    </form>
@endsection
