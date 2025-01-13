<?php
session_start();
require 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT services.name, services.description, services.price 
    FROM user_services
    JOIN services ON user_services.service_id = services.id
    WHERE user_services.user_id = ?
");
$stmt->execute([$user_id]);
$my_services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои услуги</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <h1 class="mb-4 text-center">Мои услуги</h1>
        <?php if (!empty($my_services)): ?>
            <ul class="list-group">
                <?php foreach ($my_services as $service): ?>
                    <li class="list-group-item">
                        <h2><?= htmlspecialchars($service['name']) ?></h2>
                        <p><?= htmlspecialchars($service['description']) ?></p>
                        <p>Цена: <?= number_format($service['price'], 2) ?> руб.</p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Вы еще не выбрали ни одной услуги.</p>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>