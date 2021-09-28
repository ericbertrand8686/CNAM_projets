<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once './includes/default_head_include.inc.php' ?>
    <title>Message</title>

</head>

<body>

    <?php include_once './includes/default_js_include.inc.php' ?>

    <!-- Navbar-->
    <?php include_once(__DIR__.'/menubar/menubar_login.html.php') ?>

    <?php
    $titre = 'Inscription';
    include './contenu/signin.html.php';
    include './layout/default_layout.php';
    ?>

</body>
</html>