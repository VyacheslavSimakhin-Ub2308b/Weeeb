<?php
session_start();
require 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, 'user')");
        try {
            $stmt->execute(['username' => $username, 'password' => $hashedPassword]);
            $_SESSION['message'] = 'Регистрация прошла успешно! Теперь вы можете войти в систему.';
            header('Location: login.php');
            exit;
        } catch (PDOException $e) {
            $error = 'Пользователь с таким именем уже существует!';
        }
    } else {
        $error = 'Пожалуйста, заполните все поля!';
    }
}

$pageTitle = 'Регистрация';
require 'header.php';
?>

<h1 class="mb-4 text-center">Регистрация</h1>

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
    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
</form>

<?php
require 'footer.php';
