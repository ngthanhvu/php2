

<?php $__env->startSection('content'); ?>
    <h2 class="text-center">Đăng ký</h2>
    <form method="POST" class="form-control mt-3 w-50 mx-auto p-3 needs-validation" novalidate>
        <div class="mb-3">
            <label for="name" class="form-label">Tên đăng nhập</label>
            <input type="text" class="form-control <?php echo e(isset($errors['username']) ? 'is-invalid' : ''); ?>" id="name"
                name="username" placeholder="Nhập tên đăng nhập" required>
            <div class="invalid-feedback">
                <?php echo e(isset($errors['username']) ? $errors['username'] : 'Please enter your username.'); ?>

            </div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control <?php echo e(isset($errors['email']) ? 'is-invalid' : ''); ?>" id="email"
                name="email" placeholder="Nhập email" required>
            <div class="invalid-feedback">
                <?php echo e(isset($errors['email']) ? $errors['email'] : 'Please enter a valid email.'); ?>

            </div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control <?php echo e(isset($errors['password']) ? 'is-invalid' : ''); ?>" id="password"
                name="password" placeholder="Nhập mật khẩu" required>
            <div class="invalid-feedback">
                <?php echo e(isset($errors['password']) ? $errors['password'] : 'Please enter a password.'); ?>

            </div>
        </div>

        <div class="mb-3">
            <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
            <input type="password" class="form-control <?php echo e(isset($errors['confirm_password']) ? 'is-invalid' : ''); ?>"
                id="confirm_password" name="confirm_password" placeholder="Nhập xác nhận mật khẩu" required>
            <div class="invalid-feedback">
                <?php echo e(isset($errors['confirm_password']) ? $errors['confirm_password'] : 'Please confirm your password.'); ?>

            </div>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn w-100 text-white" style="background-color: #FE5722;">Đăng ký</button>
        </div>

        <div class="mb-3 text-center">
            <p>Bạn đã có tài khoản? <a href="/login" class="text-decoration-none" style="color: #FE5722;">Đăng nhập</a>
            </p>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/auth/register.blade.php ENDPATH**/ ?>