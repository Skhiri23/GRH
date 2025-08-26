<?php
include 'connect.php';

$departement = $_GET['departement'];

$stmt = $con->prepare("SELECT DISTINCT poste FROM employe WHERE departement = ?");
$stmt->bind_param("s", $departement);
$stmt->execute();
$result = $stmt->get_result();

$postes = [];
while ($row = $result->fetch_assoc()) {
    $postes[] = $row['poste'];
}

echo json_encode($postes);

$stmt->close();
$con->close();
?>
