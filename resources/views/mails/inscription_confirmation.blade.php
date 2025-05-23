 <!DOCTYPE html>
<html>
<head>
    <title>Confirmation de l'inscription</title>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        h1 {
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <div class="container">
     <h1>Bienvenue {{ $candidatName}} !</h1>
<p>Merci de vous être inscrit à l'Université FST. Nous sommes ravis de vous accueillir parmi nos candidats.</p>
<p>Votre inscription a été effectuée avec succès dans notre système le {{ now()->format('d/m/Y') }} à {{ now()->format('H:i') }} </p>


    </div>
</body>
</html>
