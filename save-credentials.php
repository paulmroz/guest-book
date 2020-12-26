<?php

include __DIR__ . '/bootstrap.php';

if (isset($_POST['submit'])) {
    $_SESSION['DB_USERNAME'] = htmlspecialchars($_POST['username']);
    $_SESSION['DB_PASSWORD'] = trim($_POST['password']);


    $stmt = $pdo->prepare("SELECT password FROM admins WHERE login = ?");
    $stmt->execute([
        $_SESSION['DB_USERNAME']
    ]);

    $databasePassword = $stmt->fetch(PDO::FETCH_ASSOC);

    //dump($databasePassword);

    //dump($admin);
    
    if (!$databasePassword) {
    
        header('Location: login.php');
    } else {
        if(password_verify($_SESSION['DB_PASSWORD'], $databasePassword["password"])){
            $_SESSION['LOGGED'] = true;
            //dump($loginSuccess);
            header('Location: delete.php');
        } else {
            header('Location: index.php');
        }
    }
}




