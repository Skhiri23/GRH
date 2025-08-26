<?php
    require_once('connect.php');
    
     $post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

     $ReadSql = "
        SELECT 
            candidature.id, 
            candidature.firstname, 
            candidature.lastname, 
            candidature.email, 
            candidature.gender, 
            candidature.phone, 
            candidature.start_date, 
            candidature.address, 
            candidature.cover_letter, 
            candidature.resume, 
            candidature.submission_date, 
            user_post_candidature.status 
        FROM 
            candidature 
        INNER JOIN 
            user_post_candidature 
        ON 
            candidature.id = user_post_candidature.user_id 
        WHERE 
            user_post_candidature.post_id = $post_id";

    $res = mysqli_query($con, $ReadSql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Candidats</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

    <?php include 'navbar.php'; ?>

    <div class="container">
        <div class="row pt-4">
            <h2>Liste des Candidats pour le Poste ID: <?php echo $post_id; ?></h2>
        </div>

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Start Date</th>
                    <th>Address</th>
                    <th>Cover Letter</th>
                    <th>Resume</th>
                    <th>Submission Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($r = mysqli_fetch_assoc($res)) { ?>
                <tr>
                    <th scope="row"><?php echo $r['id']; ?></th>
                    <td><?php echo $r['firstname']; ?></td>
                    <td><?php echo $r['lastname']; ?></td>
                    <td><?php echo $r['email']; ?></td>
                    <td><?php echo $r['gender']; ?></td>
                    <td><?php echo $r['phone']; ?></td>
                    <td><?php echo $r['start_date']; ?></td>
                    <td><?php echo $r['address']; ?></td>
                    <td><?php echo $r['cover_letter']; ?></td>
                    <td><?php echo $r['resume']; ?></td>
                    <td><?php echo $r['submission_date']; ?></td>
                    <td><?php echo $r['status']; ?></td>
                    <td>
                         <a href="update_status_candidature.php?user_id=<?php echo $r['id']; ?>&post_id=<?php echo $post_id; ?>&status=accepted" class="btn btn-success m-2" title="Accepter">
                            <i class="fa fa-check"></i>
                        </a>

                         <a href="update_status_candidature.php?user_id=<?php echo $r['id']; ?>&post_id=<?php echo $post_id; ?>&status=rejected" class="btn btn-danger m-2" title="Refuser">
                            <i class="fa fa-times"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
