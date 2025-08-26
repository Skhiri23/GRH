<?php
require_once('connect.php');

if (isset($_GET['id']) && isset($_GET['statut'])) {
    $id = intval($_GET['id']);
    $statut = $_GET['statut'];


    $updateSql = "UPDATE inscriptions SET statut = ? WHERE id = ?";
    $stmt = $con->prepare($updateSql);
    $stmt->bind_param('si', $statut, $id);
    $res = $stmt->execute();

    if ($res) {

        $inscriptionQuery = "SELECT inscriptions.*, formation.Titre_Formation, employe.id AS destinataire_id
                             FROM inscriptions 
                             INNER JOIN formation ON inscriptions.formation_id = formation.id 
                             INNER JOIN employe ON employe.email = inscriptions.email 
                             WHERE inscriptions.id = ?";
        $stmt = $con->prepare($inscriptionQuery);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $inscription = $result->fetch_assoc();

        if ($inscription) {

            $message = "Votre demande de formation '" . $inscription['Titre_Formation'] . "' a été mise à jour : " . $statut;


            $notificationSql = "INSERT INTO notification (employe, message, date_sent, sender_name, sender_id, marquer_comme_lu) VALUES (?, ?, NOW(), ?, ?, 0)";
            $stmt = $con->prepare($notificationSql);
            
            if (!$stmt) {
                die("Prepare failed: " . $con->error);
            }

            $sender_name = "System"; 
            $sender_id = 1; 
            $stmt->bind_param('issi', $inscription['destinataire_id'], $message, $sender_name, $sender_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
            
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                echo "Erreur lors de l'envoi de la notification.";
            }
        } else {
            echo "Erreur : Inscription introuvable.";
        }
    } else {
        echo "Erreur : " . $stmt->error;
    }
    $stmt->close();
}
?>
