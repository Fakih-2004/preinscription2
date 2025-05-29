<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation d’inscription</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12pt; color: #333; margin: 20px; }
        h1 { font-size: 18pt; color: #2c3e50; text-align: center; }
        h2 { font-size: 14pt; color: #2c3e50; }
        h3 { font-size: 12pt; }
        ul { list-style: none; padding: 0; }
        li { margin-bottom: 8px; }
        .section { margin-bottom: 20px; }
        .footer { font-size: 10pt; color: #666; text-align: center; }
        p { margin: 10px 0; }
    </style>
</head>
<body>
    <h1>Confirmation d’inscription - FST USMBA</h1>
    <p>Bonjour {{ $candidatName }},</p>
    <p>Voici le récapitulatif de votre inscription :</p>

    <div class="section">
        <h2>Informations personnelles</h2>
        <ul>
            <li><strong>Nom</strong>: {{ $personalInfo['nom'] ?? 'Non renseigné' }}</li>
            <li><strong>Prénom</strong>: {{ $personalInfo['prenom'] ?? 'Non renseigné' }}</li>
            <li><strong>Email</strong>: {{ $personalInfo['email'] ?? 'Non renseigné' }}</li>
            <li><strong>Téléphone</strong>: {{ $personalInfo['telephone'] ?? 'Non renseigné' }}</li>
            <li><strong>CNE</strong>: {{ $personalInfo['CNE'] ?? 'Non renseigné' }}</li>
            <li><strong>CIN</strong>: {{ $personalInfo['CIN'] ?? 'Non renseigné' }}</li>
            <li><strong>Date de naissance</strong>: {{ $personalInfo['date_naissance'] ?? 'Non renseigné' }}</li>
            <li><strong>Ville de naissance</strong>: {{ $personalInfo['ville_naissance'] ?? 'Non renseigné' }}</li>
            <li><strong>Nationalité</strong>: {{ $personalInfo['nationalite'] ?? 'Non renseigné' }}</li>
            <li><strong>Sexe</strong>: {{ $personalInfo['sex'] ?? 'Non renseigné' }}</li>
            <li><strong>Adresse</strong>: {{ $personalInfo['adresse'] ?? 'Non renseigné' }}</li>
            <li><strong>Ville</strong>: {{ $personalInfo['ville'] ?? 'Non renseigné' }}</li>
            <li><strong>Pays</strong>: {{ $personalInfo['pays'] ?? 'Non renseigné' }}</li>
        </ul>
    </div>

    <div class="section">
        <h2>Diplômes</h2>
        @if (empty($diplomas))
            <p>Aucun diplôme obtenu.</p>
        @else
            @foreach ($diplomas as $diploma)
                <h3>{{ $diploma['type'] ?? 'Diplôme' }}</h3>
                <ul>
                    <li><strong>Filière</strong>: {{ $diploma['filiere'] ?? 'Non renseigné' }}</li>
                    <li><strong>Année</strong>: {{ $diploma['annee'] ?? 'Non renseigné' }}</li>
                    <li><strong>Établissement</strong>: {{ $diploma['etablissement'] ?? 'Non renseigné' }}</li>
                </ul>
            @endforeach
        @endif
    </div>

    <div class="section">
        <h2>Stages</h2>
        @if (empty($stages))
            <p>Aucun stage effectué.</p>
        @else
            @foreach ($stages as $stage)
                <h3>Stage {{ $loop->iteration }}</h3>
                <ul>
                    <li><strong>Fonction</strong>: {{ $stage['fonction'] ?? 'Non renseigné' }}</li>
                    <li><strong>Établissement</strong>: {{ $stage['etablissement'] ?? 'Non renseigné' }}</li>
                    <li><strong>Période</strong>: {{ $stage['periode'] ?? 'Non renseigné' }}</li>
                    <li><strong>Secteur d’activité</strong>: {{ $stage['secteur_activite'] ?? 'Non renseigné' }}</li>
                    <li><strong>Description</strong>: {{ $stage['description'] ?? 'Non renseigné' }}</li>
                </ul>
            @endforeach
        @endif
    </div>

    <div class="section">
        <h2>Expériences professionnelles</h2>
        @if (empty($experiences))
            <p>Aucune expérience professionnelle.</p>
        @else
            @foreach ($experiences as $experience)
                <h3>{{ $experience['fonction'] ?? 'Expérience' }}</h3>
                <ul>
                    <li><strong>Établissement</strong>: {{ $experience['etablissement'] ?? 'Non renseigné' }}</li>
                    <li><strong>Période</strong>: {{ $experience['periode'] ?? 'Non renseigné' }}</li>
                    <li><strong>Secteur d’activité</strong>: {{ $experience['secteur_activite'] ?? 'Non renseigné' }}</li>
                    <li><strong>Description</strong>: {{ $experience['description'] ?? 'Non renseigné' }}</li>
                </ul>
            @endforeach
        @endif
    </div>

    <div class="section">
        <h2>Attestations</h2>
        @if (empty($attestations))
            <p>Aucune attestation fournie.</p>
        @else
            @foreach ($attestations as $attestation)
                <h3>{{ $attestation['type_attestation'] ?? 'Attestation' }}</h3>
                <ul>
                    <li><strong>Type</strong>: {{ $attestation['type_attestation'] ?? 'Non renseigné' }}</li>
                    <li><strong>Description</strong>: {{ $attestation['description'] ?? 'Non renseigné' }}</li>
                </ul>
            @endforeach
        @endif
    </div>

    <div class="footer">
        <p>Veuillez vérifier ces informations. En cas d’erreur, contactez <a href="mailto:support@fst-usmba.ac.ma">support@fst-usmba.ac.ma</a>.</p>
        <p>FST - Université Sidi Mohamed Ben Abdellah, Fès</p>
    </div>
</body>
</html>