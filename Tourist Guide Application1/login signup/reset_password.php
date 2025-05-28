<?php
session_start();
require_once('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $password = $_POST['password'];

        // Update password in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $updatePasswordQuery = "UPDATE user_tbl SET password='$hashedPassword' WHERE Email='$email'";
        
        if (mysqli_query($con, $updatePasswordQuery)) {
            $_SESSION['message'] = 'Password reset successfully.';
            header("Location: login.html");
            exit();
        } else {
            $_SESSION['error'] = 'Failed to reset password.';
            header("Location: reset_password.php");
            exit();
        }
    } else {
        header("Location: ../index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
     
    <style>form,h2 {
    text-align: center;
}

form input[type="email"],
form input[type="submit"] {
    margin: 10px auto;
}
</style>
</head>
<body>
    <h2>Reset Password</h2>
    <?php if(isset($_SESSION['error'])) { ?>
        <div class="error"><?php echo $_SESSION['error']; ?></div>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        New Password: <input type="password" name="password" required><br><br>
        Confirm Password: <input type="password" name="confirm_password" required><br><br>
        <input type="submit" value="Reset Password">
    </form>
</body>
</html>
