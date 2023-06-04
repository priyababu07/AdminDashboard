<?php
// require_once("config/db.php");


// $query = "SELECT * FROM AganwadiWorker";
// $result = mysqli_query($con, $query);

require_once 'config/db.php';
require_once 'config/functions.php';
$result = display_data();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Fetch data from PHP</title>
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class="display-6 text-center">Fetching</h2>
                    </div>
                    <div class="card-body">
                        <table class="table  table-bordered text-center">
                            <tr class="table-dark">
                                <th>Id</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Age</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            <?php
                            while($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row['Id']; ?></td>
                                <td><?php echo $row['Username']; ?></td>
                                <td><?php echo $row['Email']; ?></td>
                                <td><?php echo $row['Age']; ?></td>
                                <td><a href="#" class="btn btn-primary">Edit</a></td>
                                <td><a href="#" class="btn btn-danger">Delete</a></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
