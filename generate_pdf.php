<?php
// Include the TCPDF library
require_once('tcpdf/tcpdf.php');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "sample";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve data from the database
$sql = "SELECT fullname, age, email, address FROM biodata ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

// Check if there is any data
if ($result->num_rows > 0) {
    // Fetch data from the result set
    $row = $result->fetch_assoc();
    $fullname = $row["fullname"];c
    $age = $row["age"];
    $email = $row["email"];
    $address = $row["address"];

    // Generate PDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle('Submitted Bio Data');
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 12);
    $content = "<h2>Submitted Bio Data</h2>";
    $content .= "<p><strong>Full Name:</strong> $fullname</p>";
    $content .= "<p><strong>Age:</strong> $age</p>";
    $content .= "<p><strong>Email:</strong> $email</p>";
    $content .= "<p><strong>Address:</strong> $address</p>";
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->Output('submitted_data.pdf', 'D'); // 'D' to force download
} else {
    echo "No data found.";
}

$conn->close();
?>
