<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);

    if ($stmt->fetchColumn() > 0) {
        $error = "Логин уже существует. Выберите другой.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
        $stmt->execute(['username' => $username, 'password' => $password, 'role' => $role]);

        header('Location: login.php');
        exit;
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet"> 
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #121212; 
            color: white;
            font-family: 'Poppins', sans-serif; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        h1 {
            font-size: 32px;
            color: #ff7f50; 
            margin-bottom: 20px;
            text-align: center;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background-color: rgba(0, 0, 0, 0.85);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
        }

        label {
            font-size: 16px;
            margin-bottom: 5px;
            display: block;
        }

        input, select, button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #fff;
            background-color: #333;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        input:focus, select:focus, button:focus {
            outline: none;
            background-color: #444;
        }

        button {
            background-color: #ff7f50; 
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #e67e22; 
            transform: translateY(-2px); 
        }

        .error {
            color: #f44336; 
            font-size: 16px;
            margin-bottom: 20px;
            text-align: center;
        }

        .login-link {
            margin-top: 20px;
            text-align: center;
            font-size: 16px;
        }

        .login-link a {
            color: #ff7f50;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 30px;
            }

            h1 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Регистрация</h1>
    
    <?php if (isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <label for="username">Логин:</label>
        <input type="text" name="username" id="username" placeholder="Введите логин" required>

        <label for="password">Пароль:</label>
        <input type="password" name="password" id="password" placeholder="Введите пароль" required>

        <label for="role">Роль:</label>
        <select name="role" id="role" required>
            <option value="user">Пользователь</option>
            <option value="admin">Администратор</option>
        </select>

        <button type="submit">Зарегистрироваться</button>
    </form>

    <div class="login-link">
        <p>Уже зарегистрированы? <a href="login.php">Войдите здесь</a></p>
    </div>
</div>

</body>
</html>
