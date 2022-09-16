<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" type="text/css" href="{{asset('bootstrap-5.1.3-dist/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/star-rating.css')}}">
	<link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style>
        #redirect
        {
            background-color: #0b5ed7;
            border-radius: 0.25rem;
            padding: 5px;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    
    <form target="_blank" id="form1">
        <h1>
            Recuperar contraseña
        </h1>
        <p>Este email se ha enviado para recuperar la contraseña de tu cuenta en Gestor de Fotos™ con el email.</p>
        <p>Si tú no has solicitado una contraseña nueva, puedes ignorar este correo.</p>
        <p>Si la has solicitado, pulsa en el botón de abajo para crear una nueva contraseña.</p>
        <a href="{{ url('recuperar') }}" id='redirect'>Recuperar</a>
        
    </form>
    <script>
        var dir = ".com";
        var url = "https://stackoverflow" + dir;
        document.getElementById("form1").setAttribute("action", url);
    </script>
</body>
</html>