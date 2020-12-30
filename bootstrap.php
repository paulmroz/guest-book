<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
session_start();


function dump($variable)
{
    echo "<pre>";
    var_dump($variable);
    die;
}

function getParam($paramName, $defaultValue = null)
{
    if (!isset($_GET[$paramName])) {
        return $defaultValue;
    }

    return htmlspecialchars($_GET[$paramName]);
}

$createTableSQL = <<<SQL
create table if not exists entries
(
	id int auto_increment,
	autor varchar(255) null,
	wpis text null,
    created_at datetime null,
	constraint entries_pk
		primary key (id)
);
SQL;



$createAdminTableSQL = <<<SQL
create table if not exists admins
(
	id int auto_increment,
	login varchar(255) null,
	password varchar(255) null,
	constraint admins_pk
		primary key (id)
);
SQL;


$insertAdmin= <<<SQL
INSERT INTO admins(login, password) VALUES ('admin','pass');
SQL;

//$2y$10$S5mK6zjgxeh60DXtdFX44eNdMLGYN99pGf.BeYnf2OqHrOZZPHaR

date_default_timezone_set('Europe/Berlin');



try {
    $pdo = new PDO('mysql:host=localhost;dbname=guest_book', 'paul', 'space');
    if ($pdo->query('SELECT 1 FROM entries')) {     
    }
    $connectionSuccess = true;
} catch (PDOException $exception) {
    if(($exception->getCode()) == "42S02"){
        $pdo->query($createTableSQL);
        $pdo->query($createAdminTableSQL);
        $pdo->query($insertAdmin);

    } else {
        $connectionError = 'Nie udało się połączyć z bazą danych';
    }
} catch (Exception $exception) {

    $connectionError = $exception->getMessage();
}

