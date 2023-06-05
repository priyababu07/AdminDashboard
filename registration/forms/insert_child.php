<?php
// Retrieve the form data
$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$parentName = $_POST['parent_name'];
$address = $_POST['address'];

// Create a new connection to the database
$conn = new mysqli("localhost", "root", "", "AganwadiWorker");

// Check if the connection was successful
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement to insert data into the Child table
$sql = "INSERT INTO Child (name, age, gender, parent_name, address)
        VALUES ('$name', $age, '$gender', '$parentName', '$address')";

// Execute the SQL statement
if ($conn->query($sql) === TRUE) {
  echo "Child details inserted successfully!";
} else {
  echo "Error inserting child details: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
