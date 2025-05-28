<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['otp']) && isset($_SESSION['email'])) {
        $enteredOtp = $_POST['otp'];
        $storedOtp = $_SESSION['otp'];
        $email = $_SESSION['email'];
        
        if ($enteredOtp == $storedOtp) {
            // OTP is correct, allow the user to reset their password
            header("Location: reset_password.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid OTP. Please try again.";
            header("Location: verify_otp.php");
            exit();
        }
    } else {
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
     
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
    <h2>Verify OTP</h2>
    <?php if(isset($_SESSION['error'])) { ?>
        <div class="error"><?php echo $_SESSION['error']; ?></div>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        OTP: <input type="text" name="otp" required><br><br>
        <input type="submit" value="Verify OTP">
    </form>
</body>
</html>
