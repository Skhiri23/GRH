<?php
include 'connect.php';

$poste = isset($_GET['poste']) ? mysqli_real_escape_string($con, $_GET['poste']) : '';

if (empty($poste)) {
    echo json_encode([]);
    exit();
}

$sql = "SELECT id, nom, prenom FROM employe WHERE poste = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $poste);
$stmt->execute();
$result = $stmt->get_result();

$employes = [];
while ($row = $result->fetch_assoc()) {
    $employes[] = $row;
}

$stmt->close();
$con->close();

echo json_encode($employes);
?>
