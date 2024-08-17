<?php

$user_name = 'root';
$db = 'atm_machine';
$password = '';
$host = 'localhost';

try {
    $conn = new PDO("mysql:dbname=$db;host=$host", $user_name, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
