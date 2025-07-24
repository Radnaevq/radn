<?php include('db.php'); include('nav.php');?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Авторизация</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Вход</h2>
  <form method="post" action="login.php">
    <input type="text" name="username" placeholder="Логин" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <button type="submit">Войти</button>
  </form>

  <h2>Нет аккаунта? Зарегистрироваться</h2>
  <form method="post" action="register.php">
    <input type="text" name="username" placeholder="Логин" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <button type="submit">Зарегистрироваться</button>
  </form>
</body>
</html>