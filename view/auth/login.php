<?php
if (isset($_SESSION['message'])) {
    echo "<script>Swal.fire('Thành công', '" . $_SESSION['message'] . "', 'success');</script>";
    unset($_SESSION['message']);
}
?>

<h2 class="text-center">Login</h2>
<form method="POST" class="form-control mt-3 w-50 mx-auto p-3 needs-validation" novalidate>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input
            type="email"
            class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>"
            id="email"
            name="email"
            placeholder="Enter email"
            required>
        <div class="invalid-feedback">
            <?php echo isset($errors['email']) ? $errors['email'] : 'Please enter a valid email.'; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input
            type="password"
            class="form-control <?php echo isset($errors['password'])  ? 'is-invalid' : ''; ?>"
            id="password"
            name="password"
            placeholder="Enter password"
            required>
        <div class="invalid-feedback">
            <?php echo isset($errors['password']) ? $errors['password'] : 'Please enter your password.'; ?>
            <?php
            // if (isset($errors['login'])) {
            //     echo '<div class="text-danger">' . $errors['login'] . '</div>';
            // }
            ?>
        </div>
        <input type="hidden" <?php isset($errors['login']) ? 'is-invalid' : '' ?>>
        <?php
        if (isset($errors['login'])) {
            echo '<div class="text-danger">' . $errors['login'] . '</div>';
        }
        ?>
    </div>
    <div class="mb-3 text-end">
        <p><a href="/forgotpassword" class="text-decoration-none text-success">Forgot password?</a></p>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-success w-100">Login</button>
    </div>
    <div class="mb-3 text-center">
        <p>Don't have an account? <a href="/register" class="text-decoration-none text-success">Register</a></p>
    </div>
    <!-- <div class="mb-3 text-center">
        <p>Don't have an account? <a href="/register" class="text-decoration-none text-success">Register</a></p>
    </div> -->
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