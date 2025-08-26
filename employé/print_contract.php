<?php
 
require_once('connect.php');

 if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

 $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

 if ($id === 0) {
    die("Invalid employee ID provided.");
}

$query = "SELECT * FROM `employe` WHERE id = ?";
$stmt = $con->prepare($query);

 if (!$stmt) {
    die("Failed to prepare query: " . $con->error);
}

 $stmt->bind_param('i', $id);

 $stmt->execute();

 $result = $stmt->get_result();

 if ($result->num_rows > 0) {
     $employee = $result->fetch_assoc();

    
     echo "<button onclick='window.print()'>Imprimer</button>";
} else {
     echo "<p>Employee not found.</p>";
}

 $stmt->close();
$con->close();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrat de Travail</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9mYalQV9jJgVm6xGdh0PfH2bgBp5dh68L64TTGg3YjRAFLkaYq4hH3jRSdF3fovM" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container my-5">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center mb-4">Contrat de Travail</h1>

                 <p><strong>Nom de l'employé :</strong> <?= htmlspecialchars($employee['nom']) . " " . htmlspecialchars($employee['prenom']) ?></p>
                <p><strong>Département :</strong> <?= htmlspecialchars($employee['departement']) ?></p>
                <p><strong>Poste :</strong> <?= htmlspecialchars($employee['poste']) ?></p>
                <p><strong>Type de contrat :</strong> <?= htmlspecialchars($employee['type_contrat']) ?></p>
                <p><strong>Salaire brut  :</strong> <?= htmlspecialchars($employee['salaire']) ?></p>
                <p><strong>Date de début :</strong> <?= htmlspecialchars($employee['dateDebut']) ?></p>
                <p><strong>Date de fin :</strong> <?= htmlspecialchars($employee['dateFin']) ?></p>
                <p><strong>Heures de travail :</strong> <?= htmlspecialchars($employee['horaire']) ?></p>

                 <h2>Période d'essai</h2>
                <p>La période d'essai est fixée à [durée de la période d'essai] mois à compter de la date de début du contrat. Pendant cette période, chaque partie peut mettre fin au contrat sans préavis.</p>

                 <h2>Congés</h2>
                <p>L'employé bénéficie de [nombre de jours] jours de congé payés par an. Les jours de congé doivent être pris en accord avec l'employeur. Les jours fériés nationaux sont des jours non travaillés et payés.</p>

                 <h2>Confidentialité</h2>
                <p>L'employé s'engage à maintenir la confidentialité de toutes les informations confidentielles auxquelles il aura accès dans le cadre de son emploi. Cela inclut, mais n'est pas limité à, les secrets commerciaux, les informations client, et les données de l'entreprise.</p>

                 <h2>Conditions de résiliation</h2>
                <p>Le contrat peut être résilié par l'une ou l'autre des parties moyennant un préavis écrit de [nombre de jours ou semaines] [jours ou semaines] au moins. La résiliation peut également être motivée pour faute grave ou non-respect du contrat.</p>

                 <h2>Clause de non-concurrence</h2>
                <p>L'employé s'engage à ne pas exercer d'activité concurrente ni à travailler pour une entreprise concurrente pendant [durée de la clause] mois après la fin de son contrat, dans un rayon de [définir le rayon géographique, par exemple : 50 km] autour du lieu de travail.</p>

                 <h2>Clause de propriété intellectuelle</h2>
                <p>Tous les droits de propriété intellectuelle, y compris les droits d'auteur, sur les œuvres créées par l'employé dans le cadre de son emploi appartiennent à l'employeur. Cela inclut, mais n'est pas limité à, les logiciels, les codes, les bases de données, et toute autre œuvre développée pendant la durée du contrat.</p>

                 <h2>Autres Clauses</h2>
                <p>Clause d'arbitrage : Tout litige relatif à ce contrat sera résolu par arbitrage conformément aux règles de [organisation d'arbitrage].</p>

                 <h2>Signature des parties</h2>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <p><strong>Employé :</strong></p>
                        <p>Signature : _______________________</p>
                        <p>Date : _______________________</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Employeur :</strong></p>
                        <p>Signature : _______________________</p>
                        <p>Date : _______________________</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybU+K4FnKm6KMR1MkBtuV6Xt9sTzllQolczAX6L9Wvc9fuS5T" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-5wRWghfvQ5QK0s08Xz5Swx7n5h7u1oJPQv1L9V+YH5eYEMVvU+W47vixA8zW5Y4w" crossorigin="anonymous"></script>
</body>

</html>
<style>
 body {
    font-family: 'Arial', sans-serif; /* Choix de la police */
    background-color: #f5f5f5; /* Couleur de fond */
    margin: 20px;
}

h1 {
    color: #2c3e50; /* Couleur du titre */
    text-align: center;
    margin-bottom: 20px;
}

.card {
    border: 1px solid #3498db; /* Bordure de la carte */
    border-radius: 8px; /* Arrondi des angles */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre de la carte */
    margin: 20px auto; /* Espacement autour de la carte */
    max-width: 800px; /* Largeur maximale */
}

.card-body {
    padding: 20px; /* Espacement à l'intérieur de la carte */
}

p {
    font-size: 16px; /* Taille de la police */
    line-height: 1.5; /* Interlignage */
    margin-bottom: 12px; /* Espacement inférieur */
}

h2 {
    color: #2980b9; /* Couleur des sous-titres */
    margin-top: 20px; /* Espacement supérieur */
    margin-bottom: 10px; /* Espacement inférieur */
}

.strong {
    color: #2980b9; /* Couleur des éléments en gras */
}

.signatures {
    margin-top: 40px; /* Espacement supérieur des signatures */
    display: flex;
    justify-content: space-between; /* Alignement horizontal */
}

.signatures p {
    margin: 0; /* Suppression de la marge */
    line-height: 1.2; /* Interlignage réduit */
}

/* Bouton d'impression */
button {
    margin: 20px auto;
    display: block;
    padding: 10px 20px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background-color: #2980b9;
}
</style>