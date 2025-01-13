<?php
session_start();
require 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    
    $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    $stmt->execute([$username, $email, $_SESSION['user_id']]);
    
    $_SESSION['username'] = $username;
    $success = 'Профиль обновлен.';
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$pageTitle = 'Редактирование профиля';
require 'header.php';
?>

<h1 class="mb-4 text-center">Редактирование профиля</h1>
<?php if (isset($success)): ?>
    <div class="alert alert-success"><?= $success ?></div>
<?php endif; ?>
<form method="post">
    <div class="mb-3">
        <label for="username" class="form-label">Имя пользователя:</label>
        <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Электронная почта:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Обновить профиль</button>
</form>

<?php
require 'footer.php';