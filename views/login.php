<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>Авторизация</title>
</head>
<body>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <div class="container">
        <h2 class="mt-5">Авторизация</h2>
        <form id="loginForm">
            <div class="mb-3">
                <label for="username" class="form-label">Логин</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>
    <script src="/js/bootstrap.bundle.js"></script>
    <script>
        async function login(username, password) {
            try {
                const response = await fetch('/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ username, password })
                });

                const data = await response.json();

                console.log(data)

                if (response.ok) {
                    const token = data.token;
                    localStorage.setItem('token', token);
                    window.location.href = '/dashboard'
                } else {
                    console.error('Ошибка авторизации:', data.message);
                }
            } catch (error) {
                console.error('Произошла ошибка при авторизации:', error);
            }
        }

        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            console.log(username)
            console.log(password)
            login(username, password);
        });
    </script>
</body>
</html>