<?php
$role = $_SESSION['role'];
?>
<header>
    <script src="/js/bootstrap.bundle.js"></script>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/dashboard">Дашборд</a>
                    </li>
                    <?php if ($role === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/users">Пользователи</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/products">Товары</a>
                    </li>
                    <li class="nav-item">
                        <button id="logoutButton" class="btn btn-dark">Выход</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const logoutButton = document.getElementById('logoutButton');

            logoutButton.addEventListener('click', function() {
                localStorage.removeItem('token')
                window.location.href = '/login';
            });
        });
    </script>
</header>
