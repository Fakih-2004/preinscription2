<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" type="image/png" href="{{ asset('dist/assets/img/logo-fsdm-fes.png') }}">

    <title>FST Fès - Accueil</title>
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/form-style.css') }}" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Nunito Sans', 'Verdana', sans-serif;
            background-color: #f4f7fa;
            color: #333;
        }

        /* Styles pour l'en-tête */
        .header {
            background-color: #1a4b8c;
            color: #FFFFFF;
            padding: 1rem 2rem;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .header .logo {
            height: 50px;
            width: auto;
        }

        .header .site-title {
            font-size: 1.5rem;
            margin: 0;
            font-weight: bold;
        }

        .header .site-subtitle {
            font-size: 0.9rem;
            margin: 0;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 0.5rem;
            }

            .header .site-title {
                font-size: 1.2rem;
            }

            .header .site-subtitle {
                font-size: 0.8rem;
            }

            .header .logo {
                height: 40px;
            }
        }

        /* Styles pour le contenu de la page d'index */
        .main-content {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .welcome-section {
            background: #FFFFFF;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .welcome-section h2 {
            color: #1a4b8c;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .welcome-section p {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .cta-button {
            background-color: #1a4b8c;
            color: #FFFFFF;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1.1rem;
            transition: background-color 0.3s;
        }

        .cta-button:hover {
            background-color: #1a4b8c;
        }

        /* Styles pour le pied de page */
        html, body {
    height: 100%;
    margin: 0;
}

body {
    display: flex;
    flex-direction: column;
}

.main-content {
    flex: 1; /* This will allow the content to take the remaining space */
}

footer {
    margin-top: auto; /* Push the footer to the bottom */
    background-color: #1a4b8c;
    color: #FFFFFF;
    text-align: center;
    padding: 1rem 0;
}

        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <header class="header">
        <div class="header-content">
            <img src="{{ asset('dist/assets/img/fst.png') }}"  class="logo">
            <div class="title-section">
                <h1 class="site-title">Faculté des Sciences et Techniques - Fès</h1>
                <p class="site-subtitle">Préinscription en ligne {{ date('Y') }} </p>
            </div>
        </div>
    </header>

     @yield('content')
    <!-- Pied de page -->
    <footer>
        <p>© {{ date('Y') }} Faculté des Sciences et Techniques - Fès. Tous droits réservés.</p>
    </footer>

    @livewireScripts
</body>
</html>