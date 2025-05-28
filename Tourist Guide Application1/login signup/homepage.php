<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourist Guide Application</title>
    <link rel="stylesheet" href="" href="">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        header {
            background-color: #fbfb07;
            color: rgb(7, 7, 247);
            padding: 10px;
            text-align: center;
        }

        main {
            padding: 20px;
        }

        section {
            margin-bottom: 20px;
        }

        .search-bar {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .featured-destinations {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .destination-card {
            width: 30%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
        }

        .destination-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .destination-card h3 {
            padding: 10px;
            margin: 0;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
            
        }
        .abc{
            background-image: url('Gorkha.jpg');
            background-color: aqua;
            position: sticky;
        }
    </style>
</head>

<body>
    <header>
        <h1>Tourist Guide Application</h1>
    </header>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <a href="logout.php">Logout</a>
    <main>
        <section id="search">
            <input type="search" class="search-bar" placeholder="Search...">
        </section>
        <div class="abc">
            <br><br><br><br><br><br><br>
        </div>

        <section>
            <h1>Featured Destinations by TGA...</h1>
                <div class="featured-destinations">
                <div class="destination">
                <button><img src="Gorkha.jpg" alt="Gorkha" height="200" width="330">
                    <h3>Gorkha</h3>
                </button>
                </div>
                
                <div class="destination">
                <button>
                    <img src="kathmandu.webp" alt="Ktm" height="200" width="330">
                    <h3>Kathmandu</h3>
                </button>
                </div>
                
                <div class="destination">
                    <button><img src="pokhara.webp" alt="Pkh" height="200" width="330">
                    <h3>Pokhara</h3>
                    </button>
                </div>
                <div class="destination">
                <button>
                    <img src="chitwan.webp" alt="Ctwn" height="200" width="330">
                    <h3>Chitwan</h3>
                </button>
                </div>
                
                </div>
        </section>
    </main>

    

    <center><p><b>Contact: 9819101513</b></p></center>
    <footer>
        &copy; 2024 Tourist Guide Application. All rights reserved.
    </footer>
</body>

</html>
