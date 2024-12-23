<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
        exit;
    } else {
        echo "<div class='error'>Неверный логин или пароль!</div>";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
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

        form {
            width: 100%;
            max-width: 400px;
            background-color: rgba(0, 0, 0, 0.85);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
            text-align: center;
        }

        input, button {
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

        input:focus, button:focus {
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

        .register-link {
            margin-top: 20px;
            font-size: 16px;
            color: white;
            text-align: center;
        }

        .register-link a {
            color: #ff7f50; 
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline; 
        }

        @media (max-width: 768px) {
            form {
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

<div>
    <h1>Вход</h1>
    <form method="post">
        <input type="text" name="username" placeholder="Логин" required><br>
        <input type="password" name="password" placeholder="Пароль" required><br>
        <button type="submit">Войти</button>
    </form>

    <div class="register-link">
        <p>Нет аккаунта? <a href="register.php">Зарегистрируйтесь здесь</a></p>
    </div>
</div>

</body>
</html>
