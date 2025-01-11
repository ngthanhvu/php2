<h2 class="text-center">Register</h2>
<form method="POST" class="form-control mt-3 w-50 mx-auto p-3">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="username" placeholder="Enter username">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="password" name="confirm_password" placeholder="Enter password confirmation">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary w-100">Submit</button>
    </div>
    <div class="mb-3 text-center">
        <p>Already have an account? <a href="/login" class="text-decoration-none">Login</a></p>
    </div>
</form>