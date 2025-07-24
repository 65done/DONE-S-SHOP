<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = "done's shop";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form inputs
$fullName = mysqli_real_escape_string($conn, $_POST['name']);
$location = mysqli_real_escape_string($conn, $_POST['location']);
$phone = mysqli_real_escape_string($conn, $_POST['number']);

// Handle checkbox selections
if (isset($_POST['order']) && is_array($_POST['order'])) {
    $selection = implode(', ', $_POST['order']);
} else {
    $selection = 'None selected';
}

// Insert into database
$sql = "INSERT INTO `selection` (`Full Name`, `Selection`, `Location`, `Phone Number`)
        VALUES ('$fullName', '$selection', '$location', '$phone')";

if ($conn->query($sql) === TRUE) {
    echo "<h2 style='color: green;'>Thank you $fullName! Your order has been received.</h2>";
    echo "<a href='index.html'>Go back to shop</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
