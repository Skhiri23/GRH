<?php
require_once('connect.php');
session_start();


if (!isset($_SESSION['id'])) {
    echo "User is not logged in.";
    exit;
}

$userId = $_SESSION['id'];

$getNameSql = "SELECT CONCAT(firstname, ' ', lastname) AS full_name FROM candidature WHERE id = ?";
$stmtGetName = $con->prepare($getNameSql);
$stmtGetName->bind_param('i', $userId);
$stmtGetName->execute();
$stmtGetName->bind_result($userNameFromDatabase);
$stmtGetName->fetch();
$stmtGetName->close();


$_SESSION['nom'] = $userNameFromDatabase;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post_id'])) {
    $postId = intval($_POST['post_id']);
    

    $checkSql = "SELECT 1 FROM user_post_candidature WHERE user_id = ? AND post_id = ?";
    $checkStmt = $con->prepare($checkSql);
    $checkStmt->bind_param('ii', $userId, $postId);
    $checkStmt->execute();
    $checkStmt->store_result();
    
    if ($checkStmt->num_rows == 0) {

        $relationSql = "INSERT INTO user_post_candidature (user_id, post_id) VALUES (?, ?)";
        $relationStmt = $con->prepare($relationSql);
        $relationStmt->bind_param('ii', $userId, $postId);

        if ($relationStmt->execute()) {

            $getPostNameSql = "SELECT titre_poste FROM posts WHERE id = ?";
            $stmtGetPostName = $con->prepare($getPostNameSql);
            $stmtGetPostName->bind_param('i', $postId);
            $stmtGetPostName->execute();
            $stmtGetPostName->bind_result($postName);
            $stmtGetPostName->fetch();
            $stmtGetPostName->close();

            $message = "L'utilisateur $userNameFromDatabase a postulé pour le poste \"$postName\".";

            $sql_hr_agent_id = "SELECT id FROM employe WHERE poste = 'agent RH' LIMIT 1";
            $result_hr_agent_id = mysqli_query($con, $sql_hr_agent_id);

            if ($result_hr_agent_id && mysqli_num_rows($result_hr_agent_id) > 0) {
                $hr_agent_row = mysqli_fetch_assoc($result_hr_agent_id);
                $hrAgentId = $hr_agent_row['id'];

                $sqlNotification = "INSERT INTO notification (employe, message, date_sent) VALUES (?, ?, NOW())";
                $stmtNotification = $con->prepare($sqlNotification);
                $stmtNotification->bind_param("is", $hrAgentId, $message);
                $stmtNotification->execute();
                $stmtNotification->close();

                $notification_message = "Candidature soumise avec succès.";
                $notification_message_type = "success";
            } else {

                $notification_message = "Error: No HR agent with the position 'agent RH' found.";
                $notification_message_type = "danger";
            }
        } else {
            $notification_message = "Error: " . $relationStmt->error;
            $notification_message_type = "danger";
        }

        $relationStmt->close();
    } else {
        $notification_message = "You have already applied for this post.";
        $notification_message_type = "warning";
    }

    $checkStmt->close();
}


$ReadSql = "SELECT * FROM `posts`";
$res = mysqli_query($con, $ReadSql);

include "navbarcandidat.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aziz GRH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row pt-4">
            <h2>Liste des Poste Vacant</h2>
        </div>

        <?php if (isset($notification_message)): ?>
            <div class="alert alert-<?php echo htmlspecialchars($notification_message_type); ?>" role="alert">
                <?php echo htmlspecialchars($notification_message); ?>
            </div>
        <?php endif; ?>

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Titre Poste</th>
                    <th>Description</th>
                    <th>Date Limite</th>
                    <th>Statut Poste</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($r = mysqli_fetch_assoc($res)) { ?>
                <tr>
                    <th scope="row"><?php echo $r['id']; ?></th>
                    <td><?php echo $r['titre_poste']; ?></td>
                    <td><?php echo $r['description']; ?></td>
                    <td><?php echo $r['date_limite']; ?></td>
                    <td><?php echo $r['statut_poste']; ?></td>
                    <td>
                        <?php
                        if ($r['statut_poste'] == 'Inactif') {
                            echo '<button class="btn btn-secondary" disabled>Postuler</button>';
                        } else {
                            echo '<form method="post" action="">
                                    <input type="hidden" name="post_id" value="' . $r['id'] . '">
                                    <button type="submit" class="btn btn-primary">Postuler</button>
                                  </form>';
                        }
                        ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
