<?php
		include 'navbar.php';
	 ?>
<!DOCTYPE html>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css" >
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de Congé</title>
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
<form method="post" action="Formu_congé.php">
<label for="nom">Cin:</label>
    <input type="text" id="cin" name="cin" required>
    <label for="nom">Nom Complet:</label>
    <input type="text" id="nom" name="nom" required>
    <label for="departement">Département:</label>
    <select id="inputDepartement" name="departement" required>
        <option value="developpement">Département</option>
        <option value="developpement">Développement logiciel</option>
        <option value="gestion_projet">Gestion de projet</option>
        <option value="qualite">Qualité logicielle</option>
        <option value="infra_reseaux">Infrastructure et Réseaux</option>
        <option value="conception_ux_ui">Conception UX/UI</option>
        <option value="support_technique">Support Technique</option>
        <option value="recherche_developpement">Recherche et Développement</option>
    </select>
    <div id="postesContainer">
        <label for="poste">Poste:</label>
        <select id="inputPoste" name="poste" required ></select>
    </div>
    <label for="dateDebut">Date de début:</label>
    <input type="date" id="dateDebut" name="dateDebut" required>
    <label for="dateFin">Date de fin:</label>
    <input type="date" id="dateFin" name="dateFin" required>
    <button type="submit">Demander Congé</button>
</form>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#inputDepartement').change(function() {
                var selectedDepartment = $(this).val();
                var postes = [];

                $('#inputPoste').empty();

     
                switch (selectedDepartment) {
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
                    default:
                        break;
                }

      
                $.each(postes, function(index, value) {
                    $('#inputPoste').append($('<option>').text(value).attr('value', value));
                });

           
                $('#postesContainer').show();
            });
        });
    </script>
</body>
</html>
<script>
$(document).ready(function() {
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

<?php
require_once('connect.php');


if (
    isset($_POST['cin'], $_POST['nom'], $_POST['departement'], $_POST['poste'], $_POST['dateDebut'], $_POST['dateFin']) &&
    !empty($_POST['nom']) && !empty($_POST['departement']) && !empty($_POST['poste']) &&
    !empty($_POST['dateDebut']) && !empty($_POST['dateFin'])
) {
   
    $cin = mysqli_real_escape_string($con, $_POST['cin']);
    $nom = mysqli_real_escape_string($con, $_POST['nom']);
    $departement = mysqli_real_escape_string($con, $_POST['departement']);
    $poste = mysqli_real_escape_string($con, $_POST['poste']);
    $dateDebut = $_POST['dateDebut'];
    $dateFin = $_POST['dateFin'];

   
    if ($dateFin <= $dateDebut) {
        echo "La date de fin doit être après la date de début.";
        exit; 
    }

    
    $daysRequested = date_diff(date_create($dateDebut), date_create($dateFin))->format('%a');

    
    $sql_select = "SELECT jours_pris FROM conges WHERE cin = '$cin'";
    $result_select = mysqli_query($con, $sql_select);

    if (!$result_select) {
        echo "Error: Database query failed.";
        exit;
    }

    $row = mysqli_fetch_assoc($result_select);
    $currentDaysTaken = $row ? $row['jours_pris'] : 0;

    $allowedDays = 45; 
    $totalDaysTaken = $currentDaysTaken + $daysRequested;
    $dayreste= $allowedDays -$totalDaysTaken;
    if ($totalDaysTaken > $allowedDays) {
        echo "L'employé a dépassé le nombre maximum de jours de congé autorisés.";
        exit; 
    }

   
    $sql_conflicts = "SELECT * FROM conges WHERE departement = '$departement' AND poste = '$poste' AND (
        (dateDebut BETWEEN '$dateDebut' AND '$dateFin') OR 
        (dateFin BETWEEN '$dateDebut' AND '$dateFin') OR
        ('$dateDebut' BETWEEN dateDebut AND dateFin) OR
        ('$dateFin' BETWEEN dateDebut AND dateFin))";

    $result_conflicts = mysqli_query($con, $sql_conflicts);

    if (!$result_conflicts) {
        echo "Error: Database query failed.";
        exit;
    }

    if (mysqli_num_rows($result_conflicts) > 0) {
     
        $row_conflict = mysqli_fetch_assoc($result_conflicts);
        $conflictingStartDate = $row_conflict['dateDebut'];
        $conflictingEndDate = $row_conflict['dateFin'];

    
        $conflictingRange = date_diff(date_create($conflictingStartDate), date_create($conflictingEndDate))->format('%a');

     
        $suggestedStartDate = date('Y-m-d', strtotime("+$conflictingRange days", strtotime($conflictingEndDate)));

     
        $suggestedEndDate = date('Y-m-d', strtotime('+7 days', strtotime($suggestedStartDate)));

        echo "Congé non disponible en raison de dates conflictuelles dans le même département et poste.<br>";
        echo "Suggestion: Essayez de demander un congé à partir de $suggestedStartDate.";
        exit; 
    }


    $sql_insert = "INSERT INTO conges (nom, departement, poste, dateDebut, dateFin, cin)
                   VALUES ('$nom', '$departement', '$poste', '$dateDebut', '$dateFin', '$cin')";

    if (mysqli_query($con, $sql_insert)) {
     
        $sql_update = "UPDATE conges SET jours_pris = jours_pris + $daysRequested WHERE cin = '$cin'";
        mysqli_query($con, $sql_update);

        echo "Congé requested successfully.<br>";
        echo "jours resté :$dayreste";
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "";
}

mysqli_close($con);
?>
