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


$insertAdmin = <<<SQL
INSERT INTO admins(login, password) VALUES ('admin','\$2y\$10\$I6\.MSSs1Buv6Hc5BP5ObYueLq0OaRcus9Y\.oORp1gp41pf3hWV\.gW');
SQL;

//$2y$10$I6.MSSs1Buv6Hc5BP5ObYueLq0OaRcus9Y.oORp1gp41pf3hWV.gW


date_default_timezone_set('Europe/Berlin');

$databaseUser = 'paul';
$databsePassword = 'space';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=guest_book', $databaseUser, $databsePassword);
    if ($pdo->query('SELECT 1 FROM entries')) {
    }
    $connectionSuccess = true;
} catch (PDOException $exception) {
    if (($exception->getCode()) == "42S02") {
        $pdo->query($createTableSQL);
        $pdo->query($createAdminTableSQL);
        $pdo->query($insertAdmin);
    } else {
        $connectionError = 'Nie udało się połączyć z bazą danych';
    }
} catch (Exception $exception) {

    $connectionError = $exception->getMessage();
}
