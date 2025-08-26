<?php
include 'connect.php';

$departement = isset($_GET['departement']) ? mysqli_real_escape_string($con, $_GET['departement']) : '';

if (empty($departement)) {
    echo json_encode([]);
    exit();
}

$sql = "SELECT DISTINCT poste FROM employe WHERE departement = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $departement);
$stmt->execute();
$result = $stmt->get_result();

$postes = [];
while ($row = $result->fetch_assoc()) {
    $postes[] = $row['poste'];
}

$stmt->close();
$con->close();

echo json_encode($postes);
?>
