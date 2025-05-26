<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('dist/assets/img/logo-fsdm-fes.png') }}">
    <title>FST Fès - Connexion</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #1a2a6c; /* Darker blue */
            --secondary-color: #eab9b9; /* Darker red/purple */
            --accent-color: #4CAF50; /* A contrasting green for accent */
            --button-hover: #e0e0e0; /* Lighter grey for button hover */
            --text-light: rgba(255, 255, 255, 0.9);
            --text-muted: rgba(255, 255, 255, 0.6); /* Slightly more muted */
            --glass-background: rgba(0, 0, 0, 0.3); /* Darker glass effect */
            --glass-border: rgba(255, 255, 255, 0.1); /* Subtler border */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            background-size: 200% 200%;
            animation: gradientAnimation 15s ease infinite;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 10px;
            position: relative; /* Needed for absolute positioning of icons */
            overflow: hidden; /* Hide overflowing animations */
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .login-container {
            width: 100%;
            max-width: 380px;
            background: var(--glass-background); /* Darker glass background */
            backdrop-filter: blur(10px); /* Slightly more blur */
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); /* Darker shadow */
            border: 1px solid var(--glass-border); /* Subtler border */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            z-index: 10; /* Ensure container is above background icons */
            position: relative; /* For potential pseudo-elements if needed */
        }

        .login-container:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.4);
        }

        .institution-logo {
            width: 70px;
            height: 70px;
            margin: 0 auto 15px;
            display: block;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08); /* Even subtler background */
            padding: 10px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: transform 0.3s ease-in-out;
        }

        .institution-logo:hover {
            transform: rotate(10deg) scale(1.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .login-header h1 {
            color: white;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .login-header p {
            color: var(--text-muted);
            font-size: 13px;
            margin: 0;
        }

        .form-group {
            margin-bottom: 18px;
            position: relative;
        }

        .form-label {
            color: var(--text-light);
            font-size: 13px;
            margin-bottom: 6px;
            display: block;
            font-weight: 500;
            transition: color 0.2s ease-in-out;
        }

        .input-group {
            display: flex;
            align-items: center;
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.15); /* Subtler border */
            transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .input-group:focus-within {
            border-color: var(--accent-color);
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.4); /* Accent color for focus shadow */
        }

        .input-icon {
            padding: 10px 12px;
            background: rgba(255, 255, 255, 0.08); /* Subtler background for icon */
            color: var(--text-muted);
            font-size: 14px;
            transition: color 0.3s ease-in-out, background-color 0.3s ease-in-out;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            background: transparent;
            border: none;
            color: white;
            font-size: 13px;
            transition: color 0.3s ease-in-out;
        }

        .form-control::placeholder {
            color: var(--text-muted);
            transition: color 0.3s ease-in-out;
        }

        .form-control:focus {
            outline: none;
        }

        .password-toggle {
            padding: 10px;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 14px;
            transition: color 0.3s ease-in-out, transform 0.2s ease-in-out;
        }

        .password-toggle:hover {
            color: var(--accent-color);
            transform: scale(1.1);
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            margin: 15px 0;
        }

        .checkbox-container input {
            margin-right: 8px;
            accent-color: var(--accent-color);
        }

        .checkbox-container label {
            color: var(--text-muted);
            font-size: 13px;
        }

        .btn-login {
            width: 100%;
            padding: 10px;
            background: white;
            border: none;
            border-radius: 6px;
            color: var(--primary-color); /* Button text color remains primary color */
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out, transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            margin: 10px 0;
        }

        .btn-login:hover {
            background: var(--accent-color); /* Button hover to accent color */
            color: white; /* Text color on hover */
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-login:active {
            transform: scale(1);
        }

        .forgot-password {
            text-align: center;
            margin-top: 15px;
            transition: transform 0.2s ease-in-out;
        }

        .forgot-password:hover {
            transform: translateY(-1px);
        }

        .forgot-password a {
            color: var(--text-muted);
            font-size: 12px;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .forgot-password a:hover {
            text-decoration: underline;
            color: var(--accent-color);
        }

        /* --- Background Icons (new) --- */
        .background-icons {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 1; /* Below the login container */
            pointer-events: none; /* Allows clicks to pass through */
        }

        .university-icon {
            position: absolute;
            font-family: 'Font Awesome 6 Free'; /* Ensure Font Awesome is loaded */
            font-weight: 900; /* For solid icons */
            color: rgba(255, 255, 255, 0.05); /* Very faint white */
            font-size: 80px; /* Base size */
            animation: floatAndFade 20s infinite ease-in-out;
        }

        .university-icon.icon-cap::before {
            content: "\f19d"; /* Unicode for graduation cap icon */
        }

        /* Define specific sizes and positions for background icons */
        .university-icon:nth-child(1) {
            top: 5%;
            left: 15%;
            font-size: 120px;
            animation-duration: 20s;
            animation-delay: 0s;
        }
        .university-icon:nth-child(5) {
            top: 25%;
            left:8%;
            font-size: 220px;
            animation-duration: 20s;
            animation-delay: 0s;
        }.university-icon:nth-child(6) {
            top: 5%;
            right: 5%;
            font-size: 70px;
            animation-duration: 20s;
            animation-delay: 3s;
        }

        .university-icon:nth-child(2) {
            bottom: 10%;
            right: 20%;
            font-size: 100px;
            animation-duration: 22s;
            animation-delay: 2s;
        }

        .university-icon:nth-child(3) {
            top: 40%;
            left: 5%;
            font-size: 70px;
            animation-duration: 18s;
            animation-delay: 4s;
        }

        .university-icon:nth-child(4) {
            bottom: 25%;
            left: 30%;
            font-size: 90px;
            animation-duration: 25s;
            animation-delay: 6s;
        }
        .university-icon:nth-child(5) {
            top: 15%;
            right: 5%;
            font-size: 60px;
            animation-duration: 19s;
            animation-delay: 8s;
        }


     
    </style>
</head>
<body>
    <div class="background-icons">
        <div class="university-icon icon-cap"></div>
        <div class="university-icon icon-cap"></div>
        <div class="university-icon icon-cap"></div>
        <div class="university-icon icon-cap"></div>
        <div class="university-icon icon-cap"></div>
        <div class="university-icon icon-cap"></div>
    </div>

    <div class="login-container">
        <div class="login-header">
            <img src="{{ asset('dist/assets/img/logo-fsdm-fes.png') }}" alt="FST Fès Logo" class="institution-logo">
            <h1>Connexion – Préinscription 2025</h1>
            <p>Accédez à votre espace personnel</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Adresse Email</label>
                <div class="input-group">
                    <span class="input-icon"><i class="fas fa-envelope"></i></span>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Votre adresse email">
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mot de passe</label>
                <div class="input-group">
                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                    <input id="password" type="password" class="form-control" name="password" required placeholder="Votre mot de passe"  onfocus="if(this.value==='········') this.value=''">
                    <i class="password-toggle fas fa-eye" onclick="togglePassword()"></i>
                </div>
            </div>

            <button type="submit" class="btn-login">Se connecter</button>

            

            <div class="forgot-password">
                <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
            </div>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>