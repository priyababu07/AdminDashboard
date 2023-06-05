<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    // Validate and sanitize the data if needed

    // Create a database connection
    $conn = new mysqli("localhost", "root", "", "AganwadiWorker");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query
    $sql = "INSERT INTO AganwadiWorker (id, username, email, age) VALUES ('$id', '$username', '$email', '$age')";
    if ($conn->query($sql) === TRUE) {
        echo "Aganwadi Worker details inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
