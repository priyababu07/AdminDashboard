<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lactating Women Details Form</title>
</head>
<body>
    <h1>Lactating Women Details</h1>

    <?php
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the form data
        $name = $_POST['name'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $baby_age = $_POST['baby_age'];

        // Create a database connection
        $conn = mysqli_connect("localhost", "root", "", "AganwadiWorker");

        // Check if the connection is successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare the SQL statement to insert data into the database
        $sql = "INSERT INTO LactatingWomen (name, age, address, contact, email, baby_age)
                VALUES ('$name', $age, '$address', '$contact', '$email', '$baby_age')";

        // Execute the SQL statement
        if (mysqli_query($conn, $sql)) {
            echo "Lactating women details inserted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required><br><br>

        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea><br><br>

        <label for="contact">Contact Number:</label>
        <input type="tel" id="contact" name="contact" pattern="[0-9]{10}" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="baby_age">Baby's Age:</label>
        <input type="text" id="baby_age" name="baby_age" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
