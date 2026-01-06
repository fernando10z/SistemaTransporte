<?php
$host = "mysql";
$dbname = "spacioso_transporte";
$username = "root";
$password = "root";

//$host = "localhost";
//$dbname = "spacioso_transporte";
//$username = "spacioso_transporte";
//$password = "ofaDM(c&(blk";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}