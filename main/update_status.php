<?php
 require_once('connect.php');

 $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$status = isset($_GET['status']) ? $_GET['status'] : '';

 if ($id > 0 && in_array($status, ['en attente', 'accepté', 'refusé'])) {
     $query = "UPDATE conges SET statut = ? WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('si', $status, $id);
    $stmt->execute();

     if ($stmt->affected_rows > 0) {
        echo "Statut mis à jour avec succès.";

         $query = "SELECT employe.id AS employe_id, employe.nom, employe.prenom, conges.dateDebut, conges.dateFin 
                  FROM conges 
                  JOIN employe ON conges.cin = employe.cin 
                  WHERE conges.id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $demande = $result->fetch_assoc();
        $stmt->close();

        if ($demande) {
             $message = "Votre demande de congé du " . $demande['dateDebut'] . " au " . $demande['dateFin'] . " a été " . $status . ".";

             $query = "INSERT INTO notification (scope, message, employe, sender_name, date_sent, sender_id) VALUES ('employe', ?, ?, 'System', NOW(), 0)";
            $stmt = $con->prepare($query);
            $stmt->bind_param('si', $message, $demande['employe_id']);
            $stmt->execute();

             if ($stmt->affected_rows > 0) {
                echo " Notification envoyée à l'employé.";
            } else {
                echo " Erreur lors de l'envoi de la notification.";
            }

            $stmt->close();
        } else {
            echo "Erreur : Demande de congé non trouvée.";
        }
    } else {
        echo "Erreur lors de la mise à jour du statut.";
    }
} else {
    echo "Erreur : ID ou statut invalide.";
}

 header("Location: liste_demande_conge.php");
exit();
?>
