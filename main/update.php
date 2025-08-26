<?php
require_once('connect.php');

$id = $_GET['id'];
if (!is_numeric($id)) {
    die('Invalid ID');
}

$selSql = "SELECT * FROM `employe` WHERE id=?";
$stmt = $con->prepare($selSql);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$r = $res->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
    $cin = htmlspecialchars(trim($_POST['cin']));
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $age = htmlspecialchars(trim($_POST['age']));
    $telephone = htmlspecialchars(trim($_POST['telephone']));
    $civility = htmlspecialchars(trim($_POST['civility']));
    $children = isset($_POST['nbe']) ? intval($_POST['nbe']) : null;
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password'])); 

    $image = $r['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = 'uploads/';
        $upload_file = $upload_dir . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
            $image = $upload_file;
        }
    }



    $updateSql = "UPDATE `employe` SET cin=?, nom=?, prenom=?, email=?, gender=?, age=?, telephone=?, civility=?, children=?, image=?, username=?, paswrd=? WHERE id=?";
    $stmt = $con->prepare($updateSql);
    $stmt->bind_param("sssssisissssi", $cin, $nom, $prenom, $email, $gender, $age, $telephone, $civility, $children, $image, $username, $password, $id);
    
    if ($stmt->execute()) {
        header("Location: view.php");
        exit();
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

            <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal col-md-6 pt-4">
                <fieldset id="personalInfo">
                    <legend>Personal Information</legend>
                     <div class="form-group">
                        <label for="input1" class="col-sm-2 control-label">Cin</label>
                        <div class="col-sm-10">
                            <input type="text" name="cin" placeholder="cin" class="form-control" id="input1" value="<?php echo htmlspecialchars($r['cin']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input1" class="col-sm-2 control-label">Nom</label>
                        <div class="col-sm-10">
                            <input type="text" name="nom" placeholder="Nom" class="form-control" id="input1" value="<?php echo htmlspecialchars($r['nom']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input1" class="col-sm-2 control-label">Prenom</label>
                        <div class="col-sm-10">
                            <input type="text" name="prenom" placeholder="Prenom" class="form-control" id="input1" value="<?php echo htmlspecialchars($r['prenom']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input1" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" placeholder="e-mail" class="form-control" id="input1" value="<?php echo htmlspecialchars($r['email']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input1" class="col-sm-2 control-label">Genre</label>
                        <div class="col-sm-10">
                            <label>
                                <input type="radio" name="gender" id="optionsRadios" value="h" <?php if ($r['gender'] == 'h') echo "checked"; ?>> H
                            </label>
                            <label>
                                <input type="radio" name="gender" id="optionsRadios" value="f" <?php if ($r['gender'] == 'f') echo "checked"; ?>> F
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input1" class="col-sm-2 control-label">Age</label>
                        <div class="col-sm-10">
                            <input type="number" name="age" placeholder="age" class="form-control" id="input1" value="<?php echo htmlspecialchars($r['age']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTelephone" class="col-sm-2 control-label">Telephone</label>
                        <div class="col-sm-10">
                            <input type="tel" name="telephone" placeholder="Telephone" class="form-control" id="input1" value="<?php echo htmlspecialchars($r['telephone']); ?>">
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="civility" id="inlineRadio1" value="married" onclick="showChildrenInput()" <?php if ($r['civility'] == 'married') echo 'checked'; ?>>
                            <label class="form-check-label" for="inlineRadio1">Married</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="civility" id="inlineRadio2" value="single" onclick="hideChildrenInput()" <?php if ($r['civility'] == 'single') echo 'checked'; ?>>
                            <label class="form-check-label" for="inlineRadio2">Single</label>
                        </div>
                    </div>
                    <div class="form-group" id="childrenInput">
                        <label for="inputChildren" class="col-sm-2 control-label">Nb D'enfant</label>
                        <div class="col-sm-10">
                            <input type="number" name="nbe" placeholder="Nombre D'enfant" class="form-control" id="inputChildren" value="<?php echo htmlspecialchars($r['children']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputImage" class="col-sm-2 control-label">Upload Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="image" class="form-control-file" id="inputImage">
                            <?php if (!empty($r['image'])): ?>
                                <p>Current Image: <img src="<?php echo $r['image']; ?>" alt="Employee Image" width="100"></p>
                            <?php endif; ?>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="inputUsername" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" placeholder="Username" class="form-control" id="inputUsername" value="<?php echo htmlspecialchars($r['username']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" placeholder="Password" class="form-control" id="inputPassword" value="<?php echo htmlspecialchars($r['paswrd']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script>
        function showChildrenInput() {
            document.getElementById("childrenInput").style.display = "block";
        }

        function hideChildrenInput() {
            document.getElementById("childrenInput").style.display = "none";
        }

        document.addEventListener("DOMContentLoaded", function() {
            if (document.querySelector('input[name="civility"][value="married"]').checked) {
                showChildrenInput();
            } else {
                hideChildrenInput();
            }
        });
    </script>
    <script>
     const marriedRadio = document.getElementById('inlineRadio1');
    const childrenInput = document.getElementById('childrenInput');

     marriedRadio.addEventListener('change', function() {
         if (marriedRadio.checked) {
            childrenInput.style.display = 'block';
        } else {
             childrenInput.style.display = 'none';
        }
    });
	function showContractDetails() {
        document.getElementById('personalInfo').style.display = 'none';
        document.getElementById('contractDetails').style.display = 'block';
        document.getElementById('profileDetails').style.display = 'none';
        document.getElementById('buttonsFieldset').style.display = 'none';
    }

    function showPersonalInfo() {
        document.getElementById('personalInfo').style.display = 'block';
        document.getElementById('contractDetails').style.display = 'none';
        document.getElementById('profileDetails').style.display = 'none';
        document.getElementById('buttonsFieldset').style.display = 'none';
    }

    function showProfile() {
        document.getElementById('personalInfo').style.display = 'none';
        document.getElementById('contractDetails').style.display = 'none';
        document.getElementById('profileDetails').style.display = 'block';
        document.getElementById('buttonsFieldset').style.display = 'block';
    }
	   
       
</script>
<script>
$(document).ready(function() {
     function populatePosteDropdown(selectedDepartment) {
        var postes = [];
         $('#inputPoste').empty();
         switch (selectedDepartment) {
            case 'developpement':
                postes = ['Développeur', 'Ingénieur QA', 'Architecte logiciel', 'Développeur front-end', 'Développeur back-end'];
                break;
            case 'gestion_projet':
                postes = ['Chef de projet', 'Assistant chef de projet', 'Analyste fonctionnel', 'Chef de projet technique', 'Scrum Master'];
                break;
             default:
                break;
        }
         $.each(postes, function(index, value) {
            $('#inputPoste').append($('<option>').text(value).attr('value', value));
        });
         $('#postesContainer').show();
    }

     var defaultDepartment = $('#inputDepartement').val();
    populatePosteDropdown(defaultDepartment);

     $('#inputDepartement').change(function() {
        var selectedDepartment = $(this).val();
        populatePosteDropdown(selectedDepartment);
    });
});
</script>
</body>
</html>
