<?php 
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $_POST["password"];
    
    // Проверяем, существует ли пользователь
    $check_user = $conn->query("SELECT * FROM users WHERE username = '$username'");
    
    if ($check_user->num_rows > 0) {
        $error = "Пользователь с таким логином уже существует";
    } else {
        // Хешируем пароль
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
        
        if ($conn->query($sql)) {
            // Автоматический вход после регистрации
            $user_id = $conn->insert_id;
            $_SESSION['user'] = [
                'id' => $user_id,
                'username' => $username
            ];
            header("Location: profile.php");
            exit();
        } else {
            $error = "Ошибка при регистрации: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Регистрация</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="auth-container">
    <h2>Регистрация</h2>
    
    <?php if (isset($error)): ?>
      <div class="error-message"><?= $error ?></div>
    <?php endif; ?>
    
    <form method="post">
      <input type="text" name="username" placeholder="Логин" required>
      <input type="password" name="password" placeholder="Пароль" required>
      <button type="submit">Зарегистрироваться</button>
    </form>
    
    <p>Уже есть аккаунт? <a href="auth.php">Войти</a></p>
  </div>
</body>
</html>