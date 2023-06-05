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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="mySidenav" class="sidenav">
        <p class="logo"><span>Paa</span>lan</p>
        <a href="#" class="icon-a"><i class="fa fa-dashboard icons"></i> &nbsp;&nbsp;Dashboard</a>
        <a href="agw.php"class="icon-a"><i class="fa fa-users icons"></i> &nbsp;&nbsp;Aganwadi Worker Details</a>
        <a href="pgw.php"class="icon-a"><i class="fa fa-list icons"></i> &nbsp;&nbsp;Preganant Women Details</a>
        <a href="child.php"class="icon-a"><i class="fa fa-shopping-bag icons"></i> &nbsp;&nbsp;Child Detail</a>
        <a href="#"class="icon-a"><i class="fa fa-tasks icons"></i> &nbsp;&nbsp;Messages</a>
        <a href="#"class="icon-a"><i class="fa fa-user icons"></i> &nbsp;&nbsp;Accounts</a>
        
    </div>
    <div id="main">
        <div class="head">
            <div class="col-div-6">
                <span style="font-size:30px;cursor:pointer; color: white;" class="nav"  >&#9776; Dashboard</span>
                <span style="font-size:30px;cursor:pointer; color: white;" class="nav2"  >&#9776; Dashboard</span>
            </div>
            <div class="col-div-6">
            <div class="dropdown">
            <div class="profile"><span id="account-icon" class="material-icons-outlined account-icon" style="margin-left: 450px; font-size: 45px;">account_circle</span>
        
            
            <div class="dropdown-content" for="account-icon">
                <a href="logout.php">Log out</a>
                <a href="changepassword.php">Change Password</a>
            </div>
        </div>
                    <span class="username" style="margin-right:1000px;" >
                        
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
            <?php
        $con = mysqli_connect("localhost", "root", "", "AganwadiWorker");

        // Execute the query
        $sql = "SELECT COUNT(*) AS total_count FROM AGW";
        $result = $con->query($sql);

        if ($result === false) {
            echo "Error: " . $con->error;
            // Handle the error appropriately
        } else {
            $row = $result->fetch_assoc();
            $totalCount = $row["total_count"];
        }
        ?>
            <p><?php echo $totalCount; ?><br/><span>Workers</span></p>
                <i class="fa fa-users box-icon"></i>
            </div>
        </div>
        <div class="col-div-3">
    <div class="box">
        <?php
        $con = mysqli_connect("localhost", "root", "", "AganwadiWorker");

        // Execute the query
        $sql = "SELECT COUNT(*) AS total_count FROM pregnant_women";
        $result = $con->query($sql);

        if ($result === false) {
            echo "Error: " . $con->error;
            // Handle the error appropriately
        } else {
            $row = $result->fetch_assoc();
            $totalCount = $row["total_count"];
        }
        ?>
        <p><?php echo $totalCount; ?><br/><span>Pregnant women</span></p>
        <i class="fas fa-plus box-icon box-icon"></i>
    </div>
</div>

        <div class="col-div-3">
            <div class="box">
                <p>99<br/><span>LactatingWomen</span></p>
                <i class="fas fa-female box-icon"></i>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box">
                <p>78<br/><span>Childrens</span></p>
                <i class="fas fa-child box-icon"></i>
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
                        echo "<tr><th>id</th><th>username</th><th>email</th><th>age</th><th>Action</th></tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['age'] . "</td>";
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
