<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('dist/assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('dist/assets/img/fst.png') }}">
  <title>PreInscription FST</title>

  @livewireStyles
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="{{ asset('dist/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('dist/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link id="pagestyle" href="{{ asset('dist/assets/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />

  <style>
    body {
      background-color: #f1f2f6;
      font-family: 'Inter', sans-serif;
    }

    #layout-wrapper {
      display: flex;
      min-height: 100vh;
    }

    #sidenav-main {
      width: 250px;
      transition: all 0.3s ease;
      padding-top: 1rem;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
      border-radius: 0 10px 10px 0;
    }

    #sidenav-main.collapsed {
      transform: translateX(-100%);
      width: 0;
      margin-left: 0;
      overflow: hidden;
    }

    #main-content {
      transition: all 0.3s ease;
      width: 100%;
    }

    .nav-link {
      padding: 12px 20px;
      border-radius: 10px;
      margin-bottom: 5px;
      transition: background 0.2s ease;
    }

    .nav-link:hover {
      background-color: #0d3a73;
      color: white !important;
    }

    .navbar,
    .btn-primary,
    .sidebar-header {
      background-color: #0d3a73;
      color: white;
    }

    

    /* Responsive Sidebar */
    @media (max-width: 900px) {
      #sidenav-main {
        position: fixed;
        left: -250px;
        z-index: 1031;
      }

      #sidenav-main.sidebar-visible {
        left: 0;
      }

      .sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1030;
        display: none;
      }
    }

    @media (min-width: 901px) {
      #main-content {
        width: calc(100% - 250px);
      }
    }
  </style>
</head>

<body class="bg-gray-100">
  <div class="d-flex">
    <!-- Sidebar -->
    <aside id="sidenav-main" class="sidenav bg-white" style="width: 230px ;min-height: 100vh;" >
      @include('utilisateur.layouts.sidebar')
    </aside>

    <!-- Main Content -->
    <main id="main-content" class="flex-grow-1">
      @include('utilisateur.layouts.header')
      @yield('content')
    </main>
  </div>

  <!-- Overlay for mobile -->
  <div class="sidebar-overlay"></div>

  @livewireScripts
  @stack('scripts')
  @include('utilisateur.layouts.script')

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const toggleBtn = document.getElementById('toggleSidebarBtn');
      const sidebar = document.getElementById('sidenav-main');
      const overlay = document.querySelector('.sidebar-overlay');

      if (window.innerWidth <= 900) {
        sidebar.classList.remove('sidebar-visible');
      }

      function toggleSidebar() {
        sidebar.classList.toggle('sidebar-visible');
        overlay.style.display = sidebar.classList.contains('sidebar-visible') ? 'block' : 'none';
      }

      toggleBtn?.addEventListener('click', toggleSidebar);
      overlay?.addEventListener('click', toggleSidebar);

      window.addEventListener('resize', function () {
        if (window.innerWidth > 900) {
          sidebar.classList.add('sidebar-visible');
          overlay.style.display = 'none';
        }
      });
    });
  </script>
</body>

</html>
