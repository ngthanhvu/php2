<h2 class="text-center">Register</h2>
<form method="POST" class="form-control mt-3 w-50 mx-auto p-3 needs-validation" novalidate>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input
            type="text"
            class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>"
            id="name"
            name="username"
            placeholder="Enter username"
            required>
        <div class="invalid-feedback">
            <?php echo isset($errors['username']) ? $errors['username'] : 'Please enter your username.'; ?>
        </div>
    </div>
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
            class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>"
            id="password"
            name="password"
            placeholder="Enter password"
            required>
        <div class="invalid-feedback">
            <?php echo isset($errors['password']) ? $errors['password'] : 'Please enter a password.'; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="confirm_password" class="form-label">Confirm Password</label>
        <input
            type="password"
            class="form-control <?php echo isset($errors['confirm_password']) ? 'is-invalid' : ''; ?>"
            id="confirm_password"
            name="confirm_password"
            placeholder="Enter password confirmation"
            required>
        <div class="invalid-feedback">
            <?php echo isset($errors['confirm_password']) ? $errors['confirm_password'] : 'Please confirm your password.'; ?>
        </div>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn w-100 text-white" style="background-color: #FE5722;">Register</button>
    </div>
    <div class="mb-3 text-center">
        <p>Already have an account? <a href="/login" class="text-decoration-none" style="color: #FE5722;">Login</a></p>
    </div>
</form>