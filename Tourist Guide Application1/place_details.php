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
$placeName = "";
$placeDescription = "";
$placeImages = array();
$hotels = array();

// Check if the place ID parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the place ID value from the URL
    $placeId = $_GET['id'];

    // Fetch place details from the database based on place ID
    $sqlPlace = "SELECT * FROM places WHERE id = '$placeId'";
    $resultPlace = $conn->query($sqlPlace);

    // Check if a place row was returned
    if ($resultPlace->num_rows > 0) {
        // Get place details
        $place = $resultPlace->fetch_assoc();
        $placeName = $place['place_name'];
        $placeDescription = $place['description'];

        // Fetch place images
        $sqlImages = "SELECT distinct  image_data FROM places_images WHERE place_id = '$placeId'";
        $resultImages = $conn->query($sqlImages);
        while ($row = $resultImages->fetch_assoc()) {
            $placeImages[] = 'data:image/jpeg;base64,' . base64_encode($row['image_data']);
        }
  
       // Fetch hotel details associated with the place
       $sqlHotels = "SELECT hotels.id AS hotel_id, hotels.hotel_name, hotels.description AS hotel_description, hotels_images.image_data 
       FROM hotels
        JOIN hotels_images ON hotels.id = hotels_images.hotel_id
       WHERE hotels.place_id = '$placeId'
       GROUP BY hotels.id";

        $resultHotels = $conn->query($sqlHotels);

        // Array to store hotel data including images
        $hotels = array();

        // Check if any rows were returned
        if ($resultHotels->num_rows > 0) {
        // Output data of each row
        while ($row = $resultHotels->fetch_assoc()) {
        // Add image data to the hotel data
        $row['image_data'] = 'data:image/jpeg;base64,' . base64_encode($row['image_data']);
        $imageUrls[] = $row['image_data'];
        // Add hotel data to the array
        $hotels[] = $row;
        }
        } else {
        $hotels = array();
        }
}

// Close the database connection
$conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $placeName; ?> - Hotel Details</title>
    <link rel="stylesheet" href="placeStyle.css">
</head>
<body>
<nav>
    <label for="check" class="checkbtn">&#9776;</label>
    <label class="logo"><span class="logoText">T</span><span class="logoText">G</span><span class="logoText">A</span></label>
    <label class="logo1"><span class="logoText">Tourist</span><span class="logoText">Guide</span><span
                class="logoText">Application</span></label>
    <input type="checkbox" id="check">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a  href="AddPlacesFinal.html">Add Places</a></li>
        <li><a href="Review.html">Write Review</a></li>
        <?php if (isset($_SESSION['username'])) : ?>
            <li><a href="login signup/Logout.php" class="logout-btn">Logout</a></li>
        <?php else : ?>
            <li><a href="login signup/login.html" class="login-btn">Login</a></li>
        <?php endif; ?>
        <li class="closebtn" onclick="hideMenu()">&#10006;</li>
    </ul>
</nav>

<h2 class="explore">Explore <?php echo $placeName; ?> in photos...</h2>
    <div class="photo-container">
        <a href="image/boudhanathstupa.jpg"><img src="<?php echo $placeImages[0]; ?>" alt="Hotel Image 1" class="left-photo">
</a>
        <div class="right-photos">
            <a href="image/patan.jpg"><img src="<?php echo $placeImages[1];?>" alt="Photo 2" class="right-photo"></a>
            <a href="image/nagarkot.jpg"><img src="<?php echo $placeImages[2];?>"alt="Photo 2" class="right-photo1"></a>
        </div>
    </div>
    
        <h3 class="about"> <?php echo $placeName; ?></h2>
        <p class="about"><?php echo $placeDescription; ?></p>

<h2 class="left"><?php echo $placeName; ?> - Hotels</h2>
<section id="destinations" class="destinations">
    <div class="card-container">
    <?php foreach ($hotels as $hotel): ?>
        <a href="hotel_details.php?id=<?php echo $hotel['hotel_id']; ?>">
                <div class="card">
                <img src="<?php echo $hotel['image_data']; ?>" alt="Hotel Image">
                    <div class="card-content">
                    <h3><?php echo $hotel['hotel_name']; ?></h3>
                   
                        <!-- Add more details or buttons as needed -->
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</section>
<script>
    // JavaScript code here
</script>
</body>
</html>
