<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4 text-center">Панель администратора</h1>
        <div class="row mb-4">
            <!-- Управление пользователями -->
            <div class="col-md-6">
                <h2>Пользователи</h2>
                <?php
                session_start();
                require 'db_config.php';

                // Проверка на роль администратора
                if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
                    header('Location: index.php');
                    exit;
                }

                // Получение списка пользователей
                $stmt = $pdo->query("SELECT id, username, role FROM users");
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($users)): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Имя пользователя</th>
                                <th>Роль</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $user['id'] ?></td>
                                    <td><?= htmlspecialchars($user['username']) ?></td>
                                    <td><?= htmlspecialchars($user['role']) ?></td>
                                    <td>
                                        <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-primary btn-sm">Редактировать</a>
                                        <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены?')">Удалить</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Пользователи не найдены.</p>
                <?php endif; ?>
            </div>

            <!-- Управление услугами -->
            <div class="col-md-6">
                <h2>Услуги</h2>
                <?php
                // Получение списка услуг
                $stmt = $pdo->query("SELECT * FROM services");
                $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($services)): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Цена</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($services as $service): ?>
                                <tr>
                                    <td><?= $service['id'] ?></td>
                                    <td><?= htmlspecialchars($service['name']) ?></td>
                                    <td><?= htmlspecialchars($service['description']) ?></td>
                                    <td><?= number_format($service['price'], 2) ?> руб.</td>
                                    <td>
                                        <a href="?delete_service=<?= $service['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены?')">Удалить</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Доступных услуг нет.</p>
                <?php endif; ?>

                <!-- Добавление новой услуги -->
                <h3 class="mt-4">Добавить новую услугу</h3>
                <form method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Название услуги:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Описание:</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Цена:</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                    </div>
                    <button type="submit" name="add_service" class="btn btn-primary">Добавить услугу</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
