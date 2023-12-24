<?php
require_once 'cred.php';

$db = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
//Konstante
define('db', $db);

if (db->connect_error) {
    // Navigate to 404 page
    echo "Error connecting to " . $_ENV['DB_NAME'] . ": " . db->connect_error; // weg
    exit(1);
} 
