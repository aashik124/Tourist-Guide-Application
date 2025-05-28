<?php
session_start(); // Start session to access session variables

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "touristguide";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to create the feedback table
$sqlCreateFeedbackTable = "CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    city VARCHAR(255) NOT NULL,
    review_title VARCHAR(255) NOT NULL,
    review_text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sqlCreateFeedbackTable) === TRUE) {
    // echo "Feedback table created successfully.<br>";
} else {
    // echo "Error creating feedback table: " . $conn->error . "<br>";
}

// SQL query to create the feedback images table
$sqlCreateFeedbackImagesTable = "CREATE TABLE IF NOT EXISTS feedback_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    feedback_id INT NOT NULL,
    image_name VARCHAR(255),
    image_data LONGBLOB,
    FOREIGN KEY (feedback_id) REFERENCES feedback(id)
)";

if ($conn->query($sqlCreateFeedbackImagesTable) === TRUE) {
    // echo "Feedback images table created successfully.<br>";
} else {
    // echo "Error creating feedback images table: " . $conn->error . "<br>";
}

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to login page or handle unauthorized access
    echo "<script type='text/javascript'>;
    alert('login first');
    window.location.href = 'login signup/login.html';
    </script>";   

    exit(); // Stop further execution
}

$userId = $_SESSION['id']; // Retrieve user_id from session

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $city = $_POST["city"];
    $reviewTitle = $_POST["title"];
    $reviewText = $_POST["feedback"];

    // Store feedback in the database
    $sqlInsertFeedback = "INSERT INTO feedback (user_id, city, review_title, review_text) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sqlInsertFeedback);
    $stmt->bind_param("isss", $userId, $city, $reviewTitle, $reviewText);
    $stmt->execute();
    $feedbackId = $stmt->insert_id; // Get the ID of the inserted feedback
    $stmt->close();

    // Handle image uploads for places
    if (isset($_FILES['placePicture'])) {
        // Loop through each uploaded file
        foreach ($_FILES["placePicture"]["tmp_name"] as $key => $tmp_name) {
            // Get file information
            $file_name = $_FILES["placePicture"]["name"][$key];
            $file_data = file_get_contents($_FILES["placePicture"]["tmp_name"][$key]);

            // Prepare SQL query
            $stmt = $conn->prepare("INSERT INTO feedback_images (feedback_id, image_name, image_data) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $feedbackId, $file_name, $file_data);
            $stmt->execute();
            $stmt->close();
        }
    }
    echo "<script type='text/javascript'>
    alert('Successfully feedback registered ');
    window.location.href = 'index.php';
    </script>";
    exit;   
                        
}

// Close connection
$conn->close();
?>
