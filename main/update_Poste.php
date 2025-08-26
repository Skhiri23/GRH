<?php
require_once('connect.php');

$id = $_GET['id'];
$selSql = "SELECT * FROM `posts` WHERE id=?";
$selStmt = $con->prepare($selSql);
$selStmt->bind_param("i", $id);
$selStmt->execute();
$res = $selStmt->get_result();
$r = $res->fetch_assoc();
$selStmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $titre_poste = mysqli_real_escape_string($con, $_POST['titre_poste']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $date_limite = mysqli_real_escape_string($con, $_POST['date_limite']);
    $statut_poste = mysqli_real_escape_string($con, $_POST['statut_poste']);

    $UpdateSql = "UPDATE `posts` SET titre_poste=?, description=?, date_limite=?, statut_poste=? WHERE id=?";
    $updateStmt = $con->prepare($UpdateSql);
    $updateStmt->bind_param("ssssi", $titre_poste, $description, $date_limite, $statut_poste, $id);

    if ($updateStmt->execute()) {
        header("Location: Liste_des_poste.php");
        exit();
    } else {
        $erreur = "La mise à jour a échoué: " . $updateStmt->error;
    }

    $updateStmt->close();
}

$con->close();
?>

<!DOCTYPE html>
<html>
<head>
<title>Aziz GRH</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <div class="row pt-4">
            <?php if (isset($erreur)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $erreur; ?>
            </div> 
            <?php } ?>

            <form action="" method="POST" class="form-horizontal col-md-6 pt-4">
                <h2>Crud App by sen dev tech</h2>
                <legend>Post Details</legend>
                <div class="form-group">
                    <label for="titre_poste" class="col-sm-2 control-label">Titre Poste</label>
                    <div class="col-sm-10">
                        <input type="text" name="titre_poste" placeholder="Titre Poste" class="form-control" id="titre_poste" value="<?php echo $r['titre_poste']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
    <label for="description" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10">
        <textarea name="description" placeholder="Description" class="form-control" id="description" rows="3"><?php echo $r['description']; ?></textarea>
    </div>
</div>
    <div class="form-group">
                    <label for="date_limite" class="col-sm-2 control-label">Date Limite</label>
                    <div class="col-sm-10">
                        <input type="date" name="date_limite" class="form-control" id="date_limite" value="<?php echo $r['date_limite']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="statut_poste" class="col-sm-2 control-label">Statut Poste</label>
                    <div class="col-sm-10">
                        <label>
                            <input type="radio" name="statut_poste" id="optionsRadios" value="Actif" <?php if($r['statut_poste'] == 'Actif'){ echo "checked";} ?>>
                            Actif
                        </label>
                        <label>
                            <input type="radio" name="statut_poste" id="optionsRadios" value="Inactif" <?php if($r['statut_poste'] == 'Inactif'){ echo "checked";} ?>>
                            Inactif
                        </label>
                    </div>
                </div>
                <input type="submit" value="Submit" class="btn btn-success">        
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
</script>
<style>
textarea {
    resize: none;   
    overflow: hidden;  
}

textarea:focus {
    outline: none;  
}
</style>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const textarea = document.getElementById('description');
    
     const adjustHeight = (element) => {
        element.style.height = 'auto';  
        element.style.height = (element.scrollHeight) + 'px'; 
    };

 
    textarea.addEventListener('input', () => {
        adjustHeight(textarea);
    });

   
    adjustHeight(textarea);
});
</script>