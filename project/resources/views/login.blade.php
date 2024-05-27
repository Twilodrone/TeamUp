<!DOCTYPE html>
<html>
<head>
    <title>Авторизация</title>
</head>
<body>

<h2>Форма авторизации</h2>
<form action="{{ route('login') }}" method="post">
    @csrf
    <div>
        <label for="login">Логин:</label>
        <input type="text" id="login" name="login" required>
    </div>
    <div>
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <input type="submit" value="Войти">
    </div>
</form>

@if ($errors->any())
    <div>
        <strong>Неверный логин или пароль. Попробуйте снова.</strong>
    </div>
@endif

</body>
</html>
