<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/token_validate.js" defer></script>
    <title>Добавить товар</title>
</head>
<body>

<?php
require '../views/layout/header.php';
?>
<?php if (!empty($error)): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>
<div class="container">
    <h2 class="mt-5">Добавить товар</h2>
    <form action="/product/create" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Наименование</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Введите название товара" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Введите описание товара" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Цена</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="Цена" required>
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>
</body>
</html>