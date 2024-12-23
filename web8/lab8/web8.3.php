<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $fio = $_POST['fio'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];

   
    if (empty($fio) || empty($login) || empty($password) || empty($dob)) {
        echo "<p style='color: red;'>Пожалуйста, заполните все поля.</p>";
    } else {
        
        echo "<p style='color: white;'>Регистрация успешна! Добро пожаловать, $fio!</p>";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация пользователя</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: black;
            color: white;
            font-family: 'Orbitron', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #222;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.7);
            width: 300px;
        }
        h1 {
            text-align: center;
            color: white;
        }
        label {
            color: white;
        }
        input[type="text"], input[type="password"], input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #fff;
            background-color: #333;
            color: white;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: white;
            color: black;
            border: none;
            padding: 15px 20px;
            width: 100%;
            cursor: pointer;
            border-radius: 5px;
            font-family: 'Orbitron', sans-serif;
        }
        input[type="submit"]:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Регистрация</h1>
    <form action="" method="post">
        <label for="fio">ФИО:</label>
        <input type="text" id="fio" name="fio" required>

        <label for="login">Логин:</label>
        <input type="text" id="login" name="login" required>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>

        <label for="dob">Дата рождения:</label>
        <input type="date" id="dob" name="dob" required>

        <input type="submit" value="Зарегистрироваться">
    </form>
</div>

</body>
</html>