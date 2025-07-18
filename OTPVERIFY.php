<?php
 include('./dbConnection.php');
  // Header Include from mainInclude 
  include('./mainInclude/header.php'); 
?>
<?php

if (isset($_POST['verify'])) {
    $entered_otp = $_POST['otp'];
    
    if ($_SESSION['otp'] == $entered_otp) {
       
        header("Location: Reset.php");
        exit();
    } else {
        echo "Invalid OTP!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
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
        input[type="text"] {  
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
    <form method="POST" action="">
        <h2>Verify OTP</h2>
        <input type="text" name="otp" placeholder="Enter OTP" required>
        <button type="submit" name="verify">Verify</button>
    </form>
</body>
</html>