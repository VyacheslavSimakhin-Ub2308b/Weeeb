<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Доступ запрещён!");
}

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель</title>
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

        .container {
            width: 100%;
            max-width: 900px;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
            transition: transform 0.3s ease-in-out;
        }

        .container:hover {
            transform: scale(1.02);
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
            color: #ff7f50; 
        }

        a {
            display: inline-block;
            text-align: center;
            color: black;
            background-color: white;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 18px;
            margin-top: 20px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        a:hover {
            background-color: #ddd;
            transform: translateY(-3px); 
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 20px;
            text-align: left;
            border: 1px solid #444;
        }

        th {
            background-color: #333;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }

        td {
            background-color: #444;
            color: #ddd;
            font-size: 16px;
        }

        tr:nth-child(even) {
            background-color: #555;
        }

        tr:hover {
            background-color: #666;
        }

        .button {
            color: black;
            background-color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .button:hover {
            background-color: #ddd;
            transform: translateY(-2px); 
        }

        .logout {
            background-color: red;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            margin-top: 30px;
            text-align: center;
            width: 100%;
            font-size: 18px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .logout:hover {
            background-color: #e74c3c; 
            transform: translateY(-2px); 
        }

        .button-container {
            display: flex;
            justify-content: flex-end;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 20px;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Админ панель</h1>

    
    <a href="adduser.php" class="button">Добавить нового пользователя</a>

    
    <table>
        <thead>
            <tr>
                <th>Логин</th>
                <th>Роль</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <td class="button-container">
                        
                        <a href="edit.php?id=<?php echo $user['id']; ?>" class="button">Редактировать</a>
                        <a href="delete.php?id=<?php echo $user['id']; ?>" class="button" onclick="return confirm('Вы уверены, что хотите удалить пользователя?');">Удалить</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    
    <a href="logout.php" class="logout">Выйти</a>
</div>

</body>
</html>

