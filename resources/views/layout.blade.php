<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Laravel Vulnérable</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            padding: 20px;
        }

        nav {
            margin-bottom: 20px;
        }

        nav a {
            margin-right: 15px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        form {
            margin-bottom: 20px;
        }

        input, textarea {
            margin-bottom: 10px;
            display: block;
            width: 100%;
            padding: 8px;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
    <nav>
        <a href="/">Accueil</a>
        <a href="/search">Recherche</a>
        <a href="/comments">Commentaires</a>
        <a href="/profile">Profil</a>
        <a href="/login">Connexion</a>
    </nav>

    @yield('content')
</div>
</body>
</html>
