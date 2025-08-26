<?php
session_start();
require_once('connect.php');

 if (!isset($_SESSION['user_id']) || !is_numeric($_SESSION['user_id'])) {
    header('Location: ../Login_v1/index.php');
    exit();
}

$id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $telephone = htmlspecialchars(trim($_POST['telephone']));
    $old_password = htmlspecialchars(trim($_POST['old_password']));
    $new_password = htmlspecialchars(trim($_POST['new_password']));
    $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));

     $selSql = "SELECT paswrd FROM `employe` WHERE id=?";
    $stmt = $con->prepare($selSql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $current_password = $r['paswrd'];

     $updateSql = "UPDATE `employe` SET nom=?, prenom=?, email=?, telephone=?";

     if (!empty($old_password) && $old_password === $current_password) {
         if ($new_password === $confirm_password) {
            $updateSql .= ", paswrd=?";
            $updateSql .= " WHERE id=?";
            $stmt = $con->prepare($updateSql);
            $stmt->bind_param("sssssi", $nom, $prenom, $email, $telephone, $new_password, $id);
        } else {
            $erreur = "Les nouveaux mots de passe ne correspondent pas.";
            header("Location: modifier_compte.php?error=" . urlencode($erreur));
            exit();
        }
    } elseif (!empty($old_password) && $old_password !== $current_password) {
        $erreur = "L'ancien mot de passe est incorrect.";
        header("Location: modifier_compte.php?error=" . urlencode($erreur));
        exit();
    } else {
        $updateSql .= " WHERE id=?";
        $stmt = $con->prepare($updateSql);
        $stmt->bind_param("ssssi", $nom, $prenom, $email, $telephone, $id);
    }

    if ($stmt->execute()) {
        $_SESSION['message'] = "Modifications enregistrées avec succès.";
        header("Location: modifier_compte.php");
        exit();
    } else {
        $erreur = "La mise à jour a échoué.";
        header("Location: modifier_compte.php?error=" . urlencode($erreur));
        exit();
    }
} else {
    $erreur = "Form data is invalid.";
    header("Location: modifier_compte.php?error=" . urlencode($erreur));
    exit();
}
?>
