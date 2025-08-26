<?php
session_start();
require_once('connect.php');

 $user_id = $_SESSION['user_id'];

 $ReadSql = "SELECT * FROM `employe` WHERE `id` = $user_id";
$res = mysqli_query($con, $ReadSql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Aziz GRH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

    <?php include 'navbarEmployé.php'; ?>

    <div class="container">
        <div class="row pt-4">
            <h2>Liste des Contrat</h2>
        </div>

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>id</th>
                    <th>cin</th>
                    <th>Nom complet</th>
                    <th>Departement</th>
                    <th>Poste</th>
                    <th>dateDebut</th>
                    <th>dateFin</th>
                    <th>typeContrat</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($r = mysqli_fetch_assoc($res)) { ?>
                <tr>
                    <th scope="row"><?php echo $r['id']; ?></th>
                    <td><?php echo $r['cin']; ?></td>
                    <td><?php echo $r['nom'] . " " . $r['prenom']; ?></td>
                    <td><?php echo $r['departement']; ?></td>
                    <td><?php echo $r['poste']; ?></td>
                    <td><?php echo $r['dateDebut']; ?></td>
                    <td><?php echo $r['dateFin']; ?></td>
                    <td><?php echo $r['type_contrat']; ?></td>
                    <td>
                        <i class="fa fa-print fa-2x blue-icon" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $r['id']; ?>"></i>
                        <div class="modal fade" id="exampleModal<?php echo $r['id']; ?>" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Are you sure you want to print the contract for this employee?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                                        <a href="print_contract.php?id=<?php echo $r['id']; ?>">
                                            <button class="btn btn-success" type="button">Confirm</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script type='text/javascript' id="soledad-pagespeed-header" data-cfasync="false">
     </script>
</body>
</html>
