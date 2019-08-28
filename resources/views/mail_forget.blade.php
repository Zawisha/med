<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Активация регистрации нового ползователя</title>
</head>
<body>
<h1>Спасибо за регистрацию! </h1>

<p>
    Перейдите <a href='{{ url("http://localhost/renew_password/{$id}/{$token}") }}'>по ссылке </a>для восстановления пароля!
</p>
</body>
</html>
