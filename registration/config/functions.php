<?php
require_once 'db.php';
function display_data(){
    global $con;
    $query = "SELECT * FROM AGW";
    $result = mysqli_query($con,$query);
    return $result;
}
?>