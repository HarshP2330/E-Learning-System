<?php
include('./dbConnection.php'); // Ensure this file sets up $conn variable
include('./mainInclude/header.php'); // Ensure this file exists for the header

// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['reset_password'])) {
    // Check if email is provided in the form
    if (!isset($_POST['email']) || empty($_POST['email'])) {
        echo "Email is required to reset the password.";
        exit();
    }

    $stu_email = $_POST['email']; // Get email from form input
    $stu_pass = $_POST['password']; // Get new password from form input
    // $stu_pass = $_POST['cpassword']; // Get confirm password from form input

    // Check if passwords match
    if ($password === $cpassword) {
        // Hash the password for security
        $stu_pass = password_hash($stu_pass, PASSWORD_BCRYPT);

        // Update the password in the database
        $query = "UPDATE student SET stu_pass='$stu_pass' WHERE stu_email='$stu_email'";
        $result = mysqli_query($query);

        if ($result) {
            // On success, redirect to the login page
            echo "Password updated successfully!";
            header("Location: index.php");
            exit();
        } else {
            // Handle query error
            echo "Error updating password: " . mysqli_error($conn);
        }
    } else {
        echo "<div class='message'>Passwords do not match!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #A4D8E1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            width: 400px;
            max-width: 90%;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #003366, #D5006D);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: linear-gradient(to right, #001f4d, #c30055);
        }
        .message {
            margin-top: 15px;
            color: red;
        }
    </style>
</head>
<body>
    <form method="POST" action="index.php">
        <h2>Reset Password</h2>
        <input type="password" name="cpassword" placeholder="Confirm new password" required>
        <button type="submit" name="reset_password">Reset Password</button>
    </form>
</body>
</html>
