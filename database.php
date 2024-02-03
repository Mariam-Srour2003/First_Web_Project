<?php
try {
    $con = new mysqli("localhost", "root", "", "eventsdb");
    if ($con->connect_errno) {
        throw new Exception("Failed to connect to MySQL: " . $con->connect_error);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
$pdo = new PDO("mysql:host=localhost;dbname=eventsdb", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>