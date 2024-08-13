<?php

use models\Product;

$product = (new Product())->getById($_GET['product_id']);

if (!$product) {
    echo "Товар не найден";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="/js/token_validate.js" defer></script>
    <title>Редактировать товар</title>
</head>
<body>
<?php
require '../views/layout/header.php';
?>
<h1>Редактировать товар</h1>
<form action=/product/update method=POST>
    <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
    <label for="name">Наименование:</label>
    <input type="text" id="name" name="name" value="<?php echo $product['name'] ?>">
    <br>
    <label for="description">Описание:</label>
    <input type="text" id="description" name="description" value="<?php echo $product['description'] ?>">
    <br>
    <label for="price">Цена:</label>
    <input type="text" id="price" name="price" value="<?php echo $product['price'] ?>">
    <br>
    <input type="submit" value="Обновить">
</form>
</body>
</html>