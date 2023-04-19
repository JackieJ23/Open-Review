<?php

$config = array(
    "db" => array(
        'host' => '', // Database host. localhost if running locally (port number required)
        'data' => '', // Schema which the tables is stored on
        'user' => '', // MySQL username
        'pass' => '', // MySQL password
        'chrs' => 'utf8mb4',
        'opts' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    )
);
// Have to add attr after config array already set.
$config['db']['attr'] = "mysql:host={$config['db']['host']};dbname={$config['db']['data']};charset={$config['db']['chrs']}";

/*
    Error reporting.
*/
// ini_set("error_reporting", "true");
// error_reporting(E_ALL);
?>