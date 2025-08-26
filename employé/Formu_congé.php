<?php
require_once('connect.php');
session_start();

 if (!isset($_SESSION['user_id'])) {
    echo "Erreur: Utilisateur non connecté.";
    exit();
}

$user_id = $_SESSION['user_id'];

 $sql_user_details = "SELECT poste FROM employe WHERE id = $user_id";
$result_user_details = mysqli_query($con, $sql_user_details);

if (!$result_user_details || mysqli_num_rows($result_user_details) == 0) {
    echo "Erreur: Impossible de récupérer les détails de l'utilisateur.";
    exit();
}

$user_details = mysqli_fetch_assoc($result_user_details);
$poste = $user_details['poste'];

 if (
    isset($_POST['cin'], $_POST['nom'], $_POST['departement'], $_POST['dateDebut'], $_POST['dateFin']) &&
    !empty($_POST['cin']) && !empty($_POST['nom']) && !empty($_POST['departement']) &&
    !empty($_POST['dateDebut']) && !empty($_POST['dateFin'])
) {
     $cin = mysqli_real_escape_string($con, $_POST['cin']);
    $nom = mysqli_real_escape_string($con, $_POST['nom']);
    $departement = mysqli_real_escape_string($con, $_POST['departement']);
    $dateDebut = $_POST['dateDebut'];
    $dateFin = $_POST['dateFin'];

     if ($dateFin <= $dateDebut) {
        echo "La date de fin doit être après la date de début.";
        exit(); 
    }

     $daysRequested = date_diff(date_create($dateDebut), date_create($dateFin))->format('%a') + 1;  

     $sql_select = "SELECT SUM(jours_pris) AS total_jours_pris FROM conges WHERE cin = '$cin'";
    $result_select = mysqli_query($con, $sql_select);

    if (!$result_select) {
        echo "Erreur: Échec de la requête de base de données.";
        exit();
    }

    $row = mysqli_fetch_assoc($result_select);
    $currentDaysTaken = $row ? $row['total_jours_pris'] : 0;

     $totalDaysEntitled = 30;

     $remainingDays = $totalDaysEntitled - $currentDaysTaken;

     if ($daysRequested > $remainingDays) {
        echo "Vous n'avez pas suffisamment de jours restants pour cette demande de congé.";
        exit();
    }

     $sql = "INSERT INTO conges (cin, nom, departement, poste, dateDebut, dateFin, jours_pris)
            VALUES ('$cin', '$nom', '$departement', '$poste', '$dateDebut', '$dateFin', '$daysRequested')";

    if (mysqli_query($con, $sql)) {
         $sql_agent_rh = "SELECT id FROM employe WHERE poste = 'agent RH' LIMIT 1";
        $result_agent_rh = mysqli_query($con, $sql_agent_rh);

        if ($result_agent_rh && mysqli_num_rows($result_agent_rh) > 0) {
            $agent_rh = mysqli_fetch_assoc($result_agent_rh);
            $agent_rh_id = $agent_rh['id'];

             $message = "Nouvelle demande de congé de " . $nom . ".";
            $sql_notification = "INSERT INTO notification (employe, message)
                                 VALUES ('$agent_rh_id', '$message')";

            if (mysqli_query($con, $sql_notification)) {
                echo "Demande de congé envoyée avec succès et notification envoyée à l'agent RH!";
            } else {
                echo "Demande de congé envoyée avec succès, mais échec de l'envoi de la notification: " . mysqli_error($con);
            }
        } else {
            echo "Demande de congé envoyée avec succès, mais aucun agent RH trouvé.";
        }
    } else {
        echo "Erreur: " . mysqli_error($con);
    }
} else {
    echo "Erreur: Veuillez remplir tous les champs.";
}

mysqli_close($con);
?>
