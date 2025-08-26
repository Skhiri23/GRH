<?php
session_start();
session_destroy();
header('Location: ../Login_v1/index.php');
exit();
?>