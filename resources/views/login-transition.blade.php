extends('utilisateur.Layouts.app')

@section('title', 'Bienvenue !')

@section('content')
{{-- Check if the 'show_login_transition' session variable is flashed --}}
@if(session('show_login_transition'))
<div id="welcome-overlay">
    <div class="welcome-content">
        {{-- Ensure this path is correct for your logo --}}
        <img src="{{ asset('dist/assets/img/logo-fsdm-fes.png') }}" alt="FST Fès Logo" class="animated-logo">
        <h1 class="welcome-heading">Bienvenue, {{ Auth::user()->name }} !</h1>
        <p class="welcome-subtext">Prêt à explorer votre espace...</p>
        <div class="progress-bar"></div>
    </div>
</div>

<style>
    /* Prevent scrolling during the transition */
    body {
        overflow: hidden;
    }

    #welcome-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        /* Dark gradient background */
        background: linear-gradient(135deg, #1a1a1a, #2c2c2c);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        color: white;
        z-index: 9999; /* Ensure it's on top of all other content */
        opacity: 1;
        transition: opacity 0.5s ease-out; /* Smooth fade-out effect */
    }

    .welcome-content {
        text-align: center;
        opacity: 0;
        /* Animation to fade in the content with a slight delay */
        animation: fadeInContent 0.8s ease-out 0.2s forwards;
    }

    .animated-logo {
        width: 120px; /* Size of the logo */
        height: 120px;
        margin-bottom: 25px;
        border-radius: 50%; /* Makes the logo circular */
        /* Subtle glow effect */
        box-shadow: 0 0 25px rgba(0, 255, 204, 0.4);
        /* Pulsing glow animation */
        animation: pulseGlow 2s infinite alternate ease-in-out;
    }

    .welcome-heading {
        font-size: 3em; /* Large heading for impact */
        color: #00ffcc; /* Accent color */
        margin-bottom: 15px;
        /* Animation to slide in the heading from bottom */
        transform: translateY(20px);
        opacity: 0;
        animation: slideInUp 0.7s ease-out 0.4s forwards;
    }

    .welcome-subtext {
        font-size: 1.2em; /* Subtext size */
        color: rgba(255, 255, 255, 0.8);
        /* Animation to slide in the subtext from bottom */
        transform: translateY(20px);
        opacity: 0;
        animation: slideInUp 0.7s ease-out 0.6s forwards;
    }

    .progress-bar {
        width: 0%; /* Starts at 0 width */
        height: 4px;
        background-color: #00ffcc;
        margin-top: 40px;
        border-radius: 2px;
        /* Animation to fill the progress bar over 2 seconds */
        animation: fillProgressBar 2s linear forwards;
        opacity: 0; /* Starts hidden */
        /* Combined with fadeInContent to make it appear with the rest */
        animation: fillProgressBar 2s linear forwards, fadeInContent 0.5s ease-out 0.8s forwards;
    }

    /* Keyframe Animations */
    @keyframes fadeInContent {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulseGlow {
        0% { box-shadow: 0 0 25px rgba(0, 255, 204, 0.4); }
        100% { box-shadow: 0 0 40px rgba(0, 255, 204, 0.7); }
    }

    @keyframes fillProgressBar {
        0% { width: 0%; opacity: 0; }
        20% { opacity: 1; } /* Make progress bar visible slightly after start */
        100% { width: 100%; opacity: 1; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const overlay = document.getElementById('welcome-overlay');
        // Total time for the animation and before starting the fade-out
        // This should be at least as long as your longest CSS animation (e.g., fillProgressBar is 2s)
        const animationDisplayDuration = 2000; // 2 seconds

        setTimeout(() => {
            overlay.style.opacity = '0'; // Start the CSS fade-out effect for the overlay
            // After the fade-out completes, redirect to the dashboard
            setTimeout(() => {
                window.location.href = "{{ url('/dashboard') }}"; // Redirect to your dashboard route
            }, 500); // This delay should match the CSS transition duration for opacity (0.5s)
        }, animationDisplayDuration);
    });
</script>
@else
    {{-- If 'show_login_transition' is not flashed, immediately redirect to dashboard --}}
    <script>
        window.location.href = "{{ url('/dashboard') }}";
    </script>
@endif
@endsection
