<?php
session_start();
require_once('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
    // Check if email exists in the database
    $fetchEmail = "SELECT * FROM user_tbl WHERE Email='$email'";
    $resultEmail = mysqli_query($con, $fetchEmail);
    $emailExists = $resultEmail && mysqli_num_rows($resultEmail) > 0;

    if ($emailExists) {
        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);

        // Store OTP and email in session for verification
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        // Send OTP via email
        $to = $email;
        $subject = 'Reset Password OTP';
        $message = 'Your OTP for password reset is: ' . $otp;
        $headers = "From: biranbist77@gmail.comr\n";
        
        if (mail($to, $subject, $message, $headers)) {
            $_SESSION['message'] = 'OTP sent successfully. Please check your email to reset your password.';
            header("Location: verify_otp.php");
            exit();
        } else {
            $_SESSION['error'] = "Failed to send OTP";
            header("Location:send_reset_link.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Email not found";
        header("Location: send_reset_link.php");
        exit();
    }
}

$con->close();
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
        Email: <input type="email" name="email" required><br><br>
        <input type="submit" value="Send OTP">
    </form>
</body>
</html>
