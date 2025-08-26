<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

include 'connect.php';

$scope = $_POST['scope'];
$message = $_POST['message'];
$departement = isset($_POST['departement']) ? $_POST['departement'] : null;
$poste = isset($_POST['poste']) ? $_POST['poste'] : null;
$employe = isset($_POST['employe']) ? $_POST['employe'] : null;
$sender_id = $_SESSION['user_id'];

 $stmt = $con->prepare("SELECT nom, prenom FROM employe WHERE id = ?");
$stmt->bind_param("i", $sender_id);
$stmt->execute();
$stmt->bind_result($nom, $prenom);
$stmt->fetch();
$sender_name = $nom . ' ' . $prenom;
$stmt->close();

 $stmt = $con->prepare("INSERT INTO notification (scope, message, departement, poste, employe, sender_id, sender_name, date_sent) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("ssssiss", $scope, $message, $departement, $poste, $employe, $sender_id, $sender_name);

 if ($stmt->execute()) {
    $_SESSION['notification_message'] = "Notification sent successfully.";
    $_SESSION['notification_message_type'] = "success";
} else {
    $_SESSION['notification_message'] = "Error: " . $stmt->error;
    $_SESSION['notification_message_type'] = "danger";
}

 $stmt->close();
$con->close();

header("Location: send_notification.php");
exit();
?>
