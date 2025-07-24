<?php session_start(); ?>
<ul>
  <li><a href="index.php">Главная</a></li>
  <li><a href="catalog.php">Каталог</a></li>
  <li><a href="contact.php">Обратная связь</a></li>
  <li><a href="cart.php">Корзина</a></li>
  <?php if (isset($_SESSION['user'])): ?>
    <li><a href="profile.php">Личный кабинет</a></li>
    <li><a href="logout.php">Выход</a></li>
  <?php else: ?>
    <li><a href="auth.php">Личный кабинет</a></li>
  <?php endif; ?>
  </ul>
