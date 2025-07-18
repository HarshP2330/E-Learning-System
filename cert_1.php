<?php
require('certificate/FPDF-master/FPDF-master/fpdf/fpdf.php'); // Ensure the correct path to FPDF library

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

// Fetch data by ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM certificate WHERE Cer_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['S_Name'];
        $date = $row['issue_date'];
    } else {
        die("No record found.");
    }
} else {
    die("No ID provided.");
}

$conn->close();

// Generate PDF using FPDF
class PDF extends FPDF {
    function Header() {
        // Add a background image
        $this->Image('Certificate.jpg', 0, 0, 210, 297); // Adjust dimensions to fit the page
    }
}

// Create PDF
$pdf = new PDF();
$pdf->AddPage();

// Set font for the name and date
$pdf->SetFont('Arial', 'B', 24);
$pdf->SetTextColor(50, 50, 50); // Set text color

// Add name
$pdf->SetXY(30, 120); // Adjust X and Y position to fit on the image
$pdf->Cell(0, 10, "Name : $name", 0, 1, 'C');

// Add date
$pdf->SetFont('Arial', '', 18);
$pdf->SetXY(50, 220); // Adjust X and Y position to fit on the image
$pdf->Cell(-10, 10, " $date", 0, 5, 'C');

$pdf->SetFont('Arial','',18);
$pdf->SetXY(100,220);
$sing="R.S.Patel";
$pdf->Cell(0,10,"$sing",0,1,'C');

// Save the PDF to a file
$file_path = "certificate_$id.pdf";
$pdf->Output('F', $file_path);

// Display the PDF in an iframe and provide a download link
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
</head>
<body>
<a href="<?php echo $file_path; ?>" download="certificate_<?php echo $id; ?>.pdf">
        <button>Download Certificate</button>
    </a>
    <iframe src="<?php echo $file_path; ?>" width="100%" height="600px"></iframe>
    <br>
    
</body>
</html>