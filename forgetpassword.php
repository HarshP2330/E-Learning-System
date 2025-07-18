<?php 
include('./dbConnection.php');
// Header Include from mainInclude 
include('./mainInclude/header.php'); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['request_otp'])) {
    $stuemail = $_POST['stu_email']; // Correct name used here

    // Check if email exists in the database
    $query = "SELECT * FROM student WHERE stu_email='$stuemail'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Generate OTP and store it in the session
        $otp = rand(100000, 999999); // Generate a 6-digit OTP
        $_SESSION['otp'] = $otp;
        $_SESSION['reset_email'] = $stuemail; // Correct variable used here

        // Send OTP via email
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';  // Set the SMTP server to send through
            $mail->SMTPAuth   = true;
            $mail->Username   = '22bmiitbscit005@gmail.com';  // Your email address
            $mail->Password   = 'welg rops twhu djre';   // Your email password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('22bmiitbscit005@gmail.com', 'Password Reset');  // Sender's email
            $mail->addAddress($stuemail);  // Add the recipient's email address

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your OTP for Password Reset';
            $mail->Body    = "Your OTP for password reset is: <b>$otp</b>";

            $mail->send();
            echo 'OTP has been sent to your email.';

            header("Location: OTPVERIFY.php");
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom right, #b3d9ff, #e6f7ff); /* Light blue gradient */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }

        form {
            background-color: #ffffff; /* White form background */
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #0056b3; /* Dark blue text */
            font-size: 1.8rem;
            font-weight: bold;
        }

        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin: 15px 0;
            border: 1px solid #b0d4f1;
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            font-weight: bold;
            color: #fff;
            background: linear-gradient(to right, #0056b3, #007bff);
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: transform 0.2s, background 0.3s;
        }

        button:hover {
            background: linear-gradient(to right, #004b99, #0069d9);
            transform: translateY(-2px);
        }

        button:active {
            transform: translateY(0);
        }

        .message {
            margin-top: 15px;
            color: red;
            font-size: 0.9rem;
        }

        @media screen and (max-width: 500px) {
            form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <h2>Forgot Password</h2>
        <input type="email" name="stu_email" placeholder="Enter your email" required>
        <button type="submit" name="request_otp">Request OTP</button>
    </form>
</body>
</html>
