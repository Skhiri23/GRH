<?php
session_start();
include 'navbarEmployé.php';
require_once('connect.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Login_v1/index.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM employe WHERE id = '$user_id'";
$result = mysqli_query($con, $sql);

if (!$result) {
    die('Erreur: ' . mysqli_error($con));
}

$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "Erreur: Employé non trouvé.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de Congé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        select,
        button {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        #postesContainer {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Demande de Congé</h1>
    <form id="demandeForm" method="post" action="Formu_congé.php">
        <label for="cin">CIN:</label>
        <input type="text" id="cin" name="cin" value="<?php echo $user['cin']; ?>" readonly>
        <label for="nom">Nom Complet:</label>
        <input type="text" id="nom" name="nom" value="<?php echo $user['nom'] . ' ' . $user['prenom']; ?>
" readonly>
        <label for="departement">Département:</label>
        <select id="inputDepartement" name="departement" required>
            <option value="developpement" <?php echo $user['departement'] == 'developpement' ? 'selected' : ''; ?>>Développement logiciel</option>
            <option value="gestion_projet" <?php echo $user['departement'] == 'gestion_projet' ? 'selected' : ''; ?>>Gestion de projet</option>
            <option value="qualite" <?php echo $user['departement'] == 'qualite' ? 'selected' : ''; ?>>Qualité logicielle</option>
            <option value="infra_reseaux" <?php echo $user['departement'] == 'infra_reseaux' ? 'selected' : ''; ?>>Infrastructure et Réseaux</option>
            <option value="conception_ux_ui" <?php echo $user['departement'] == 'conception_ux_ui' ? 'selected' : ''; ?>>Conception UX/UI</option>
            <option value="support_technique" <?php echo $user['departement'] == 'support_technique' ? 'selected' : ''; ?>>Support Technique</option>
            <option value="recherche_developpement" <?php echo $user['departement'] == 'recherche_developpement' ? 'selected' : ''; ?>>Recherche et Développement</option>
        </select>
        <div id="postesContainer">
            <label for="poste">Poste:</label>
            <select id="inputPoste" name="poste" required>
             </select>
        </div>
        <label for="dateDebut">Date de début:</label>
        <input type="date" id="dateDebut" name="dateDebut" required>
        <label for="dateFin">Date de fin:</label>
        <input type="date" id="dateFin" name="dateFin" required>
        <button type="submit">Demander Congé</button>
    </form>
    <div id="result"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function populatePostes(department) {
                var postes = [];
                $('#inputPoste').empty();
                switch (department) {
                    case 'developpement':
                        postes = ['Développeur', 'Ingénieur QA', 'Architecte logiciel', 'Développeur front-end', 'Développeur back-end'];
                        break;
                    case 'gestion_projet':
                        postes = ['Chef de projet', 'Assistant chef de projet', 'Analyste fonctionnel', 'Chef de projet technique', 'Scrum Master'];
                        break;
                    case 'qualite':
                        postes = ['Analyste qualité', 'Testeur logiciel', 'Responsable qualité', 'Auditeur qualité', 'Analyste de sécurité informatique'];
                        break;
                    case 'infra_reseaux':
                        postes = ['Administrateur système', 'Ingénieur réseau', 'Technicien support', 'Spécialiste en cybersécurité', 'Architecte infrastructure'];
                        break;
                    case 'conception_ux_ui':
                        postes = ['Designer UX/UI', 'Concepteur graphique', 'Intégrateur web', 'UX Researcher', 'Spécialiste en accessibilité web'];
                        break;
                    case 'support_technique':
                        postes = ['Technicien informatique', 'Hotliner', 'Spécialiste en maintenance', 'Technicien réseau', 'Technicien helpdesk'];
                        break;
                    case 'recherche_developpement':
                        postes = ['Chercheur', 'Scientifique des données', 'Ingénieur R&D', 'Analyste en intelligence artificielle', 'Spécialiste en apprentissage automatique'];
                        break;
                }

                $.each(postes, function(index, value) {
                    $('#inputPoste').append($('<option>').text(value).attr('value', value));
                });
            }

            var initialDepartment = $('#inputDepartement').val();
            if (initialDepartment) {
                populatePostes(initialDepartment);
                $('#postesContainer').show();
            }

            $('#inputDepartement').change(function() {
                populatePostes($(this).val());
                $('#postesContainer').show();
            });

            $('#demandeForm').submit(function(event) {
                event.preventDefault();  
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: 'Formu_congé.php',
                    data: formData,
                    success: function(response) {
                        $('#result').html(response);   
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);  
                    }
                });
            });
        });
    </script>
</body>
</html>
