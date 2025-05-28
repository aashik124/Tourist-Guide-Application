<?php

require_once('conn.php');

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $sql = "SELECT * FROM user_tbl WHERE verification_code='$code' AND is_verified=0";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['id'];
        
        // Mark the user as verified
        $update_sql = "UPDATE user_tbl SET is_verified=1 WHERE id=$user_id";
        mysqli_query($con, $update_sql);
        
       
        header("Location: login.html");
    } else {
      
        header("Location: login.html");
    }
} else {
   
    header("Location: login.html");
}

mysqli_close($conn);
?>
