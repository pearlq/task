<?php

namespace controllers;

use models\User;
use PDOException;

class UserController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function getUserListView(): void
    {
        $data = $this->user->getUserList();

        function render($view, $data): void
        {
            extract($data);
            require $view;
        }

        render('../views/user/list.php', $data);
    }

    public function getCreateUserView(): void
    {
        require_once '../views/user/create.php';
    }

    public function getUpdateUserView(): void
    {
        require_once '../views/user/update.php';
    }

    public function createUser(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = $_POST['login'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $full_name = $_POST['full_name'];
            $role_id = $_POST['role_id'];

            try {
                $this->user->create($login, $password, $full_name, $role_id);
                $this->sendResponse(
                    "Пользователь успешно создан",
                    '<br><a href="/users">Вернуться к списку пользователей</a>'
                );
            } catch (PDOException $e) {
                $error = $e->getMessage();
                $this->getCreateUserView();
            }
        }
    }

    public function updateUser(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $login = $_POST['login'];
            $full_name = $_POST['full_name'];
            $role_id = $_POST['role_id'];

            if ($this->user->update($id, $login, $full_name, $role_id)) {
                $this->sendResponse(
                    "Пользователь успешно обновлен",
                    '<br><a href="/users">Вернуться к списку пользователей</a>'
                );
            } else {
                $this->sendError("Ошибка при обновлении пользователя");
            }
        }
    }

    public function deleteUser(): void
    {
        $id = $_GET['user_id'];
        if ($this->user->delete($id)) {
            $this->sendResponse(
                "Пользователь успешно удален",
                '<br><a href="/users">Вернуться к списку пользователей</a>'
            );
        } else {
            $this->sendError("Ошибка при удалении пользователя");
        }
    }

}