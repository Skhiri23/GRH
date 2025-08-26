<?php
session_start();
require_once('connect.php');

 if (!isset($_SESSION['user_id'])) {
     header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

 $readSql = "SELECT * FROM employe WHERE id = ?";
if ($stmt = $con->prepare($readSql)) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
} else {
    die("Error preparing statement: " . $con->error);
}

include 'navbarEmployé.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aziz GRH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row pt-4">
        <h2>Profil de l'Employé</h2>
    </div>

    <?php if ($user): ?>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>CIN</th>
                <th>Nom complet</th>
                <th>Département</th>
                <th>Poste</th>
                <th>Numéro Carte</th>
                <th>Salaire brut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['cin']); ?></td>
                <td><?php echo htmlspecialchars($user['nom']) . " " . htmlspecialchars($user['prenom']); ?></td>
                <td><?php echo htmlspecialchars($user['departement']); ?></td>
                <td><?php echo htmlspecialchars($user['poste']); ?></td>
                <td><?php echo htmlspecialchars($user['numcarte']); ?></td>
                <td><?php echo htmlspecialchars($user['salaire']); ?></td>
                <td>
                     <a href="liste_paiements_month.php?cin=<?php echo htmlspecialchars($user['cin']); ?>" class="btn btn-info m-2" title="Liste des paiements">
                        <i class="fa fa-list"></i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
    <?php else: ?>
    <p>Aucun profil trouvé pour l'utilisateur connecté.</p>
    <?php endif; ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
