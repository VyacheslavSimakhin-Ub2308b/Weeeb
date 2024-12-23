<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet"> 
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: black;
            color: white;
            font-family: 'Poppins', sans-serif; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
            padding: 20px;
        }
        .container {
            width: 100%;
            max-width: 600px;
            background-color: rgba(0, 0, 0, 0.85); 
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
            transition: transform 0.3s ease-in-out;
        }
        .container:hover {
            transform: scale(1.02);
        }
        h1 {
            font-size: 32px;
            margin-bottom: 20px;
            font-weight: 600;
            color: #ff7f50; 
        }
        p {
            font-size: 18px;
            color: #ccc;
            margin-bottom: 30px;
        }
        a {
            display: inline-block;
            text-align: center;
            color: black;
            background-color: white;
            padding: 15px 30px;
            border-radius: 8px;
            margin-top: 20px;
            text-decoration: none;
            font-size: 18px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        a:hover {
            background-color: #ddd;
            transform: translateY(-3px);
        }
        .logout {
            background-color: red;
            color: white;
            padding: 15px 30px;
            border-radius: 8px;
            margin-top: 30px;
            font-size: 18px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .logout:hover {
            background-color: #e74c3c;
            transform: translateY(-2px);
        }
        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 25px;
            }
            h1 {
                font-size: 28px;
            }
            p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Панель управления</h1>

    <p>Добро пожаловать, <?php echo $_SESSION['user']['username']; ?>!</p>

    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
        <a href="admin.php" class="button">Админ панель</a>
    <?php else: ?>
        <a href="edit.php" class="button">Редактировать профиль</a>
    <?php endif; ?>

    <a href="logout.php" class="logout">Выйти</a>
</div>

</body>
</html>

