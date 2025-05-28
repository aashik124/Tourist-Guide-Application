<?php
session_start();
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST["username"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);

    // Validate credentials (replace this with your validation logic)
    $query = "SELECT * FROM user_tbl WHERE (Username='$username' OR Email='$username') LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashPassword = $row['Password'];
        if (password_verify($password, $hashPassword)) {
            $_SESSION['id']=$row['id'];
            $firstWord=$row['Username'];
            $firstName=explode(" ",$firstWord);
            $firstParts=$firstName[0];
            $_SESSION['username'] = $firstParts;
            echo "<script type='text/javascript'>;
              alert('login success');
              window.location.href = '../index.php';
              </script>";   
            exit;
        } else {
            $error_message = "Invalid password";
        }
    } else {
        $error_message = "User not found";
    }
    // Display alert box using JavaScript
    echo '<script>';
    echo 'alert("' . $error_message . '");';
    echo 'window.location.href = "login.html";';
    echo '</script>';
}
?>

