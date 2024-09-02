<!DOCTYPE html>
<html>
<head>
    <title>Error 403 - Forbidden</title>
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
        <h1>Error 403 - Forbidden</h1>
        <img src="{{ asset('img/403.png') }}">
        <p>Sorry, you do not have permission to access this page.</p>
        <!-- Puedes agregar más contenido personalizado aquí -->
    </div>
</body>
</html>