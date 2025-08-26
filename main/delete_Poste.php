<?php

require_once ('connect.php');

$id = $_GET['id'];


$delRelatedSql = "DELETE FROM `candidature` WHERE post_id=$id";
$resRelated = mysqli_query($con, $delRelatedSql);

if ($resRelated) {

    $delPostSql = "DELETE FROM `posts` WHERE id=$id";
    $resPost = mysqli_query($con, $delPostSql);

    if ($resPost) {
        header("Location: Liste_des_poste.php");
    } else {
        echo "Failed to delete post";
    }
} else {
    echo "Failed to delete related rows";
}

?>
