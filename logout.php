<?php

include __DIR__ . '/bootstrap.php';

if (isset($_POST['logout'])) {
    $_SESSION['LOGGED'] = false; 
    session_destroy();

    header('Location: index.php'); 
}


