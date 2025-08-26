<?php
require_once('connect.php');
session_start();


$userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;

if (!$userId) {
    echo "User is not logged in.";
    exit;
}

$ReadSql = "
    SELECT 
        posts.id AS post_id, 
        posts.titre_poste, 
        posts.description, 
        posts.date_limite, 
        posts.statut_poste, 
        user_post_candidature.status 
    FROM 
        posts 
    INNER JOIN 
        user_post_candidature 
    ON 
        posts.id = user_post_candidature.post_id 
    WHERE 
        user_post_candidature.user_id = ?";

$stmt = $con->prepare($ReadSql);
$stmt->bind_param('i', $userId);
$stmt->execute();
$res = $stmt->get_result();

include "navbarcandidat.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mes Candidatures</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row pt-4">
            <h2>Mes Candidatures</h2>
        </div>

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID du Poste</th>
                    <th>Titre du Poste</th>
                    <th>Description</th>
                    <th>Date Limite</th>
                    <th>Statut du Poste</th>
                    <th>Statut de la Candidature</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($r = $res->fetch_assoc()) { ?>
                <tr>
                    <th scope="row"><?php echo $r['post_id']; ?></th>
                    <td><?php echo $r['titre_poste']; ?></td>
                    <td><?php echo $r['description']; ?></td>
                    <td><?php echo $r['date_limite']; ?></td>
                    <td><?php echo $r['statut_poste']; ?></td>
                    <td><?php echo $r['status']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
