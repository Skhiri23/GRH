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

?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Salaires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">
    <div class="row pt-4">
        <h2>Liste des Salaires de <?php echo htmlspecialchars($cin); ?></h2>
    </div>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>cin</th>
                <th>Nom complet</th>
                <th>Salaire</th>
                <th>Primes</th>
                <th>Déduction</th>
                <th>Total net</th>
                <th>Mois</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($r = mysqli_fetch_assoc($res)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($r['cin']); ?></td>
                    <td><?php echo htmlspecialchars($r['nom'] . " " . $r['prenom_employee']); ?></td>
                    <td><?php echo htmlspecialchars($r['salaire']); ?></td>
                    <td class="editable" data-column="total_primes" data-id="<?php echo htmlspecialchars($r['id']); ?>"><?php echo htmlspecialchars($r['total_primes']); ?></td>
                    <td class="editable" data-column="total_deductions" data-id="<?php echo htmlspecialchars($r['id']); ?>"><?php echo htmlspecialchars($r['total_deductions']); ?></td>
                    <td><?php echo htmlspecialchars($r['total_net']); ?></td>
                    <td><?php echo htmlspecialchars($r['mois']); ?></td>
                    <td>
                        <i class="fa fa-print fa-2x blue-icon" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo htmlspecialchars($r['cin']); ?>"></i>
                        <div class="modal fade" id="exampleModal<?php echo htmlspecialchars($r['cin']); ?>" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Are you sure you want to print the payslip for this employee?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                                        <a href="print_bulltein.php?cin=<?php echo htmlspecialchars($r['cin']); ?>">
                                            <button class="btn btn-success" type="button">Confirm</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('.editable').click(function() {
        var $this = $(this);
        var currentText = $this.text().trim();
        var input = $('<input>', {
            value: currentText,
            type: 'text',
            blur: function() {
                var newValue = $(this).val();
                var id = $this.data('id');
                var column = $this.data('column');
                if (newValue !== currentText) {
                    $.ajax({
                        url: 'update_paiement_ajax.php',
                        type: 'POST',
                        data: {
                            id: id,
                            column: column,
                            value: newValue
                        },
                        success: function(response) {
                            if (response == 'success') {
                                $this.text(newValue);
                            } else {
                                alert('Failed to update.');
                            }
                        },
                        error: function() {
                            alert('Error while updating.');
                        }
                    });
                } else {
                    $this.text(currentText);
                }
            },
            keyup: function(e) {
                if (e.keyCode === 13) {
                    $(this).blur();
                }
            }
        }).appendTo($this.empty()).focus();
    });
});
</script>
</body>
</html>
