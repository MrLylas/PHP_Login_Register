<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_SESSION["user"])){?>
        <a href="traitement.php?action=logout">Logout</a>
    <?php }else{ ?> 
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php } ?>
    <h1>Acceuil</h1>
    <?php
    if(isset($_SESSION["user"])){?>
    <p>Bienvenue <?=$_SESSION["user"]["pseudo"]?></p>
    <a href="traitement.php?action=profile">Profile</a>
    <?php }?>
</body>
</html>