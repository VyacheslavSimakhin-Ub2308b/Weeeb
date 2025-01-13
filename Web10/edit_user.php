<?php
session_start();
require_once 'config.php';

// Проверяем, является ли пользователь администратором
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Получаем ID редактируемого пользователя
if (!isset($_GET['user_id'])) {
    header("Location: admin.php");
    exit;
}

$user_id = $_GET['user_id'];

// Получаем информацию о пользователе из базы данных
$stmt = $conn->prepare("SELECT username, email, role FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    header("Location: admin.php");
    exit;
}

// Обновление данных пользователя
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $update_stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
    $update_stmt->bind_param("sssi", $username, $email, $role, $user_id);
    $update_stmt->execute();

    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать пользователя</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4 text-center">Редактировать пользователя</h1>
        <form method="POST" action="" class="bg-white p-4 rounded shadow-sm">
            <div class="mb-3">
                <label for="username" class="form-label">Имя пользователя:</label>
                <input type="text" class="form-control" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Роль:</label>
                <select name="role" id="role" class="form-select">
                    <option value="user" <?php echo $user['role'] === 'user' ? 'selected' : ''; ?>>Пользователь</option>
                    <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Администратор</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
            <a href="admin.php" class="btn btn-secondary ms-2">Назад в админ-панель</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
