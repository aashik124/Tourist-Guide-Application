<?php
include'connection.php';

session_start();

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id']; // Retrieve user ID from the session
// Handle places data
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $placeName = $_POST['placeName'];
    $city = $_POST['city'];
    $description = $_POST['placeDescription'];

    // Insert places data into database
    $sql = "INSERT INTO places (user_id,place_name, city, description) VALUES (?,?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $userId,$placeName, $city, $description);
    $stmt->execute();
    $lastPlaceId = $conn->insert_id;

    // Handle image uploads for places
    if (isset($_FILES['placePicture'])) {
        // Loop through each uploaded file
        foreach ($_FILES["placePicture"]["tmp_name"] as $key => $tmp_name) {
            // Get file information
            $file_name = $_FILES["placePicture"]["name"][$key];
            $file_data = file_get_contents($_FILES["placePicture"]["tmp_name"][$key]);

            // Prepare SQL query
            $stmt = $conn->prepare("INSERT INTO places_images (place_id, image_name, image_data) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $lastPlaceId, $file_name, $file_data);
            $stmt->execute();
        }
    }

    // Handle hotel data
    if (isset($_POST['hotelName'])) {
        foreach ($_POST['hotelName'] as $key => $hotelName) {
            // Handle other hotel data
            $contactNumber = $_POST['contactNumber'][$key];
            $email = $_POST['email'][$key];
            $address = $_POST['address'][$key];
            $hotelDescription = $_POST['hotelDescription'][$key];
            // Handle checkbox values for facilities
            $facilitiesArray = isset($_POST['facilities']) ? $_POST['facilities'] : array();
            $hotelFacilities = implode(', ', $facilitiesArray);

            // Insert hotel data into database
            $sql = "INSERT INTO hotels (user_id,place_id, hotel_name, contact_number, email, address, description, facilities) 
                    VALUES (?, ?, ?, ?, ?, ?, ?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isssssss", $userId,$lastPlaceId, $hotelName, $contactNumber, $email, $address, $hotelDescription, $hotelFacilities);
            $stmt->execute();
            $lastHotelId = $conn->insert_id;

            // Upload hotel images and insert image data into database
            if (isset($_FILES['hotelPicture'])) {
                // Loop through each uploaded file
                foreach ($_FILES["hotelPicture"]["tmp_name"] as $key => $tmp_name) {
                    // Get file information
                    $file_name = $_FILES["hotelPicture"]["name"][$key];
                    $file_data = file_get_contents($_FILES["hotelPicture"]["tmp_name"][$key]);

                    // Prepare SQL query
                    $stmt = $conn->prepare("INSERT INTO hotels_images (hotel_id, image_name, image_data) VALUES (?, ?, ?)");
                    $stmt->bind_param("iss", $lastHotelId, $file_name, $file_data);
                    $stmt->execute();
                }
            }
        }
    }

    // Close prepared statement and database connection
    $stmt->close();
    $conn->close();
}
}
else {
    // Handle the case when the user is not logged in
    // Redirect the user to the login page or display an error message
    echo "<script type='text/javascript'>;
          alert('login first');
          window.location.href = 'login signup/login.php';
          </script>";   
}
?>
