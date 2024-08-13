<?php
require '../vendor/autoload.php';

use controllers\UserController;
use controllers\AuthController;
use controllers\DashboardController;
use controllers\ProductController;
use core\Router;
use middleware\AuthMiddleware;

$config = require '../config/http.php';

$secret_key = $config['secret_key'];

$request = strtok($_SERVER["REQUEST_URI"], '?');

$router = new Router();
$auth_middleware = new AuthMiddleware($secret_key);

$router->add('/login', function () {
    $controller = new AuthController();

    match ($_SERVER['REQUEST_METHOD']) {
        'GET' => $controller->getLoginView(),
        'POST' => $controller->login(),
    };
});

$router->add('/dashboard', function () use ($auth_middleware) {
    $controller = new DashboardController();
    match ($_SERVER['REQUEST_METHOD']) {
        'GET' => $controller->getDashboardView(),
    };

    $auth_middleware->hasRoles(['admin', 'manager']);
});

$router->add('/users', function () use ($auth_middleware) {
    $controller = new UserController();
    match ($_SERVER['REQUEST_METHOD']) {
        'GET' => $controller->getUserListView(),
    };
    $auth_middleware->hasRoles(['admin']);
});

$router->add('/user/create', function () use ($auth_middleware) {
    $controller = new UserController();
    match ($_SERVER['REQUEST_METHOD']) {
        'GET' => $controller->getCreateUserView(),
        'POST' => $controller->createUser(),
    };
    $auth_middleware->hasRoles(['admin']);
});

$router->add('/user/update', function () use ($auth_middleware) {
    $controller = new UserController();
    match ($_SERVER['REQUEST_METHOD']) {
        'GET' => $controller->getUpdateUserView(),
        'POST' => $controller->updateUser(),
    };
    $auth_middleware->hasRoles(['admin']);
});

$router->add('/user/delete', function () use ($auth_middleware) {
    $controller = new UserController();
    match ($_SERVER['REQUEST_METHOD']) {
        'DELETE' => $controller->deleteUser(),
    };
    $auth_middleware->hasRoles(['admin']);
});

$router->add('/products', function () use ($auth_middleware) {
    $controller = new ProductController();
    match ($_SERVER['REQUEST_METHOD']) {
        'GET' => $controller->getProductsView(),
    };

    $auth_middleware->hasRoles(['admin', 'manager']);

});

$router->add('/product/create', function () use ($auth_middleware) {
    $controller = new ProductController();
    match ($_SERVER['REQUEST_METHOD']) {
        'GET' => $controller->getCreateProductView(),
        'POST' => $controller->createProduct(),
    };
    $auth_middleware->hasRoles(['admin', 'manager']);
});

$router->add('/product/update', function () use ($auth_middleware) {
    $controller = new ProductController();
    match ($_SERVER['REQUEST_METHOD']) {
        'GET' => $controller->updateProductView(),
        'POST' => $controller->updateProduct()
    };
    $auth_middleware->hasRoles(['admin', 'manager']);
});

$router->add('/product/delete', function () use ($auth_middleware) {
    $controller = new ProductController();
    match ($_SERVER['REQUEST_METHOD']) {
        'DELETE' => $controller->deleteProduct(),
    };
    $auth_middleware->hasRoles(['admin', 'manager']);
});
$router->add('/token/validate', function () use ($auth_middleware) {
    $headers = getallheaders();
    $token = isset($headers['Authorization'])
        ? str_replace('Bearer ', '', $headers['Authorization'])
        : null;

    if (!$auth_middleware->handle($token)) {
        return;
    }
});

$router->add('/migration/up', function () {
    $roles = new \database\migrations\CreateRolesTable();
    $users = new \database\migrations\CreateUsersTable();
    $products = new \database\migrations\CreateProductsTable();

    $roles->up();
    $users->up();
    $users->insert();
    $products->up();
});

$router->dispatch($request);