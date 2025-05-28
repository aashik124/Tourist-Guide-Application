<?php
// Establish connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "touristguide";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table for places
$sql = "CREATE TABLE IF NOT EXISTS places (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED,
    place_name VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    description TEXT
)";

if ($conn->query($sql) === TRUE) {
    // echo "Table places created successfully<br>";
} else {
    // echo "Error creating table: " . $conn->error . "<br>";
}

// Create table for hotels
$sql = "CREATE TABLE IF NOT EXISTS hotels (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED,
    place_id INT(6) UNSIGNED,
    hotel_name VARCHAR(100) NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    address VARCHAR(255) NOT NULL,
    description TEXT,
    facilities TEXT,
    FOREIGN KEY (place_id) REFERENCES places(id)
)";

if ($conn->query($sql) === TRUE) {
    // echo "Table hotels created successfully<br>";
} else {
    // echo "Error creating table: " . $conn->error . "<br>";
}

// Create table for images of places
$sql = "CREATE TABLE IF NOT EXISTS places_images (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    place_id INT(6) UNSIGNED NOT NULL,
    image_name VARCHAR(255),
    image_data LONGBLOB,
    FOREIGN KEY (place_id) REFERENCES places(id)
)";

if ($conn->query($sql) === TRUE) {
    // echo "Table places_images created successfully<br>";
} else {
    // echo "Error creating table: " . $conn->error . "<br>";
}

// Create table for images of hotels
$sql = "CREATE TABLE IF NOT EXISTS hotels_images (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT(6) UNSIGNED NOT NULL,
    image_name VARCHAR(255),
    image_data LONGBLOB,
    FOREIGN KEY (hotel_id) REFERENCES hotels(id)
)";

if ($conn->query($sql) === TRUE) {
    // echo "Table hotels_images created successfully<br>";
} else {
    // echo "Error creating table: " . $conn->error . "<br>";
}
?>