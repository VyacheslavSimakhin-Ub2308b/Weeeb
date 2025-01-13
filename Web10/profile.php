<?php
session_start();
require_once 'config.php';

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$message = "";

// Получаем текущие данные пользователя
$stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Обрабатываем обновление данных
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Обновляем данные, если указаны
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
        $stmt->execute([$username, $email, $hashed_password, $user_id]);
    } else {
        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        $stmt->execute([$username, $email, $user_id]);
    }

    $message = "Данные успешно обновлены!";
    // Обновляем данные сессии
    $_SESSION['username'] = $username;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать профиль</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Редактировать профиль</h2>
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username">Имя пользователя:</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="password">Новый пароль (необязательно):</label>
            <input type="password" name="password" id="password">

            <button type="submit">Сохранить изменения</button>
        </form>
        <a href="index.php">Назад на главную</a>
    </div>
</body>
</html>
