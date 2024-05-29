<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'calendar';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $time = $_POST['time'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO event_registration (title, description, time) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $description, $time);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Event Inserted Successfully";
    } else {
        echo "Failed: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
