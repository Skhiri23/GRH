<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

include 'connect.php';

$notification_id = $_POST['notification_id'];
$user_id = $_SESSION['user_id'];

$sql = "DELETE FROM notification WHERE id = ? AND employe = ?";
$stmt = $con->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $con->error);
}
$stmt->bind_param('ii', $notification_id, $user_id);
$stmt->execute();
$stmt->close();
$con->close();
?>
