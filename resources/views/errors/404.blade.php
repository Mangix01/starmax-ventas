<!DOCTYPE html>
<html>
<head>
    <title>Error 404 - Pagina no encontrada</title>
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
        <h1>Error 404 - No encuentro la página</h1>
        <img src="{{ asset('img/404.png') }}">
        <p>Lo siento, no encuentro la página que buscas, revisa la ruta en tu navegador ...</p>
        <!-- Puedes agregar más contenido personalizado aquí -->
    </div>
</body>
</html>
