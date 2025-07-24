<?php 
include 'db.php';
include 'nav.php';

if (!isset($_SESSION['user'])) {
    header("Location: auth.php");
    exit();
}

$user_id = $_SESSION['user']['id'];
$user_data = $conn->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
$_SESSION['user'] = $user_data;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Личный кабинет</title>
  <link rel="stylesheet" href="style.css">
 
</head>
<body>
  <div class="profile-header">
    <img src="img/profile.jpg" alt="Фото профиля">
    <h1>Wassup, <?= htmlspecialchars($_SESSION['user']['username']) ?>!</h1>
  </div>
  
  <div class="profile-actions">
    <a href="cart.php" class="button">Перейти в корзину</a>
    <a href="logout.php" class="button">Выйти</a>
  </div>
</body>
</html>
