<?php
    require_once('connect.php');

     $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
    $post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;
    $status = isset($_GET['status']) ? $_GET['status'] : '';

     if ($user_id && $post_id && $status) {
        $UpdateSql = "
            UPDATE user_post_candidature 
            SET status = ? 
            WHERE user_id = ? AND post_id = ?";
        
        $stmt = $con->prepare($UpdateSql);
        $stmt->bind_param('sii', $status, $user_id, $post_id);

        if ($stmt->execute()) {
            echo "<script>
                    window.location.href = 'liste_candidat.php?post_id=$post_id';
                  </script>";
        } else {
            echo "Error updating status: " . $con->error;
        }
    } else {
        echo "Invalid parameters.";
    }
?>
