<?php
session_start();

if(isset($_GET["action"])){
    switch($_GET["action"]){
        case "register":
            if(isset($_POST["submit"])){
                    //On se connecte a la base de donnees
                $pdo = new PDO("mysql:host=localhost;dbname=php_login_register;charset=utf8", "root", "");
                //filter la saisie des champs du formulaire d'inscription
                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS,FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);
                $password2 = filter_input(INPUT_POST,"password2", FILTER_SANITIZE_SPECIAL_CHARS);

                if($pseudo && $email && $password && $password2){
                    $requete = $pdo->prepare("SELECT * FROM user WHERE email = :email");
                    $requete->execute([
                        "email" => $email
                    ]);
                    $user = $requete->fetch();
                    //Si user existe déjà alors on affiche un message :
                    if($user){
                        header("Location: register.php");
                        exit;
                    }else{
                        //On vérifie si les deux mots de passe sont identiques et si la longueur du mot de passe est >= 5 
                        if($password === $password2 && strlen($password) >= 5){
                            $insertUser = $pdo->prepare("INSERT INTO user (pseudo, email, password) VALUES(:pseudo, :email, :password)");
                            $insertUser->execute([
                                "pseudo" => $pseudo,
                                "email" => $email,
                                "password" => password_hash($password, PASSWORD_DEFAULT)
                            ]);
                            header("Location: login.php");
                            exit;
                        }else{
                            echo("Mots de passes non identique ou mot de passe trop court");
                            exit;
                        };
                    }

                }else{
                    header("Location: register.php");
                    exit;
                }
            }
        break;

        case "login":
            if(isset($_POST["submit"])){
                //On se connecte a la base de donnees
                $pdo = new PDO("mysql:host=localhost;dbname=php_login_register;charset=utf8", "root", "");
                //filter la saisie des champs du formulaire d'inscription zfin de se protéger des failles xss
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS,FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);

                if($email && $password){
                    $requete = $pdo->prepare("SELECT * FROM user WHERE email = :email");
                    $requete->execute([
                        "email" => $email
                    ]);
                    $user = $requete->fetch();
                    //On verifie si l'utilisateur existe
                    if($user){
                        $hash = $user["password"];
                        if(password_verify($password, $hash)){
                            $_SESSION["user"] = $user;
                            header("Location: home.php");
                            exit;
                        }else{
                            header("Location: login.php");
                            exit;
                        }
                    }else{
                        header("Location: login.php");
                        exit;
                    }    
                }
            } 
        header("Location: login.php");
        exit;
        break;

        case "profile":
            if(isset($_SESSION["user"])){
                header("Location: profile.php");
                exit;
            }else{
                header("Location: login.php");
                exit;
            }
        break;

        case "logout":
            unset($_SESSION["user"]);
            header("Location: home.php");
            exit;
        break;
    }

}