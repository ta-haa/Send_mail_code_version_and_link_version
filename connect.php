<?php 
    $conn = new mysqli("localhost", "root", "", "emailcode");
    $conn->query("SET CHARACTER SET utf8");
    $conn->query("set names 'utf8'");

    if ($conn->connect_error) {
        die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
    } 
?>