<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="mySidenav" class="sidenav">
        <p class="logo"><span>Paa</span>lan</p>
        <a href="#" class="icon-a"><i class="fa fa-dashboard icons"></i> &nbsp;&nbsp;Dashboard</a>
        <a href="agw.php"class="icon-a"><i class="fa fa-users icons"></i> &nbsp;&nbsp;Aganwadi Worker Details</a>
        <a href="pgw.php"class="icon-a"><i class="fa fa-list icons"></i> &nbsp;&nbsp;Preganant Women Details</a>
        <a href="#"class="icon-a"><i class="fa fa-shopping-bag icons"></i> &nbsp;&nbsp;Orders</a>
        <a href="#"class="icon-a"><i class="fa fa-tasks icons"></i> &nbsp;&nbsp;Inventory</a>
        <a href="#"class="icon-a"><i class="fa fa-user icons"></i> &nbsp;&nbsp;Accounts</a>
        <a href="#"class="icon-a"><i class="fa fa-list-alt icons"></i> &nbsp;&nbsp;Tasks</a>
    </div>
    <div id="main">
        <div class="head">
            <div class="col-div-6">
                <span style="font-size:30px;cursor:pointer; color: white;" class="nav"  >&#9776; Dashboard</span>
                <span style="font-size:30px;cursor:pointer; color: white;" class="nav2"  >&#9776; Dashboard</span>
            </div>
            <div class="col-div-6">
                <div class="profile">
                    <div class="dropdown">
                        <span class="material-icons-outlined account-icon">account_circle</span>
                        <div class="dropdown-content">
                            <a href="#">Log out</a>
                            <a href="changepassword.php">Change Password</a>
                        </div>
                    </div>
                    <span class="username">
                        <?php 
                        echo $_SESSION['username']; 
                        ?>
                    </span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        
       
        <div class="col-div-3">
            <div class="box">
            <p>45<br/><span>Customers</span></p>
                <i class="fa fa-users box-icon"></i>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box">
                <p>88<br/><span>Projects</span></p>
                <i class="fa fa-list box-icon"></i>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box">
                <p>99<br/><span>Orders</span></p>
                <i class="fa fa-shopping-bag box-icon"></i>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box">
                <p>78<br/><span>Tasks</span></p>
                <i class="fa fa-tasks box-icon"></i>
            </div>
        </div>
        <div class="clearfix"></div>
        <br/><br/>
        <div class="col-div-8">
            <div class="box-8">
                <div class="content-box">
                    <p>Approval Board </p>
                    
                    <?php
                    // Retrieve submissions with approval status as "pending" from the database
                    $conn = new mysqli("localhost", "root", "", "Requestes");
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM submissions WHERE approval_status = 'pending'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table>";
                        echo "<tr><th>Name</th><th>Email</th><th>Message</th><th>Action</th></tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['message'] . "</td>";
                            echo '<td>';
                            echo '<button class="status-button" data-submission-id="' . $row['id'] . '" data-status="approved">Approve</button>';
                            echo '<button class="status-button" data-submission-id="' . $row['id'] . '" data-status="rejected">Reject</button>';
                            echo '</td>';
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "No pending submissions.";
                    }
                    $conn->close();
                    ?>

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                    $(document).ready(function() {
                        // Listen for click on status buttons
                        $('.status-button').click(function() {
                            var submissionId = $(this).data('submission-id');
                            var status = $(this).data('status');

                            // Send AJAX request to update the approval status
                            $.ajax({
                                type: 'POST',
                                url: 'approve.php',
                                data: { submissionId: submissionId, status: status },
                                success: function(response) {
                                    console.log(response);
                                    // Handle success response if needed
                                },
                                error: function(error) {
                                    console.log(error);
                                    // Handle error gracefully if needed
                                }
                            });
                        });
                    });
                    </script>

                </div>
            </div>
        </div>

        <div class="col-div-4">
            <div class="box-4">
                <div class="content-box">
                    <p>Total Sale </p>

                    <div class="circle-wrap">
                        <div class="circle">
                            <div class="mask full">
                                <div class="fill"></div>
                            </div>
                            <div class="mask half">
                                <div class="fill"></div>
                            </div>
                            <div class="inside-circle"> 70% </div>
                        </div>
                    </div>
                </div>
            </div
