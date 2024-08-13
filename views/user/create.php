<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/token_validate.js" defer></script>
    <title>Создание нового пользователя</title>
</head>
<body>
<?php
require '../views/layout/header.php';
?>
<h2>Создание нового пользователя</h2>
<?php if (!empty($error)): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>
<form action="/user/create" method="post">
    <label for="full_name">Имя пользователя:</label>
    <input type="text" id="full_name" name="full_name" required>
    <br>
    <label for="login">Логин:</label>
    <input type="text" id="login" name="login" required>
    <br>
    <label for="role_id">Роль:</label>
    <select name="role_id" id="role_id">
        <option value="1">Администратор</option>
        <option value="2">Менеджер</option>
    </select>
    <br>
    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit">Добавить</button>
</form>
</body>
</html>