<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "lms_db";

// Connect to the database
// $conn = new mysqli($host, $username, $password, $dbname);
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data if form is submitted
if (isset($_POST['submit'])) {
    $S_Name = $_POST['name'];
    $issue_date = $_POST['date'];

    // Insert data into the database
    $sql = "INSERT INTO certificate (S_Name,issue_date) VALUES ('$S_Name','$issue_date')";
    if ($conn->query($sql) === TRUE) {
        $id = $conn->insert_id; // Get the last inserted ID
        header("Location: cert_1.php?id=$id"); // Redirect to the display page with the ID
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Certificate Form</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background: #f0f4f8;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            form {
                background: #ffffff;
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 400px;
                text-align: center;
            }

            form h2 {
                margin-bottom: 20px;
                font-size: 1.8em;
                color: #333;
            }

            form label {
                display: block;
                text-align: left;
                font-size: 1em;
                color: #555;
                margin-bottom: 5px;
            }

            form input[type="text"],
            form input[type="date"] {
                width: 100%;
                padding: 10px;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 1em;
                color: #333;
                background: #f9f9f9;
            }

            form input[type="text"]:focus,
            form input[type="date"]:focus {
                border-color: #007BFF;
                outline: none;
                background: #ffffff;
            }

            form input[type="submit"] {
                background: #007BFF; /* Blue color */
                color: #fff;
                border: none;
                padding: 12px 20px;
                border-radius: 4px;
                font-size: 1em;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            form input[type="submit"]:hover {
                background: #0056b3; /* Darker blue for hover */
            }

            form input[type="submit"]:active {
                background: #004085; /* Even darker blue for active state */
            }

            form p {
                margin-top: 10px;
                font-size: 0.9em;
                color: #777;
            }

        </style>
    </head>
    <body>
        <form method="post" action="">
            <h2>Generate Your Certificate</h2>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Enter your name" required><br>

            <label for="date">Date</label>
            <input type="date" name="date" id="date" required><br>

            <input type="submit" name="submit" value="Generate Certificate">

            <p>Your certificate will be ready instantly!</p>
        </form>
    </body>
</html>
