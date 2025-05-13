<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation d'inscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #FFFFFF;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #004aad;
            color: #FFFFFF;
            padding: 15px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .content h1 {
            font-size: 24px;
            margin-bottom: 15px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Faculté des Sciences et Techniques - Fès</h2>
        </div>
        <div class="content">
            <h1>Confirmation d'inscription</h1>
            <p>Bonjour {{ $candidateName }},</p>
            <p>
                Nous avons bien reçu votre demande d'inscription pour l'année académique {{ date('Y') }}. 
                Votre dossier est en cours de traitement, et nous vous contacterons prochainement pour la suite du processus.
            </p>
            <p>Merci de votre confiance en la FST Fès !</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} FST Fès. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>