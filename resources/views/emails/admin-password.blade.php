<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>
  <div style="font-family:Arial,Helvetica,sans-serif;line-height:1.6;color:#111;">
    <h2>Hola {{ $name }},</h2>
    <p>Se ha establecido la contraseña de administrador para la cuenta asociada a <strong>{{ $email }}</strong>.</p>
    <p>Credenciales:</p>
    <ul>
      <li>Email: <strong>{{ $email }}</strong></li>
      <li>Contraseña: <strong>{{ $password }}</strong></li>
    </ul>
    <p>Por seguridad, cambia esta contraseña después de iniciar sesión.</p>
    <p>Saludos,<br>El equipo</p>
  </div>
</body>
</html>
