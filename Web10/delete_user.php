<?php
session_start();
require 'db_config.php';

// Проверка, является ли пользователь администратором
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

// Получение ID пользователя
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Удаление пользователя
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);

    header('Location: admin.php'); // Возврат в админ-панель
    exit;
} else {
    die('ID пользователя не указан!');
}
?>
