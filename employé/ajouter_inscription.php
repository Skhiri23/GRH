<?php
require_once('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $formation_id = $_POST['formation_id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];

     $sql_check = "SELECT COUNT(*) FROM inscriptions WHERE formation_id = ? AND email = ?";
    $stmt_check = $con->prepare($sql_check);
    $stmt_check->bind_param("is", $formation_id, $email);
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count > 0) {
        echo "Vous avez déjà souscrit à cette formation.";
        exit();
    }

     $sql = "INSERT INTO inscriptions (formation_id, nom, prenom, email) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("isss", $formation_id, $nom, $prenom, $email);

    if ($stmt->execute()) {
        echo "Inscription ajoutée avec succès.";

         $sql_formation = "SELECT Titre_Formation FROM formation WHERE id = ?";
        $stmt_formation = $con->prepare($sql_formation);
        $stmt_formation->bind_param("i", $formation_id);
        $stmt_formation->execute();
        $stmt_formation->bind_result($nom_formation);
        $stmt_formation->fetch();
        $stmt_formation->close();

         $sql_agent_rh = "SELECT id FROM employe WHERE poste = 'agent RH' LIMIT 1";
        $result_agent_rh = $con->query($sql_agent_rh);

        if ($result_agent_rh->num_rows > 0) {
            $agent_rh = $result_agent_rh->fetch_assoc();
            $agent_rh_id = $agent_rh['id'];

             $message = "Nouvelle inscription à la formation '$nom_formation' par $nom $prenom.";

             $sql_notification = "INSERT INTO notification (employe, message, date_sent, marquer_comme_lu) VALUES (?, ?, NOW(), 0)";
            $stmt_notification = $con->prepare($sql_notification);
            $stmt_notification->bind_param("is", $agent_rh_id, $message);

            if ($stmt_notification->execute()) {
                echo " Notification envoyée à l'agent RH.";
            } else {
                echo " Erreur lors de l'envoi de la notification: " . $stmt_notification->error;
            }

            $stmt_notification->close();
        } else {
            echo " Aucun agent RH trouvé.";
        }
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
?>
