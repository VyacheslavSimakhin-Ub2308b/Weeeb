<?php
session_start();
require 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header('Location: index.php');
            exit;
        } else {
            $error = 'Неверное имя пользователя или пароль!';
        }
    } else {
        $error = 'Пожалуйста, заполните все поля!';
    }
}

$pageTitle = 'Вход';
require 'header.php';
?>

<h1 class="mb-4 text-center">Вход</h1>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post" action="">
    <div class="mb-3">
        <label for="username" class="form-label">Имя пользователя</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Войти</button>
</form>

<?php
require 'footer.php';
?>
