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
    <h1>Profile</h1>
    <?php
    $infoSession = $_SESSION["user"];
    echo "<p>Pesudo :".$infoSession["pseudo"]."</p>";
    echo "<p>Email :".$infoSession["email"]."</p>";
    ?>
</body>
</html>