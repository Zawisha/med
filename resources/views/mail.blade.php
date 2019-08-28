<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Активация регистрации нового ползователя</title>
</head>
<body>
<h1>Спасибо за регистрацию! </h1>

<p>
    Перейдите <a href='{{ url("http://localhost/accept/{$token}") }}'>по ссылке </a>чтобы завершить регистрацию!
</p>
</body>
</html>
