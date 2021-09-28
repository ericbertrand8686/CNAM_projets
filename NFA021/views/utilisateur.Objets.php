<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include_once '../views/includes/default_head_include.inc.php';
    ?>
    
    <title><?php echo $objets ?></title>

</head>

<body>

    <?php include_once '../views/includes/default_js_include.inc.php' ?>
    
    <!-- Navbar-->
    <?php include_once '../views/menubar/menubar_default.html.php' ?>

    <?php

    include '../views/contenu/utilisateur.' . $objets . '.html.php';
    include '../views/layout/default_layout.php';
    ?>

</body>
</html>