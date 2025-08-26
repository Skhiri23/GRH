<?php
session_start();
session_destroy();
header('Location: login-form-v1\Login_v1\login_candidat.php');
exit();
?>