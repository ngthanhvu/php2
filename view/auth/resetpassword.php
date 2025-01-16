<?php
if (isset($_SESSION['message'])) {
    echo "<script>Swal.fire('Thất baị', '" . $_SESSION['message'] . "', 'error');</script>";
    unset($_SESSION['message']);
}
?>

<div class="border p-4 rounded w-50 mx-auto">
    <form method="POST">
        <h3 class="text-center mb-4">Set Password</h3>

        <div class="mb-3">
            <label for="email" class="form-label">Email forgot</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= isset($_SESSION['email_forgot']) ? htmlspecialchars($_SESSION['email_forgot']) : ''; ?>">
        </div>

        <div class="mb-3">
            <label for="otp" class="form-label">Enter 6-digit OTP</label>
            <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP" maxlength="6">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password">
        </div>

        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="Confirm new password">
            <?php
            if (isset($errors['confirm_password'])) {
                echo '<p class="text-danger">' . $errors['confirm_password'] . '</p>';
            }
            ?>
        </div>

        <button type="submit" class="btn btn-success w-100">Set Password</button>
    </form>
</div>