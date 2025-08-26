<head>
    <meta charset="UTF-8">
    <title>Aziz GRH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<?php
session_start();
require_once('connect.php');

 if (!isset($_SESSION['user_id']) || !is_numeric($_SESSION['user_id'])) {
    header('Location: ../Login_v1/index.php');
    exit();
}

$id = $_SESSION['user_id'];

 $selSql = "SELECT * FROM `employe` WHERE id=?";
$stmt = $con->prepare($selSql);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$r = $res->fetch_assoc();

if (!$r) {
    die('Failed to fetch user details.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Compte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9mYalQV9jJgVm6xGdh0PfH2bgBp5dh68L64TTGg3YjRAFLkaYq4hH3jRSdF3fovM" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 50px auto;
        }
        .navbar {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

     <?php include 'navbarEmployé.php'; ?>

    <div class="container form-container">
        <h2 class="text-center">Modifier Compte</h2>
        <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($_SESSION['message']); ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php } ?>
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php } ?>
        <form action="update_account.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($r['nom']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo htmlspecialchars($r['prenom']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($r['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo htmlspecialchars($r['telephone']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="old_password" class="form-label">Ancien Mot de Passe</label>
                <input type="password" class="form-control" id="old_password" name="old_password">
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">Nouveau Mot de Passe</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmer le Nouveau Mot de Passe</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybU+K4FnKm6KMR1MkBtuV6Xt9sTzllQolczAX6L9Wvc9fuS5T" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-5wRWghfvQ5QK0s08Xz5Swx7n5h7u1oJPQv1L9V+YH5eYEMVvU+W47vixA8zW5Y4w" crossorigin="anonymous"></script>
</body>
</html>

