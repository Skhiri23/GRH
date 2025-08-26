<?php
session_start();
require_once('connect.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch profile of the logged-in user
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

// Fetch formations
$formationSql = "SELECT * FROM formation";
$res = mysqli_query($con, $formationSql);

include 'navbarEmployé.php';
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

<div class="container">
    <div class="row pt-4">
        <h2>Liste des Formation</h2>
    </div>

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre Formation</th>
                <th>Formateur</th>
                <th>Date Début</th>
                <th>Durée</th>
                <th>Lieu</th>
                <th>Statut Inscription</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($r = mysqli_fetch_assoc($res)) { ?>
            <tr>
                <th scope="row"><?php echo $r['id']; ?></th>
                <td><?php echo $r['Titre_Formation']; ?></td>
                <td><?php echo $r['Formateur']; ?></td>
                <td><?php echo $r['Date_Debut']; ?></td>
                <td><?php echo $r['Durée']; ?></td>
                <td><?php echo $r['Lieu']; ?></td>
                <td><?php echo $r['Statut_inscription']; ?></td>
                <td>
                     <button class="btn btn-success inscrire-button" data-formation-id="<?php echo $r['id']; ?>" title="Inscrire">
                        <i class="fa fa-check-circle fa-2x"></i>
                    </button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function(){
    $('.inscrire-button').on('click', function(){
        var formation_id = $(this).data('formation-id');
        var nom = "<?php echo $user['nom']; ?>";
        var prenom = "<?php echo $user['prenom']; ?>";
        var email = "<?php echo $user['email']; ?>";

        $.ajax({
            url: 'ajouter_inscription.php',
            type: 'POST',
            data: {
                formation_id: formation_id,
                nom: nom,
                prenom: prenom,
                email: email
            },
            success: function(response) {
                alert(response);
                location.reload();   
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
