<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once './includes/default_head_include.inc.php' ?>
    <title>Admin</title>

</head>

<body>

    <?php include_once './includes/default_js_include.inc.php' ?>
    
    <!-- Navbar-->
    <?php include_once __DIR__.'/menubar/menubar_Admin.html.php' ?>

    <?php
    $titre = 'Admin';
    include './contenu/admin.html.php';
    include './layout/default_layout.php';
    ?>

</body>
</html>