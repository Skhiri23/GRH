<?php
require_once('connect.php');

$cin = '';
if (isset($_GET['cin'])) {
    $cin = mysqli_real_escape_string($con, $_GET['cin']);
}

$query = "SELECT * FROM paiement_employee WHERE cin = '$cin'";
$res = mysqli_query($con, $query);

if (!$res) {
    die('Error executing query: ' . mysqli_error($con));
}

$employee = mysqli_fetch_assoc($res);
if (!$employee) {
    die('No employee found with the given CIN.');
}

function getFrenchMonthName($monthNumber) {
    $months = [
        1 => 'Janvier',
        2 => 'Février',
        3 => 'Mars',
        4 => 'Avril',
        5 => 'Mai',
        6 => 'Juin',
        7 => 'Juillet',
        8 => 'Août',
        9 => 'Septembre',
        10 => 'Octobre',
        11 => 'Novembre',
        12 => 'Décembre'
    ];
    return $months[(int)$monthNumber] ?? 'Invalid Month';
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Payslip for <?php echo htmlspecialchars($employee['nom']) . ' ' . htmlspecialchars($employee['prenom_employee']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .printableArea {
            margin: 20px;
            padding: 20px;
            border: 1px solid #000;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            margin-bottom: 20px;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
        }
        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="printableArea">
        <div class="header">
            <h2>Bulltein de salaire</h2>
            <p>Employee CIN: <?php echo htmlspecialchars($employee['cin']); ?></p>
        </div>

        <table class="table table-bordered">
            <tr>
                <th>Nom complet</th>
                <td><?php echo htmlspecialchars($employee['nom']) . ' ' . htmlspecialchars($employee['prenom_employee']); ?></td>
            </tr>
            <tr>
                <th>Salaire</th>
                <td><?php echo htmlspecialchars($employee['salaire']); ?></td>
            </tr>
            <tr>
                <th>Primes</th>
                <td><?php echo htmlspecialchars($employee['total_primes']); ?></td>
            </tr>
            <tr>
                <th>Déduction</th>
                <td><?php echo htmlspecialchars($employee['total_deductions']); ?></td>
            </tr>
            <tr>
                <th>Total net</th>
                <td><?php echo htmlspecialchars($employee['total_net']); ?></td>
            </tr>
            <tr>
                <th>Mois</th>
                <td><?php echo htmlspecialchars(getFrenchMonthName($employee['mois'])); ?></td>
            </tr>
        </table>

        <div class="footer">
            <p>Thank you for your hard work!</p>
        </div>
    </div>

    <div class="text-center">
        <button onclick="window.print();" class="btn btn-primary print-button">Print</button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
