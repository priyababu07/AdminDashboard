<?php
require_once 'db.php';

function display_data($search = '') {
    global $con;
    
    $query = "SELECT * FROM pregnant_women";
    
    if (!empty($search)) {
        $search = mysqli_real_escape_string($con, $search);
        $query .= " WHERE place LIKE '%$search%'";
    }
    
    $result = mysqli_query($con, $query);
    return $result;
}
?>
