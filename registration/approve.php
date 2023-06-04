<?php
// Check if the submissionId and status parameters are received
if (isset($_POST['submissionId']) && isset($_POST['status'])) {
    $submissionId = $_POST['submissionId'];
    $status = $_POST['status'];

    // Update the approval status in the database
    $conn = new mysqli("localhost", "root", "", "Requestes");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE submissions SET approval_status = '$status' WHERE id = '$submissionId'";
    if ($conn->query($sql) === TRUE) {
        echo "Approval status updated successfully";
    } else {
        echo "Error updating approval status: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid parameters";
}
?>
