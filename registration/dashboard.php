<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Paalan</title>

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

    <div class="grid-container">
        <!-- header -->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-left">
                <span class="material-icons-outlined">search</span>
            </div>

            <div class="header-right">
                <span class="material-icons-outlined">notifications</span>
                <span class="material-icons-outlined">mail</span>

    
                <div class="dropdown">
                     <span class="material-icons-outlined account-icon">account_circle</span>
                      <div class="dropdown-content">
                        
                        <a href="#">Log out</a>
                        <a href="changepassword.php">Change Password</a>
                        
                      </div>
                </div>
                <!-- <div class="dropdown">
                    /<span class="material-icons-outlined account-icon">account_circle</span>
                    <div class="dropdown-content">
                        <li></li>
                        <a href="#">Profile</a>
                        <a href="#">Settings</a>
                        <a href="#">Logout</a>
                    </div>
                </div> -->
                <span class="username">
                    <?php 
                    include("php/config.php");
                    echo $_SESSION['username']; 
                    ?>
                </span>
            </div>
        </header>
        <!-- header ends -->
        <!-- sidebar -->
        <aside id="sidebar">

            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <span class="material-icons-outlined">family_restroom</span>Anganwadi
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>
            <ul class="sidebar-list">
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">dashboard</span>
                    <a href="#" class="item">Dashboard</a>
                </li>

                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">child_care</span>
                    <a href="#" class="item">Children</a>
                </li>

                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">event_note</span>
                    <a href="#" class="item">Events</a>
                </li>

                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">notifications</span>
                    <a href="#" class="item">Notifications</a>
                </li>

                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">settings</span>
                    <a href="#" class="item">Settings</a>
                </li>
            </ul>
        </aside>
        <!-- sidebar ends -->

        <!-- main starts -->
        <main class="main-container">

            <div class="main-title">
                
            </div>
            <h2 style="color: black"> Welcome... <span><?php echo $_SESSION['username']; ?></span></h2>
            <div class="main-cards">
                <!-- first cards -->
                <div class="card" onclick="cardClicked(1)">
                    <div class="card-inner">
                        <h3>NOKKANNAM</h3>
                        <span class="material-icons-outlined">question_mark</span>
                    </div>
                    <h1>249</h1>
                </div>

                <div class="card" onclick="cardClicked(2)">
                    <div class="card-inner">
                        <h3>NOKKANNAM</h3>
                        <span class="material-icons-outlined">question_mark</span>
                    </div>
                    <h1>249</h1>
                </div>

                <div class="card">
                    <div class="card-inner" onclick="cardClicked(3)">
                        <h3>NOKKANNAM</h3>
                        <span class="material-icons-outlined">question_mark</span>
                    </div>
                    <h1>249</h1>
                </div>

                <div class="charts">
                    <div class="charts-card">
                        <h2 class="chart-title">chart</h2>
                        <div id="bar-chart"></div>
                    </div>
                </div>
            </div>
        
        <!-- main ends -->
    </div>
    <!-- chart -->


    <!-- Admin Approval Table -->
    <div class="admin-approval">
        <h2>Admin Approval</h2>

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
    </main>
    <!-- Admin Approval Table ends -->

    <script src="dashboard.js"></script>
</body>
</html>


