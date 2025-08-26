<?php
require_once('connect.php');

if (isset($_GET['id'])) {
    $formation_id = $_GET['id'];
    $ReadSql = "SELECT * FROM `inscriptions` WHERE `formation_id` = $formation_id";
    $res = mysqli_query($con, $ReadSql);
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des inscrits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'navbar.php'; ?>

    <div class="container">
        <div class="row pt-4">
            <h2>Liste des inscrits à la formation</h2>
        </div>

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($r = mysqli_fetch_assoc($res)) { ?>
                <tr>
                    <th scope="row"><?php echo $r['id']; ?></th>
                    <td><?php echo $r['nom']; ?></td>
                    <td><?php echo $r['email']; ?></td>
                    <td><?php echo $r['statut']; ?></td>
                    <td>
                        <div class="button-container" style="display: flex; align-items: center; gap: 10px;">
                            <a href="changer_statut.php?id=<?php echo $r['id']; ?>&statut=accepté" class="btn btn-success" style="flex: 1; text-align: center;">
                                <i class="fa fa-check"></i>
                            </a>
                            <a href="changer_statut.php?id=<?php echo $r['id']; ?>&statut=refusé" class="btn btn-danger" style="flex: 1; text-align: center;">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
