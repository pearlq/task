<?php

use models\User;

$user = (new User())->getById($_GET['user_id']);

if (!$user) {
    echo "Пользователь не найден";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/token_validate.js" defer></script>
    <title>Редактировать пользователя</title>
</head>
<body>
<?php
require '../views/layout/header.php';
?>
<h1>Редактировать пользователя</h1>
<form action=/user/update method=POST>
    <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
    <label for="full_name">Имя:</label>
    <input type="text" id="full_name" name="full_name" value="<?php echo $user['full_name'] ?>">
    <br>
    <label for="login">Логин:</label>
    <input type="text" id="login" name="login" value="<?php echo $user['login'] ?>">
    <br>
    <label for="role_id">Роль:</label>
    <select name="role_id" id="role_id">
        <option value="1">Администратор</option>
        <option value="2">Менеджер</option>
    </select>
    <br>
    <input type="submit" value="Обновить">
</form>
</body>
</html>