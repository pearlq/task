<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>Список пользователей</title>
    <script src="/js/token_validate.js" defer></script>
</head>
<body>
<?php
require '../views/layout/header.php';
?>
<h2>Список пользователей</h2>
<form action="/user/create" method="get">
    <button type="submit">Добавить</button>
</form>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Логин</th>
        <th>Роль</th>
        <th>Дата регистрации</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($data)) foreach ($data as $user => $item): ?>
        <tr>
            <td><?php echo htmlspecialchars($item['id']); ?></td>
            <td><?php echo htmlspecialchars($item['full_name']); ?></td>
            <td><?php echo htmlspecialchars($item['login']); ?></td>
            <td><?php echo htmlspecialchars($item['role']); ?></td>
            <td><?php echo htmlspecialchars($item['created_at']); ?></td>
            <td>
                <a href="/user/update?user_id=<?php echo $item['id']; ?>">Редактировать</a>
                <a href="javascript: deleteUser('/user/delete?user_id=<?php echo $item['id']; ?>')"
                   class=confirmation>Удалить</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <script>
        function deleteUser(path) {
            fetch(path, {
                method: 'DELETE'
            }).then(() => window.location.reload())
        }
        const elems = document.getElementsByClassName('confirmation');
        const confirmIt = function (e) {
            if (!confirm('Вы уверены?')) e.preventDefault();
        };
        let i = 0, l = elems.length;
        for (; i < l; i++) {
            elems[i].addEventListener('click', confirmIt, false);
        }
    </script>
    </tbody>
</table>
</body>
</html>
