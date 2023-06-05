<!-- index.php -->

<?php
require_once 'config/db.php';
require_once 'config/function2.php';

// Check if the search parameter is present in the URL
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Retrieve data from the database and filter based on the search parameter
$result = display_data($search);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Pregnant Women Details</title>
    <style>
        body {
            background-color: rgb(224, 183, 20);
            /* color: black; */
        }
        .container {
            margin-top: 50px;
        }
        .card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
        }
        .card-header {
            background-color: rgb(224, 183, 20);
            color: black;
            padding: 10px;
            border-radius: 5px;
        }
        .table {
            background-color: white;
        }
        .btn-primary {
            background-color: rgb(224, 183, 20);
            border-color: rgb(224, 183, 20);
        }
        .btn-primary:hover {
            background-color: rgb(192, 151, 16);
            border-color: rgb(192, 151, 16);
        }
        .btn-danger {
            background-color: rgb(224, 183, 20);
            border-color: rgb(224, 183, 20);
        }
        .btn-danger:hover {
            background-color: rgb(192, 151, 16);
            border-color: rgb(192, 151, 16);
        }
        
    </style>
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class="display-6 text-center">Pregnant Women Details</h2>
                    </div>
                    <div class="card-body">
                        <form action="" method="GET" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search by place" value="<?php echo $search; ?>">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                        <table class="table table-bordered text-center">
                            <tr class="table-dark">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Place</th>
                                <th>Pregnancy Due Date</th>
                                <th>Contact Information</th>
                                <th>Medical History</th>
                                <th>Obstetric History</th>
                                <th>Blood Type</th>
                                <th>Allergies</th>
                                <th>Doctor Information</th>
                                <!-- <th>Edit</th>
                                <th>Delete</th> -->
                            </tr>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['place']; ?></td>
                                    <td><?php echo $row['due_date']; ?></td>
                                    <td><?php echo $row['contact_info']; ?></td>
                                    <td><?php echo $row['medical_history']; ?></td>
                                    <td><?php echo $row['obstetric_history']; ?></td>
                                    <td><?php echo $row['blood_type']; ?></td>
                                    <td><?php echo $row['allergies']; ?></td>
                                    <td><?php echo $row['doctor_info']; ?></td>
                                    <!-- <td><a href="#" class="btn btn-primary">Edit</a></td>
                                    <td><a href="#" class="btn btn-danger">Delete</a></td> -->
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
