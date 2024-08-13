<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Дашборд</title>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/token_validate.js" defer></script>
</head>
<body>
<?php
require '../views/layout/header.php';
?>
<div id="container_users" style="width: 100%; height: 400px;"></div>
<div id="container_products" style="width: 100%; height: 400px;"></div>

<script type="text/javascript">
    let userData = <?php if (isset($userData)) echo json_encode($userData); ?>;
    let userCategories = userData.map(function (item) {
        return item.date;
    });
    let userCounts = userData.map(function (item) {
        return item.count;
    });

    // Создание графика
    Highcharts.chart('container_users', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Количество зарегистрированных пользователей за неделю'
        },
        xAxis: {
            categories: userCategories,
            title: {
                text: 'Дата'
            }
        },
        yAxis: {
            title: {
                text: 'Количество пользователей'
            }
        },
        series: [{
            name: 'Количество',
            data: userCounts
        }]
    });
</script>

<script type="text/javascript">
    let productData = <?php if (isset($productData)) echo json_encode($productData); ?>;

    let productCategories = productData.map(function (item) {
        return item.date;
    });
    let productCounts = productData.map(function (item) {
        return item.count;
    });

    Highcharts.chart('container_products', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Количество поступившего товара за неделю'
        },
        xAxis: {
            categories: productCategories,
            title: {
                text: 'Дата'
            }
        },
        yAxis: {
            title: {
                text: 'Количество товара'
            }
        },
        series: [{
            name: 'Количество',
            data: productCounts
        }]
    });
</script>
</body>
</html>