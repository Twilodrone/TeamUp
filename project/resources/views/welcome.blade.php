<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Добро пожаловать!</h1>
        <p>Пожалуйста, войдите в систему, чтобы продолжить.</p>
        <a href="{{ route('login') }}" class="btn btn-primary">Войти</a>
        <a href="{{ route('register') }}" class="btn btn-secondary ml-2">Зарегистрироваться</a>
    </div>
</body>
</html>
