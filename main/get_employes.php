<?php
include 'connect.php';

$poste = $_GET['poste'];

$stmt = $con->prepare("SELECT id, nom, prenom FROM employe WHERE poste = ?");
$stmt->bind_param("s", $poste);
$stmt->execute();
$result = $stmt->get_result();

$employes = [];
while ($row = $result->fetch_assoc()) {
    $employes[] = $row;
}

echo json_encode($employes);

$stmt->close();
$con->close();
?>
