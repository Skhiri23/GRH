<?php
require_once('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $statut = 'pending';
    $submission_date = date('Y-m-d H:i:s');


    $sql = "INSERT INTO candidature (firstname, lastname, email, gender, phone, start_date, address, statut, submission_date, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);

    if (!$stmt) {
        echo "Erreur de préparation: " . $con->error;
        exit();
    }

    $start_date = ""; 
    $stmt->bind_param("ssssssssss", $firstname, $lastname, $email, $gender, $phone, $start_date, $address, $statut, $submission_date, $password);

    if ($stmt->execute()) {

        $userId = $stmt->insert_id;
        

        session_start();
        $_SESSION['id'] = $userId;


        header('Location: Liste_des_posteCandidat.php');
        exit();
    } else {
        echo "Erreur d'exécution: " . $stmt->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Candidature</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
        .formbold-mb-3 {
            margin-bottom: 15px;
        }

        .formbold-main-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px;
        }

        .formbold-form-wrapper {
            margin: 0 auto;
            max-width: 570px;
            width: 100%;
            background: white;
            padding: 40px;
        }

        .formbold-input-flex {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }
        .formbold-input-flex > div {
            width: 50%;
        }
        .formbold-form-input {
            width: 100%;
            padding: 13px 22px;
            border-radius: 5px;
            border: 1px solid #dde3ec;
            background: #ffffff;
            font-weight: 500;
            font-size: 16px;
            color: #536387;
            outline: none;
            resize: none;
        }
        .formbold-form-input::placeholder,
        select.formbold-form-input,
        .formbold-form-input[type='date']::-webkit-datetime-edit-text,
        .formbold-form-input[type='date']::-webkit-datetime-edit-month-field,
        .formbold-form-input[type='date']::-webkit-datetime-edit-day-field,
        .formbold-form-input[type='date']::-webkit-datetime-edit-year-field {
            color: rgba(83, 99, 135, 0.5);
        }

        .formbold-form-label {
            color: #536387;
            font-size: 14px;
            line-height: 24px;
            display: block;
            margin-bottom: 10px;
        }

        .formbold-btn {
            text-align: center;
            width: 100%;
            font-size: 16px;
            border-radius: 5px;
            padding: 14px 25px;
            border: none;
            font-weight: 500;
            background-color: #6a64f1;
            color: white;
            cursor: pointer;
            margin-top: 25px;
        }
        .formbold-btn:hover {
            box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>
    <div class="formbold-main-wrapper">
        <div class="formbold-form-wrapper">
            <form method="POST" > 
                <div class="formbold-input-flex">
                    <div>
                        <label for="firstname" class="formbold-form-label">Prénom</label>
                        <input
                            type="text"
                            name="firstname"
                            id="firstname"
                            class="formbold-form-input"
                            required
                        />
                    </div>
                    <div>
                        <label for="lastname" class="formbold-form-label">Nom de famille</label>
                        <input
                            type="text"
                            name="lastname"
                            id="lastname"
                            class="formbold-form-input"
                            required
                        />
                    </div>
                </div>
                <div class="formbold-mb-3">
                    <label for="email" class="formbold-form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="formbold-form-input"
                        required
                    />
                </div>
                <div class="formbold-mb-3">
                    <label for="password" class="formbold-form-label">Mot de passe</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="formbold-form-input"
                        required
                    />
                </div>
                <div class="formbold-mb-3">
                    <label for="gender" class="formbold-form-label">Genre</label>
                    <select name="gender" id="gender" class="formbold-form-input" required>
                        <option value="">Sélectionnez le genre</option>
                        <option value="homme">Homme</option>
                        <option value="femme">Femme</option>
                    </select>
                </div>
                <div class="formbold-mb-3">
                    <label for="phone" class="formbold-form-label">Téléphone</label>
                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        class="formbold-form-input"
                        required
                    />
                </div>
                <div class="formbold-mb-3">
                    <label for="address" class="formbold-form-label">Adresse</label>
                    <input
                        type="text"
                        name="address"
                        id="address"
                        class="formbold-form-input"
                        required
                    />
                </div>
                <button type="submit" class="formbold-btn">créer compte</button>
            </form>
           
        </div>
    </div>
</body>
</html>
