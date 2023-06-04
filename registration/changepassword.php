<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page or display an error message
    header("Location: login.php");
    exit();
}

// Include the database configuration and establish a connection
include("php/config.php");

// Define variables and set to empty values
$currentPassword = $newPassword = $confirmPassword = "";
$currentPasswordErr = $newPasswordErr = $confirmPasswordErr = "";
$successMessage = $errorMessage = "";

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Validate current password
    if (empty($_POST["current_password"])) {
        $currentPasswordErr = "Current password is required";
    } else {
        $currentPassword = $_POST["current_password"];
    }

    // Validate new password
    if (empty($_POST["new_password"])) {
        $newPasswordErr = "New password is required";
    } else {
        $newPassword = $_POST["new_password"];
    }

    // Validate confirm password
    if (empty($_POST["confirm_password"])) {
        $confirmPasswordErr = "Confirm password is required";
    } else {
        $confirmPassword = $_POST["confirm_password"];
        if ($newPassword != $confirmPassword) {
            $confirmPasswordErr = "Passwords do not match";
        }
    }

    // If there are no errors, update the password in the database
    if (empty($currentPasswordErr) && empty($newPasswordErr) && empty($confirmPasswordErr)) {
        // Retrieve the username from the session
        $username = $_SESSION['username'];

        // Retrieve the current password from the database
        $sql = "SELECT password FROM users WHERE username = '$username'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $storedPassword = $row['password'];

            // Verify the current password
            if ($currentPassword === $storedPassword) {
                // Update the password in the database
                $updateSql = "UPDATE users SET password = '$newPassword' WHERE username = '$username'";
                if (mysqli_query($con, $updateSql)) {
                    $successMessage = "Password updated successfully";
                } else {
                    $errorMessage = "Error updating password: " . mysqli_error($con);
                }
            } else {
                $currentPasswordErr = "Incorrect current password";
            }
        } else {
            $errorMessage = "User not found";
        }
    }
}

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="change.css">
</head>
<body>
    <div class="container">
        <h2>Change Password</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" name="current_password" id="current_password" required>
                <span class="error"><?php echo $currentPasswordErr; ?></span>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" id="new_password" required>
                <span class="error"><?php echo $newPasswordErr; ?></span>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
                <span class="error"><?php echo $confirmPasswordErr; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Change Password">
            </div>
        </form>
        <span class="success"><?php echo $successMessage; ?></span>
        <span class="error"><?php echo $errorMessage; ?></span>
    </div>
</body>
</html>


