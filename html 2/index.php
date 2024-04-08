<?php
require("connection.php");

if(isset($_POST["submit"])){
    var_dump($_POST);

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $con->prepare("SELECT * FROM users WHERE username=:username OR email=:email");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $userAlreadyExists =$stmt->fetchColumn();

    if(!$userAlreadyExists){
        //registrieren
        registerUser($username, $email, $password);
    }
    else{
        //User existiert bereits
    }
}

function registerUser($username, $email, $password){
    global $con;
    $stmt = $con->prepare("INSERT INTO users(username, email, password) VALUES(, $username, $email, $password)");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam("password", $password);
    $stmt->execute();
}

?>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrieren</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="index.php" method="POST">
        <h1>Account Erstellen</h1>
        <div class="inputs_container">
            <input type="text" placeholder="Benutzername" name="username" autocomplete="off">
            <input type="text" placeholder="Email" name="email" autocomplete="off">
            <input type="Password" placeholder="Passwort" name="password" autocomplete="off">
        </div>
        <button name="submit">Erstellen</button>
    </form>
</body>
</html>