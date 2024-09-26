<!DOCTYPE html>
<html>
<head>
    <title>Error 403 - Prohibido</title>
    <!-- Agrega tus estilos CSS y otros recursos aquí -->
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
        h1, p {
            margin: 0;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Error 403 - Prohibido</h1>
        <img src="{{ asset('img/403.png') }}">
        <p>Lo siento, no tienes permisos para acceder a esta página.</p>
        <!-- Puedes agregar más contenido personalizado aquí -->
    </div>
</body>
</html>