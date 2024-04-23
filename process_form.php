<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission Result</title>
</head>
<body>
    <h2>Submitted Bio Data</h2>

    <?php
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "sample"; // Replace with your actual database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare variables with form data
    $fullname = $_POST["fullname"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $address = $_POST["address"];

    // SQL query to insert data into the table
    $sql = "INSERT INTO biodata (fullname, age, email, address) VALUES ('$fullname', $age, '$email', '$address')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
    ?>

    <!-- Display submitted data if form is submitted -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve submitted data if available
        $fullname = isset($_POST["fullname"]) ? $_POST["fullname"] : '';
        $age = isset($_POST["age"]) ? $_POST["age"] : '';
        $email = isset($_POST["email"]) ? $_POST["email"] : '';
        $address = isset($_POST["address"]) ? $_POST["address"] : '';

        // Display submitted data
        echo "<p><strong>Full Name:</strong> $fullname</p>";
        echo "<p><strong>Age:</strong> $age</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Address:</strong> $address</p>";
    } else {
        echo "<p>No data submitted.</p>";
    }
    ?>

    <!-- Download button -->
    <form action="generate_pdf.php" method="post">
        <input type="submit" name="download_pdf" value="Download PDF">
    </form>
</body>
</html>
