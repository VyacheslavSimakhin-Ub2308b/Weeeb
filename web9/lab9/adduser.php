<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Доступ запрещён!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);

    if ($stmt->fetchColumn() > 0) {
        die("Логин уже существует. Выберите другой.");
    }

    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
    $stmt->execute(['username' => $username, 'password' => $password, 'role' => $role]);

    echo "Новый пользователь добавлен!";
    header('Location: admin.php');
    exit;
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление нового пользователя</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: black;
            color: white;
            font-family: 'Orbitron', sans-serif;
        }
        h1 {
            text-align: center;
        }
        form {
            width: 300px;
            margin: 0 auto;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #fff;
            background-color: black;
            color: white;
        }
        button {
            background-color: white;
            color: black;
            border: none;
        }
        button:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<h1>Добавление нового пользователя</h1>
<form method="post">
    <label for="username">Логин:</label>
    <input type="text" name="username" id="username" required><br><br>

    <label for="password">Пароль:</label>
    <input type="password" name="password" id="password" required><br><br>

    <label for="role">Роль:</label>
    <select name="role" id="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select><br><br>

    <button type="submit">Добавить пользователя</button>
</form>

</body>
</html>
