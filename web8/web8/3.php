<!DOCTYPE HTML>
<html>
<head>
    <title>Регистрация пользователя</title>
</head>
<body>

    <h1>Регистрация пользователя</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="fullname">ФИО:</label>
        <input type="text" name="fullname" id="fullname" required><br><br>
        <label for="username">Логин:</label>
        <input type="text" name="username" id="username" required><br><br>
        <label for="password">Пароль:</label>
        <input type="password" name="password" id="password" required><br><br>
        <label for="dob">Дата рождения:</label>
        <input type="date" name="dob" id="dob" required><br><br>
        <input type="submit" value="Зарегистрироваться">
    </form>
    <?php
   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $dob = $_POST['dob'];

      
        echo "<h3>Вы успешно прошли регистрацию!</h3>";
        echo "<p>ФИО: " . $fullname . "</p>";
        echo "<p>Логин: " . $username . "</p>";
        echo "<p>Пароль: " . $password . "</p>";
        echo "<p>Дата рождения: " . $dob . "</p>";
    }
    ?>
</body>
</html>