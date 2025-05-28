<?php
// Database configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "touristguide";

// Create database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$uploadDirectory = "uploads/";
if (!file_exists($uploadDirectory)) {
    mkdir($uploadDirectory, 0777, true);
}
// Check if form is submitted
if(isset($_POST['submit'])){
    // Loop through each uploaded file
    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        $file_name = $_FILES['images']['name'][$key];
        $file_tmp = $_FILES['images']['tmp_name'][$key];
        $file_path = $uploadDirectory . $file_name;
        
        // Move uploaded file to upload directory
        move_uploaded_file($file_tmp, $file_path);
        
        // Insert file details into database
        $sql = "INSERT INTO images (filename, filepath) VALUES ('$file_name', '$file_path')";
        if ($conn->query($sql) === TRUE) {
            echo "File uploaded successfully and inserted into database.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Multiple Image Upload</title>
</head>
<body>
    <h2>Upload Multiple Images</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="images[]" multiple>
        <button type="submit" name="submit">Upload Images</button>
    </form>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
