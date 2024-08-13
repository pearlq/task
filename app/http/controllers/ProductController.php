<?php

namespace controllers;

use models\Product;

require_once '../app/http/models/Product.php';
require_once '../app/http/controllers/Controller.php';

class ProductController extends Controller
{
    private Product $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function getProductsView(): void
    {
        $data = $this->product->getProductList();

        function render($view, $data): void
        {
            extract($data);
            require_once $view;
        }

        render('../views/product/list.php', $data);
    }

    public function getCreateProductView(): void
    {
        require_once '../views/product/create.php';
    }

    public function updateProductView(): void
    {
        require_once '../views/product/update.php';
    }

    public function createProduct(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];

            if ($this->product->create($name, $description, $price)) {
                $this->sendResponse(
                    "Товар успешно создан",
                    '<br><a href="/products">Вернуться к списку товаров</a>'
                );
            } else {
                $this->sendError("Ошибка при создании товара");
            }
        }
    }

    public function updateProduct(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];

            if ($this->product->update($id, $name, $description, $price)) {
                $this->sendResponse(
                    "Товар успешно обновлен",
                    '<br><a href="/products">Вернуться к списку товаров</a>'
                );
            } else {
                $this->sendError("Ошибка при обновлении товара");
            }
        }
    }

    public function deleteProduct(): void
    {
        $id = $_GET['product_id'];
        if ($this->product->delete($id)) {
            $this->sendResponse(
                "Товар успешно удален",
                '<br><a href="/products">Вернуться к списку товаров</a>'
            );
        } else {
            $this->sendError("Ошибка при удалении товара");
        }

    }
}