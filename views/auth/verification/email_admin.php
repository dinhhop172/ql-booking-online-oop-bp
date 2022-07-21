<form action="?c=verify&a=verify_email_admin" method="POST">
    <input type="hidden" name="email" value="<?= $_GET['email']; ?>" required>
    <input type="text" name="verification_code" placeholder="Enter verification code" required>
    <input type="submit" name="verify_email" value="Verify Email">
</form>