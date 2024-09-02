<!DOCTYPE html>
<html>
<head>
    <title>Error 404 - Page Not Found</title>
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
        <h1>Error 404 - Page Not Found</h1>
        <img src="{{ asset('img/404.png') }}">
        <p>Sorry, I couldn't find the page you're looking for. Please check the URL in your browser ...</p>
        <!--  You can add more custom content here -->
    </div>
</body>
</html>
