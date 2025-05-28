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

// Check if the address parameter is set in the URL
if (isset($_GET['city'])) {
    // Get the address value from the URL
    $address = $_GET['city'];

    // Fetch places from the database where city is $address
    $sql = "SELECT places_images.place_id, places.id, places.place_name, places.description, MAX(places_images.image_data) AS image_data
    FROM places 
    JOIN places_images ON places.id = places_images.place_id 
    WHERE places.city = '$address' AND places_images.image_data IS NOT NULL
    GROUP BY places_images.place_id;";
    $result = $conn->query($sql);

    // Fetch places from the database where city is $address
    $sqlCity = "SELECT description from aboutcity where city_name='$address'";
    $resultAbout = $conn->query($sqlCity);

    // Check if any rows were returned
    if ($resultAbout->num_rows > 0) {
        // Output data of each row
        while ($row = $resultAbout->fetch_assoc()) {
            // Retrieve image data
            $aboutUs = $row["description"];
        }
    } else {
        $aboutUs = "Not found";
    }

    // Array to store places data including images
    $places = array();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            // Add image data to the place data
            $row['image_data'] = 'data:image/jpeg;base64,' . base64_encode($row['image_data']);
            
              // Add URL to the array
              $imageUrls[] = $row['image_data'];
            // Add place data to the array
            $places[] = $row;
        }
    } else {
        $places = array();
    }
// Fetch feedback for the city including user name and images
$feedbackSql = "SELECT feedback.review_text, feedback.created_at,feedback_images.image_data, user_tbl.Username
FROM feedback
JOIN feedback_images ON feedback.id = feedback_images.feedback_id
JOIN user_tbl ON feedback.user_id = user_tbl.id
WHERE feedback.city = '$address'";
$feedbackResult = $conn->query($feedbackSql);


   // Array to store feedback data grouped by username
   $feedbacksByUser = array();

   // Check if any rows were returned
   if ($feedbackResult->num_rows > 0) {
       // Output data of each row
       while ($row = $feedbackResult->fetch_assoc()) {
           // Add feedback data to the array grouped by username
           $username = $row['Username'];
           $feedbacksByUser[$username]['review_text'] = $row['review_text'];
           $feedbacksByUser[$username]['created_at'] = $row['created_at'];
           $feedbacksByUser[$username]['images'][] = 'data:image/jpeg;base64,' . base64_encode($row['image_data']);
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
    <title><?php echo $address; ?></title>
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

<h2 class="explore">Explore kathmandu in photos...</h2>
    <div class="photo-container">
        <a href="image/boudhanathstupa.jpg"><img src="<?php echo $imageUrls[0];?>" alt="Image 1" class="left-photo"></a>
        <div class="right-photos">
            <a href="image/patan.jpg"><img src="<?php echo $imageUrls[1];?>" alt="Image 2" class="right-photo"></a>
            <a href="image/nagarkot.jpg"><img src="<?php echo $imageUrls[2];?>"alt="Image 3" class="right-photo1"></a>
        </div>
    </div><br>
    <h3 class="about">About <?php echo $address;?></h3>
        <p class="about"><?php echo $aboutUs;  ?></p>
<h2 class="left">Places to visit in <?php echo $address; ?>.</h2>
<section id="destinations" class="destinations">
    <div class="card-container">
        <?php foreach ($places as $place): ?>
            <a href="place_details.php?id=<?php echo $place['id']; ?>">
                <div class="card">
                    <img src="<?php echo $place['image_data']; ?>" alt="Card Image">
                    <div class="card-content">
                        <h2><?php echo $place['place_name']; ?></h2>
                        <!-- <p><?php //echo $place['description']; ?></p> -->
                        <!-- Add more details or buttons as needed -->
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</section>
<?php if (!empty($feedbacksByUser)): ?>
    <div class="feedback-section">
        <h2 class="about">Feedback for <?php echo $address; ?></h2>
        <?php
        // Reverse the feedback array to display the newest feedback first
        $feedbacksByUser = array_reverse($feedbacksByUser, true);
        
        foreach ($feedbacksByUser as $username => $feedback): ?>
            <div class="feedback-item">
                <p><?php echo $username; ?></p>
                <p><?php echo $feedback['created_at']; ?></p>
                <p><?php echo $feedback['review_text']; ?></p>
                <div class="card-container">
                    <?php foreach ($feedback['images'] as $image): ?>
                        <div class="card">
                            <img src="<?php echo $image; ?>" alt="Feedback Image">
                            <div class="card-content">
                                <!-- Add more details or buttons as needed -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>



<br><br><br>
<script>
    function hideMenu() {
        document.getElementById("check").checked = false;
    }
</script>
</body>
</html>
