<?php
session_start();  

if (!isset($_SESSION['user_id'])) {
    die(json_encode(['error' => 'User not logged in.']));  
}

include 'connect.php';  

$user_id = $_SESSION['user_id'];  

 error_log("User ID: " . $user_id);

 $sql = "SELECT id, message, date_sent AS dateheure_envoi, sender_name, marquer_comme_lu 
        FROM notification 
        WHERE employe = ? OR departement = ? OR poste = ? OR scope = 'all'
        ORDER BY dateheure_envoi DESC";
$stmt = $con->prepare($sql);

if (!$stmt) {
    die(json_encode(['error' => 'Prepare failed: ' . $con->error]));
}

 $stmt->bind_param('iii', $user_id, $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die(json_encode(['error' => 'Execute failed: ' . $stmt->error]));
}

$notifications = [];

 while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

$stmt->close();
$con->close();

 echo json_encode($notifications);
?>
