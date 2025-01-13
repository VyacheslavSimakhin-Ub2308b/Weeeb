<?php
session_start();
require 'db_config.php';

try {
    $stmt = $pdo->query("SELECT * FROM services");
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Ошибка при выполнении запроса: " . $e->getMessage());
}

$pageTitle = 'Список услуг';
require 'header.php';
?>

<h1 class="mb-4 text-center">Доступные услуги</h1>
<?php if (!empty($services)): ?>
    <div class="row">
        <?php foreach ($services as $service): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($service['name']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($service['description']) ?></p>
                        <p class="card-text">Цена: <?= number_format($service['price'], 2) ?> руб.</p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Услуги отсутствуют.</p>
<?php endif; ?>

<?php
require 'footer.php';
?>
