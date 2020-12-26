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


date_default_timezone_set('Europe/Berlin');


$dsn = sprintf(
    "mysql:dbname=guest_book;host=localhost"
);

try {
    $pdo = new PDO($dsn, 'paul', 'space');

    if (!$pdo->query('SELECT 1 FROM entries')) {
        $pdo->query($createTableSQL);
    }
    $connectionSuccess = true;
} catch (PDOException $exception) {
    $connectionError = 'Nie udało się połączyć z bazą danych';
} catch (Exception $exception) {
    $connectionError = $exception->getMessage();
}
