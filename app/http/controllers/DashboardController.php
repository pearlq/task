<?php

namespace controllers;

use models\Product;
use models\User;

class DashboardController
{
    private User $user;
    private Product $product;

    public function __construct()
    {
        $this->user = new User();
        $this->product = new Product();
    }

    public function getDashboardView(): void
    {
        function render($view, $userData, $productData): void
        {
            extract($userData);
            extract($productData);
            require $view;
        }

        $fetchUserDataResult = $this->user->getUserStatistic();
        $userData = [];

        foreach ($fetchUserDataResult as $row) {
            $userData[] = ['date' => $row['date'], 'count' => (int)$row['count']];
        }

        $fetchProductStatisticResult = $this->product->getProductStatistic();
        $productData = [];

        foreach ($fetchProductStatisticResult as $row) {
            $productData[] = ['date' => $row['date'], 'count' => (int)$row['count']];
        }
        render('../views/dashboard.php', $userData, $productData);
    }
}