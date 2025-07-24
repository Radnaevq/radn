<?php 
include('db.php');
include('nav.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $message = $conn->real_escape_string($_POST["message"]);
    
    $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
    
    if ($conn->query($sql)) {
        $success = "Ваше сообщение успешно отправлено!";
    } else {
        $error = "Ошибка: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Обратная связь</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Связаться с нами</h2>
  
  <?php if (isset($success)): ?>
    <div class="success"><?= $success ?></div>
  <?php endif; ?>
  
  <?php if (isset($error)): ?>
    <div class="error"><?= $error ?></div>
  <?php endif; ?>
  
  <form method="post">
    <input type="text" name="name" placeholder="Ваше имя" required>
    <input type="email" name="email" placeholder="Email" required>
    <textarea name="message" placeholder="Сообщение" required></textarea>
    <button type="submit">Отправить</button>
  </form>
</body>
</html>