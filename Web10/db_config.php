<?php
$dsn = 'mysql:host=localhost;dbname=consulting_app;charset=utf8'; // Имя базы данных
$username = 'root'; // Логин
$password = ''; // Пароль (пусто для XAMPP)

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>
