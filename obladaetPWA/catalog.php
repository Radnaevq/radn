<?php include('db.php'); include('nav.php'); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Каталог</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Каталог</h2>
  <?php
  $result = $conn->query("SELECT * FROM products");
  while ($row = $result->fetch_assoc()): ?>
    <div class="product">
      <img src="img/<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
      <h3><?= $row['name'] ?></h3>
      <p><?= $row['price'] ?> руб.</p>
      <form action="cart.php" method="post">
        <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
        <button type="submit">В корзину</button>
      </form>
    </div>
  <?php endwhile; ?>
</body>
</html>
