 <?php
 include'conn.php';
// Process the received data
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$username = strtolower(mysqli_real_escape_string($con,$_POST['username'] ?? ''));
$email = strtolower(mysqli_real_escape_string($con,$_POST['email'] ?? ''));
$phone = mysqli_real_escape_string($con,$_POST['phone'] ?? '');
$gender = mysqli_real_escape_string($con,$_POST['gender'] ?? '');
$password = mysqli_real_escape_string($con,$_POST['password'] ?? '');
$cPassword = mysqli_real_escape_string($con,$_POST['cPassword'] ?? '');
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
// Email fetch
$fetchEmail = "SELECT * FROM user_tbl WHERE Email='$email'";
$resultEmail = mysqli_query($con, $fetchEmail);
// create verification code
$verification_code = md5(uniqid(rand(), true));
// Phone fetch
$fetchPhone = "SELECT * FROM user_tbl WHERE Phone_no='$phone'";
$resultPhone = mysqli_query($con, $fetchPhone);
$emailExists = $resultEmail && mysqli_num_rows($resultEmail) > 0;
$phoneExists = $resultPhone && mysqli_num_rows($resultPhone) > 0;
if ($emailExists && $phoneExists) {
    echo "<script type='text/javascript'>
            alert('Email and Phone number already exist');
            window.location.href = 'signup.php';
          </script>";
    exit;
}
if ($emailExists) {
    echo "<script type='text/javascript'>
            alert('Email already exists');
            window.location.href = 'signup.php';
          </script>";
    exit;
}
if ($phoneExists) {
    echo "<script type='text/javascript'>
            alert('Phone number already exists');
            window.location.href = 'signup.php';
          </script>";
    exit;
}
// Insert data into the database
    else {
        $sql = "INSERT INTO user_tbl (Username, Email, Phone_no,gender,Password,verification_code, is_verified) 
        VALUES ('$username', '$email', '$phone', '$gender','$hashedPassword','$verification_code', 0)";
            $query = mysqli_query($con,$sql);
            if(!$query){
                echo "<script type='text/javascript'>
                alert('Failed to registered');
                window.location.href = 'SignUp.php';
                </script>";
            }
            else{
                // Send verification email
            $to = $email;
            $subject = 'Email Verification';
            $message = '<html><body><p>Click the following button to verify your email:</p><p><a href="http://localhost/Add/demo/login signup/verify.php?code='.$verification_code.'" style="background-color: #4CAF50; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 10px;">Verify Email</a></p></body></html>';
            $headers = "From: biranbist77@gmail.com\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";    
                if (mail($to, $subject, $message, $headers)) {
                    echo "Email sent successfully";
                        echo "<script type='text/javascript'>
                        alert('Successfully sent email, please check your email for verify email');
                        window.location.href = 'login.html';
                        </script>";
                        exit;   
                        }
                else{
                echo "<script type='text/javascript'>
                alert('Failed to sent email');
                window.location.href = 'signup.html';
                </script>";
                }
            }
    }
        $con->close();
 }
?>


