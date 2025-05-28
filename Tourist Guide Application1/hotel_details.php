<?php
session_start();
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

// Initialize variables
$hotelName = "";
$hotelDescription = "";
$hotelEmail = "";
$hotelContactNumber = "";
$hotelImages = array();
$hotelFacilities = array();
$facilitySet = array(); // Set for unique facilities
$imageSet = array(); // Set for unique images

// Check if the hotel ID parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the hotel ID value from the URL
    $idHotel = $_GET['id'];

    // Fetch hotel details from the database based on hotel ID
    $sqlHotel = "SELECT DISTINCT * FROM hotels WHERE id = '$idHotel'";
    $resultHotel = $conn->query($sqlHotel);

    // Check if a hotel row was returned
    if ($resultHotel->num_rows > 0) {
        // Get hotel details
        while($hotel = $resultHotel->fetch_assoc()){
            $hotelName = $hotel['hotel_name'];
            $hotelDescription = $hotel['description'];
            $hotelEmail = $hotel['email'];
            $hotelContactNumber = $hotel['contact_number'];
            // Fetch and explode hotel facilities
            $facilities = $hotel['facilities'];
            $facilitiesArray = explode(',', $facilities);

            // Add unique facilities to the set
            foreach ($facilitiesArray as $facility) {
                if (!in_array($facility, $facilitySet)) {
                    $hotelFacilities[] = $facility;
                    $facilitySet[] = $facility;
                }
            }
        }
    }

    // Fetch hotel images
    $sqlImages = "SELECT image_data FROM hotels_images WHERE hotel_id = '$idHotel'";
    $resultImages = $conn->query($sqlImages);

    // Check if any images were returned
    if ($resultImages->num_rows > 0) {
        while ($row = $resultImages->fetch_assoc()) {
            $imageData = 'data:image/jpeg;base64,' . base64_encode($row['image_data']);
            // Add unique images to the set
            if (!in_array($imageData, $imageSet)) {
                $hotelImages[] = $imageData;
                $imageSet[] = $imageData;
            }
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $hotelName; ?> - Hotel Details</title>
    <link rel="stylesheet" href="placeStyle.css">
</head>
<body>

<h2 class="explore">Explore <?php echo $hotelName; ?> in photos...</h2>
<div class="photo-container">
    <?php if (!empty($hotelImages[0])): ?>
        <a href="<?php echo $hotelImages[0]; ?>"><img src="<?php echo $hotelImages[0]; ?>" alt="Hotel Image 1" class="left-photo"></a>
    <?php endif; ?>
    <div class="right-photos">
        <?php if (!empty($hotelImages[1])): ?>
            <a href="<?php echo $hotelImages[1]; ?>"><img src="<?php echo $hotelImages[1]; ?>" alt="Photo 2" class="right-photo"></a>
        <?php endif; ?>
        <?php if (!empty($hotelImages[2])): ?>
            <a href="<?php echo $hotelImages[2]; ?>"><img src="<?php echo $hotelImages[2]; ?>" alt="Photo 3" class="right-photo1"></a>
        <?php endif; ?>
    </div>
</div>

<h2 class="about">About <?php echo $hotelName; ?></h2>
<p class="about"><?php echo $hotelDescription; ?></p>

<h2 class="left"><?php echo $hotelName; ?> - Hotels</h2>
<section id="destinations" class="destinations">
    <div class="card-container">
        <!-- Display hotel details -->
        <div class="card">
            <div class="card-content">
                <h3><?php echo $hotelName; ?></h3>
                <p>Email: <?php echo $hotelEmail; ?></p>
                <p>Contact Number: <?php echo $hotelContactNumber; ?></p>
                <!-- Display hotel facilities -->
                <?php if (!empty($hotelFacilities)): ?>
                    <div class="card">
                        <h4>Facilities:</h4>
                        <ul>
                            <?php foreach ($hotelFacilities as $facility): ?>
                                <li><?php echo $facility; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
    // JavaScript code here
</script>
</body>
</html>
