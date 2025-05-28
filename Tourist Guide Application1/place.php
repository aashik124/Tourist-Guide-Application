<?php
session_start();

// Check if the address parameter is set in the URL
if(isset($_GET['city'])) {
    // Get the address value from the URL
    $address = $_GET['city'];
    
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
 // Fetch distinct places with images from the database where city is Kathmandu
$sql = "SELECT places_images.place_id, places.id, places.place_name, places.description, MAX(places_images.image_data) AS image_data
FROM places 
JOIN places_images ON places.id = places_images.place_id 
WHERE places.city = 'kathmandu' AND places_images.image_data IS NOT NULL
GROUP BY places_images.place_id";


    $result = $conn->query($sql);

    // Array to store image URLs
    $imageUrls = array();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            // Retrieve image data
            $imageData = $row["image_data"];
            
            // Generate URL for the image
            $imageUrl = 'data:image/jpeg;base64,' . base64_encode($imageData);
            
            // Add URL to the array
            $imageUrls[] = $imageUrl;
        }
    } else {
        echo "No images found in the hotels_images table for the address '$address'.";
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to the home page if the address parameter is not set
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kathmandu</title>
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
            <li><a  href="index.php">Home</a></li>
            <li><a class="active"href="../place.php">Places</a></li>
            <li><a href="/RatingReview/Review.html">Review</a></li>
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
        <a href="image/boudhanathstupa.jpg"><img src="<?php echo $imageUrls[0];?>" alt="Hotel Image 1" alt="Photo 1" class="left-photo"></a>
        <div class="right-photos">
            <a href="image/patan.jpg"><img src="<?php echo $imageUrls[1];?>" alt="Photo 2" class="right-photo"></a>
            <a href="image/nagarkot.jpg"><img src="<?php echo $imageUrls[0];?>"alt="Photo 2" class="right-photo1"></a>
        </div>
    </div>

    <h2 class="left">Places to visit in kathmandu...</h2>
    
    <section id="destinations" class="destinations">
        
        
        <div class="card-container">
            <!-- Repeat the following block for each card -->
            <a href="place.html">
                <div class="card">
                <img src="<?php echo $imageUrls[1];?>" alt="Card Image">
                    <div class="card-content">
                        <h2>Boudha</h2>
                    
                    </div>
                </div>
            </a>
            <a href="">
                <div class="card">
                <img src="<?php echo $imageUrls[0];?>" alt="Card Image">
                    <div class="card-content">
                        <h2>Garden Of Dreams</h2>
                        
                    </div>
                </div>
            </a>
            <a href="">
                <div class="card">
                <img src="<?php echo $imageUrls[1];?>" alt="Card Image">
                    <div class="card-content">
                        <h2>Patan</h2>
                     
                    </div>
                </div>
            </a>
            <a href="">
                <div class="card">
                <img src="<?php echo $imageUrls[0];?>" alt="Card Image">
                    <div class="card-content">
                        <h2>Kathmandu Durbar Square</h2>
                       
                    </div>
                </div>
            </a>
            <a href="">
                <div class="card">
                <img src="<?php echo $imageUrls[1];?>" alt="Card Image">
                    <div class="card-content">
                        <h2>Nagarkot</h2>
                        
                    </div>
                </div>
            </a>
            <a href="">
                <div class="card">
                <img src="<?php echo $imageUrls[0];?>" alt="Card Image">
                    <div class="card-content">
                        <h2>Pashupatinath</h2>
                      
                    </div>
                </div>
            </a>
            <a href="">
                <div class="card">
                <img src="<?php echo $imageUrls[1];?>" alt="Card Image">
                    <div class="card-content">
                        <h2>Swayambhu</h2>
                       
                    </div>
                </div>
            </a>
            
            
            
            <!-- Repeat the above block for each card up to Card 8 -->
        </div>
        
    </section>
    <script>
        function hideMenu() {
            document.getElementById("check").checked = false;
        }

        function scrollCards(direction) {
            const container = document.querySelector('.scroll-content');
            const scrollAmount = 300; // Adjust this value based on how much you want to scroll

            if (direction === 'left') {
                container.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            } else if (direction === 'right') {
                container.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            }
        }
    </script>
</body>
</html>