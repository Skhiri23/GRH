<?php
require_once('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $column = mysqli_real_escape_string($con, $_POST['column']);
    $value = mysqli_real_escape_string($con, $_POST['value']);

    $query = "UPDATE paiement_employee SET $column = '$value' WHERE id = '$id'";
    if (mysqli_query($con, $query)) {
        echo 'success';
    } else {
        echo 'error: ' . mysqli_error($con);
    }
}
?>
