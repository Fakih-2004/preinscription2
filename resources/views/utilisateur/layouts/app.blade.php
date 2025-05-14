<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('dist/assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('dist/assets/img/logo-fsdm-fes.png') }}">
  <title>PreInscription FST</title>
  @livewireStyles
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('dist/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('dist/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('dist/assets/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">

  @include('utilisateur.layouts.sidebar')

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @include('utilisateur.layouts.header')
    
    <!-- End Navbar -->
    <div class="container-fluid py-2">
      <div class="row min-vh-80">
        @yield('content')
      </div>

      @include('utilisateur.layouts.footer')
    </div>
  </main>

  <div class="fixed-plugin">
    <!-- Fixed plugin content remains the same -->
  </div>
  
  <!-- Core JS Files -->
  @livewireScripts
  @stack('scripts')
  @include('utilisateur.layouts.script')










<!-- SweetAlert2 -->
<script>
/**
 * Global delete confirmation
 * @param {number} id - Item ID
 * @param {HTMLElement} button - Clicked button
 * @param {string} [itemName] - Custom item name for confirmation text
 */
function confirmDelete(id, button, itemName = 'cet élément') {
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: `Voulez-vous vraiment supprimer ${itemName} ? Cette action est irréversible !`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#1a4b8c',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, supprimer !',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = button.closest('form');
            button.disabled = true;
            button.innerHTML = '<i class="material-symbols-rounded">hourglass_top</i>';
            form.submit();
        }
    });
}
</script>







  <!-- Additional script to initialize form inputs -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Initialize Material Dashboard forms
      if (typeof MaterialDashboard !== 'undefined') {
        MaterialDashboard.initFormExtendedDatetimepickers();
      }

      // Initialize input groups
      var inputs = document.querySelectorAll('.input-group.input-group-outline');
      inputs.forEach(function(input) {
        // Add focused class when input is focused
        input.querySelector('input').addEventListener('focus', function() {
          input.classList.add('focused', 'is-focused');
        });
        
        // Remove focused class when input loses focus
        input.querySelector('input').addEventListener('blur', function() {
          if (this.value === '') {
            input.classList.remove('focused', 'is-focused');
          }
        });
        
        // Check if input has value on page load
        if (input.querySelector('input').value !== '') {
          input.classList.add('focused', 'is-focused');
        }
      });
    });
  </script>
</body>
</html>