<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once './includes/default_head_include.inc.php' ?>
    <title>Message</title>

</head>

<body>

    <?php include_once './includes/default_js_include.inc.php' ?>

    <!-- Navbar-->
    <?php include_once(__DIR__.'/menubar/menubar_message.html.php') ?>

    <?php

    if (!isset($_GET['titre'])) {
        $titre = 'Message';
    } else {
        $titre = $_GET['titre'];
    }

    if (!isset($_GET['message'])) {
        $message = '';
    } else {
        $message = $_GET['message'];
    }

    // a examiner
    if (isset($_GET["pasAutorise"]))
        $message ="<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Vous n'êtes pas autorisé à accéder à cette page <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";

    if (isset($_GET["pasAdmin"]))
        $message ="<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur : Vous n'êtes pas autorisé à accéder à cette page d'administration <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";

    if (isset($_GET["erreurAuthentification1"]))
        $message ="<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur d'authenfication (1) <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";

    if (isset($_GET["erreurAuthentification2"]))
        $message ="<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur d'authenfication (2) <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";

    if (isset($_GET["erreurAuthentification3"]))
        $message ="<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur d'authenfication (3) <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";

    if (isset($_GET["erreurInscription"]))
    $message ="<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Erreur d'inscription <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";

    if (isset($_GET["inscriptionOK"]))
        $message ="<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Votre demande d'inscription est enregistrée ! <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";

    if (isset($_GET["validationOK"]))
        $message ="<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Votre validation est effectuée ! Vous pouvez maintenant vous connecter. <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";

    if (isset($_GET["validationNOK"]))
        $message ="<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">Votre validation n'est pas effectuée. <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";

    if (isset($_GET["mailValidationNOK"]))
        $message ="<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">Le email de validation de votre compte n'a pas pu être envoyé. <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";

        if (isset($_GET["mailValidationOK"]))
        $message ="<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Le email de validation de votre compte est parti. <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";

    if (isset($_GET["deleteOK"]))
        $message ="<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">La supression a été est effectuée. <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";

    if (isset($_GET["deleteNOK"]))
        $message ="<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">La supression n'est pas effectuée. <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";

    include './contenu/message.html.php';
    include './layout/default_layout.php';

    ?>

</body>
</html>