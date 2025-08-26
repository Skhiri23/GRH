<?php
$con = mysqli_connect('localhost', 'root', '');
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

$select_db = mysqli_select_db($con, 'aziz_db');
if (!$select_db) {
    die("Database selection failed: " . mysqli_error($con));
}

?>
