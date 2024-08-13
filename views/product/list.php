<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="/js/token_validate.js" defer></script>
    <title>Список товаров</title>
</head>
<body>

<?php
require '../views/layout/header.php';
?>
<h2>Список товаров</h2>
<form action="/product/create" method="get">
    <button type="submit">Добавить</button>
</form>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Наименование</th>
        <th>Описание</th>
        <th>Цена</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($data)) foreach ($data as $product => $item): ?>
        <tr>
            <td><?php echo htmlspecialchars($item['id']); ?></td>
            <td><?php echo htmlspecialchars($item['name']); ?></td>
            <td><?php echo htmlspecialchars($item['description']); ?></td>
            <td><?php echo htmlspecialchars($item['price']); ?></td>
            <td>
                <a href="/product/update?product_id=<?php echo $item['id']; ?>">Редактировать</a>
                <a href="javascript: deleteProduct('/product/delete?product_id=<?php echo $item['id']; ?>')"
                   class=confirmation>Удалить</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <script>
        function deleteProduct(path) {
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