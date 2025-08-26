<?php

require_once ('connect.php');

$id = $_GET['id'];
$selSql = "SELECT * FROM `Formation` WHERE id=$id";
$res = mysqli_query($con, $selSql);
$r = mysqli_fetch_assoc($res);

if (isset($_POST) && !empty($_POST)) {
    $Titre_Formation = $_POST['Titre_Formation'];
    $Formateur = $_POST['Formateur'];
    $Date_debut = $_POST['Date_debut'];
    $Durée = $_POST['Durée'];
    $Lieu = $_POST['Lieu'];
    $Statut = $_POST['Statut_inscription'];
    
    $UpdateSql = "UPDATE `Formation` SET 
                  Titre_Formation='$Titre_Formation', 
                  Formateur='$Formateur', 
                  Date_Debut='$Date_debut', 
                  Durée='$Durée', 
                  Lieu='$Lieu', 
                  Statut_inscription='$Statut' 
                  WHERE id=$id";
                  
    $res = mysqli_query($con, $UpdateSql);
    
    if ($res) {
        header("location: Liste_des_Formation.php");
    } else {
        $erreur = "La mise à jour a échoué.";
    }
}

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
                <legend>Contract Details</legend>
                <div class="form-group">
                    <label for="input1" class="col-sm-2 control-label">Titre </label>
                    <div class="col-sm-10">
                        <input type="text" name="Titre_Formation" placeholder="Titre_Formation" class="form-control" id="input1" value="<?php echo $r['Titre_Formation']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="input1" class="col-sm-2 control-label">Formateur</label>
                    <div class="col-sm-10">
                        <input type="text" name="Formateur" placeholder="Formateur" class="form-control" id="input1" value="<?php echo $r['Formateur']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Date_debut" class="col-sm-2 control-label">Date de début</label>
                    <div class="col-sm-10">
                        <input type="date" name="Date_debut" class="form-control" id="Date_debut" value="<?php echo $r['Date_Debut']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="input1" class="col-sm-2 control-label">Durée</label>
                    <div class="col-sm-10">
                        <input type="text" name="Durée" placeholder="Durée" class="form-control" id="input1" value="<?php echo $r['Durée']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="input1" class="col-sm-2 control-label">Lieu</label>
                    <div class="col-sm-10">
                        <input type="text" name="Lieu" placeholder="Lieu" class="form-control" id="input1" value="<?php echo $r['Lieu']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="input1" class="col-sm-2 control-label">Statut</label>
                    <div class="col-sm-10">
                        <label>
                            <input type="radio" name="Statut_inscription" id="optionsRadios" value="Inscrit" <?php if($r['Statut_inscription'] == 'Inscrit'){ echo "checked";} ?>>
                            Inscrit
                        </label>
                        <label>
                            <input type="radio" name="Statut_inscription" id="optionsRadios" value="En attente" <?php if($r['Statut_inscription'] == 'En attente'){ echo "checked";} ?>>
                            En attente
                        </label>
                        <label>
                            <input type="radio" name="Statut_inscription" id="optionsRadios" value="Annulé" <?php if($r['Statut_inscription'] == 'Annulé'){ echo "checked";} ?>>
                            Annulé
                        </label>
                        <label>
                            <input type="radio" name="Statut_inscription" id="optionsRadios" value="Terminé" <?php if($r['Statut_inscription'] == 'Terminé'){ echo "checked";} ?>>
                            Terminé
                        </label>
                    </div>
                </div>
                <input type="submit" value="Submit" class="btn btn-success">        
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script type='text/javascript'>
     </script>
</body>
</html>
