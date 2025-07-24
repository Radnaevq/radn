<?php 
include('db.php'); 
include('nav.php');

if (!isset($_SESSION['user'])) {
    header("Location: auth.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    $user_id = $_SESSION['user']['id'];
    
    $check = $conn->query("SELECT * FROM cart WHERE user_id=$user_id AND product_id=$product_id");
    
    if ($check->num_rows > 0) {
        $conn->query("UPDATE cart SET quantity = quantity + 1 WHERE user_id=$user_id AND product_id=$product_id");
    } else {
        $conn->query("INSERT INTO cart (user_id, product_id) VALUES ($user_id, $product_id)");
    }
}

$user_id = $_SESSION['user']['id'];
$cart_items = $conn->query("
    SELECT p.id, p.name, p.price, p.image, c.quantity 
    FROM cart c 
    JOIN products p ON c.product_id = p.id 
    WHERE c.user_id = $user_id
");

$total = 0;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Корзина</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Корзина</h2>
  
  <?php if ($cart_items->num_rows > 0): ?>
    <table>
      <tr>
        <th>Товар</th>
        <th>Цена</th>
        <th>Количество</th>
        <th>Сумма</th>
      </tr>
      <?php while ($item = $cart_items->fetch_assoc()): 
        $sum = $item['price'] * $item['quantity'];
        $total += $sum;
      ?>
        <tr>
          <td>
            <img src="img/<?= $item['image'] ?>" alt="<?= $item['name'] ?>" width="50">
            <?= $item['name'] ?>
          </td>
          <td><?= $item['price'] ?> руб.</td>
          <td><?= $item['quantity'] ?></td>
          <td><?= $sum ?> руб.</td>
        </tr>
      <?php endwhile; ?>
      <tr>
        <td colspan="3"><strong>Итого:</strong></td>
        <td><strong><?= $total ?> руб.</strong></td>
      </tr>
    </table>
  <?php else: ?>
    <p>Ваша корзина пуста</p>
  <?php endif; ?>
</body>
</html>

