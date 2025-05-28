<?php
session_start();
session_destroy();
//header("Location: login.html");
echo "<script type='text/javascript'>
              alert('logout success');
              window.location.href = '../index.php';
              </script>";         
            exit();
?>