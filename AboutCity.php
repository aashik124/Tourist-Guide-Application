<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $city = $_POST['city'];
    $about_us = $_POST['about_us'];

    // Database connection settings
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "touristguide";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the SQL statement with placeholders
    $sql = "INSERT INTO aboutcity (city_name, description) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $city, $about_us);

    // Execute the prepared statement
    if ($stmt->execute() === TRUE) {
        echo "<p>City information added successfully.</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add City Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label,
        input,
        textarea,
        input[type="submit"] {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }

        input[type="text"],
        textarea {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Responsive layout */
        @media screen and (max-width: 600px) {
            form {
                padding: 10px;
            }

            label,
            input,
            textarea,
            input[type="submit"] {
                margin-bottom: 5px;
            }

            input[type="text"],
            textarea {
                padding: 8px;
            }

            input[type="submit"] {
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>
    <h2>Add City Information</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>
        
        <label for="about_us">About Us:</label>
        <textarea id="about_us" name="about_us" rows="4" cols="50" required></textarea>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
