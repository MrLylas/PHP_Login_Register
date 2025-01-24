<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h1>Sign in</h1>
        <main>
            <form action="traitement.php?action=register" method="POST">
            <label for="pseudo" name="pseudo" id="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo"><br>

            <label for="email" name="email" id="email">Email</label>
            <input type="email" name="email" id="email"><br>

            <label for="password" name="password" id="password">Password</label>
            <input type="password" name="password" id="password"><br>

            <label for="password2" name="password2" id="password2">Confirm Password</label>
            <input type="password" name="password2" id="password2"><br>
            
            <input type="submit" name="submit" value="Sign in"> 
            </form>
        </main>
</body>
</html>