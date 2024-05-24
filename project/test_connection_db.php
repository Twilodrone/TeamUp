<?php

$dsn = "pgsql:host=127.0.0.1;port=5432;dbname=teamup;";
$username = "dba";
$password = "12345";

try {
    $pdo = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "Connected successfully to PostgreSQL!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}