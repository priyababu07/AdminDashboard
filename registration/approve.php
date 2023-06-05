<?php
// Check if the submissionId and status parameters are received
if (isset($_POST['submissionId']) && isset($_POST['status'])) {
    $submissionId = $_POST['submissionId'];
    $status = $_POST['status'];

    // Update the approval status in the "submissions" table
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

    // If the data is approved, move it to another database and table
    if ($status === "approved") {
        // Connect to the "Requestes" and the target database
        $sourceConn = new mysqli("localhost", "root", "", "Requestes");
        $targetConn = new mysqli("localhost", "root", "", "AganwadiWorker");

        if ($sourceConn->connect_error) {
            die("Source Connection failed: " . $sourceConn->connect_error);
        }

        if ($targetConn->connect_error) {
            die("Target Connection failed: " . $targetConn->connect_error);
        }

        // Retrieve the approved data from the "submissions" table
        $sql = "SELECT * FROM submissions WHERE id = '$submissionId'";
        $result = $sourceConn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Extract the data
            $username = $row['username'];
            $email = $row['email'];
            $age = $row['age'];

            // Insert the data into the target table in the target database
            $sql = "INSERT INTO  AGW (username, email, age) VALUES ('$username', '$email', '$age')";
            if ($targetConn->query($sql) === TRUE) {
                echo "Data moved to the target table successfully";
            } else {
                echo "Error moving data to the target table: " . $targetConn->error;
            }
        } else {
            echo "No data found in submissions table for the given submissionId";
        }

        // Close the database connections
        $sourceConn->close();
        $targetConn->close();
    }
} else {
    echo "Invalid parameters";
}
?>
