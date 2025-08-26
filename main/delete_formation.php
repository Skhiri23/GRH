<?php

require_once ('connect.php');

	$id = $_GET['id'];
	$DelSql = "DELETE FROM `Formation` WHERE id=$id";

	$res = mysqli_query($con, $DelSql);
	if ($res) {
		header("Location: Liste_des_Formation.php");
	}else{
		echo "Failed to delete";
	}

 ?>