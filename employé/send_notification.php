<?php
session_start();

include 'navbarEmployé.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Login_v1/index.php');
    exit();
}

$message = isset($_SESSION['notification_message']) ? $_SESSION['notification_message'] : '';
$message_type = isset($_SESSION['notification_message_type']) ? $_SESSION['notification_message_type'] : '';

 unset($_SESSION['notification_message']);
unset($_SESSION['notification_message_type']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envoyer une Notification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Envoyer une Notification</h1>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo htmlspecialchars($message_type); ?>" role="alert">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form action="send_notification_process.php" method="post">
            <div class="form-group">
                <label for="scope">Portée de l'envoi</label>
                <select id="scope" name="scope" class="form-control" onchange="updateScope()" required>
                    <option value="all">Tous les employés</option>
                    <option value="department">Tous les employés d'un département</option>
                    <option value="post">Tous les employés d'un poste</option>
                    <option value="employee">Employé spécifique</option>
                </select>
            </div>
            <div class="form-group" id="department-group" style="display: none;">
                <label for="departement">Département</label>
                <select id="departement" name="departement" class="form-control" onchange="updatePostes()">
                    <option value="">Sélectionnez un département</option>
                    <?php
                    include 'connect.php';

                     $sql = "SELECT DISTINCT departement FROM employe ORDER BY departement";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<option value="'.$row['departement'].'">'.$row['departement'].'</option>';
                        }
                    } else {
                        echo '<option value="">Aucun département trouvé</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group" id="post-group" style="display: none;">
                <label for="poste">Poste</label>
                <select id="poste" name="poste" class="form-control" onchange="updateEmployes()">
                    <option value="">Sélectionnez un poste</option>
                </select>
            </div>
            <div class="form-group" id="employee-group" style="display: none;">
                <label for="employe">Employé</label>
                <select id="employe" name="employe" class="form-control">
                    <option value="">Sélectionnez un employé</option>
                </select>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>

    <script>
        function updateScope() {
            const scope = document.getElementById('scope').value;
            document.getElementById('department-group').style.display = (scope === 'department' || scope === 'post' || scope === 'employee') ? 'block' : 'none';
            document.getElementById('post-group').style.display = (scope === 'post' || scope === 'employee') ? 'block' : 'none';
            document.getElementById('employee-group').style.display = scope === 'employee' ? 'block' : 'none';
        }

        function updatePostes() {
            const departement = document.getElementById('departement').value;
            const posteSelect = document.getElementById('poste');
            const employeSelect = document.getElementById('employe');

            posteSelect.innerHTML = '<option value="">Sélectionnez un poste</option>';
            employeSelect.innerHTML = '<option value="">Sélectionnez un employé</option>';

            if (departement) {
                fetch('get_postes.php?departement=' + departement)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(poste => {
                            const option = document.createElement('option');
                            option.value = poste;
                            option.textContent = poste;
                            posteSelect.appendChild(option);
                        });
                    });
            }
        }

        function updateEmployes() {
            const poste = document.getElementById('poste').value;
            const employeSelect = document.getElementById('employe');

            employeSelect.innerHTML = '<option value="">Sélectionnez un employé</option>';

            if (poste) {
                fetch('get_employes.php?poste=' + poste)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(employe => {
                            const option = document.createElement('option');
                            option.value = employe.id;
                            option.textContent = employe.nom + ' ' + employe.prenom;
                            employeSelect.appendChild(option);
                        });
                    });
            }
        }
    </script>
</body>
</html>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f0f5f9;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 50px auto;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #333333;
}

label {
    font-weight: bold;
    color: #333333;
}

select, textarea {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #cccccc;
    border-radius: 5px;
    box-sizing: border-box;
}

button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}
</style>
