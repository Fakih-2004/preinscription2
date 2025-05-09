<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand px-4 py-3 m-0" href="#">
      <img src="{{ asset('dist/assets/img/logo-fsdm-fes.png') }}" 
           class="navbar-brand-img" 
           style="max-height: 40px; width: auto;" 
           alt="main_logo">
      <span class="ms-2 font-weight-bold">Pré-Inscription</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0 mb-2">
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-dark {{ request()->routeIs('administrateurs.*') ? 'active' : '' }}" href="{{ route('administrateurs.index') }}">
          <i class="material-symbols-rounded opacity-5">admin_panel_settings</i>
          <span class="nav-link-text ms-1">Administrateurs</span>
        </a>
      </li> 
      <li class="nav-item">
        <a class="nav-link text-dark {{ request()->routeIs('formations.*') ? 'active' : '' }}" href="{{ route('formations.index') }}">
          <i class="material-symbols-rounded opacity-5">receipt_long</i>          <span class="nav-link-text ms-1">Formations</span>
        </a>
      </li> 
      <li class="nav-item">
        <a class="nav-link text-dark {{ request()->routeIs('candidats.*') ? 'active' : '' }}" href="{{ route('candidats.index') }}">
          <i class="material-symbols-rounded opacity-5">group</i>
          <span class="nav-link-text ms-1">Candidats</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark {{ request()->routeIs('formation-stats') ? 'active' : '' }}" href="{{ route('formation-stats') }}">
          <i class="material-symbols-rounded opacity-5">bar_chart</i>
          <span class="nav-link-text ms-1">Statistiques des Formations</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark {{ request()->routeIs('diplomes.*') ? 'active' : '' }}" href="{{ route('diplomes.index') }}">
          <i class="material-symbols-rounded opacity-5">school</i>
          <span class="nav-link-text ms-1">Diplômes</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark {{ request()->routeIs('experiences.*') ? 'active' : '' }}" href="{{ route('experiences.index') }}">
          <i class="material-symbols-rounded opacity-5">work</i>
          <span class="nav-link-text ms-1">Expériences</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark {{ request()->routeIs('stages.*') ? 'active' : '' }}" href="{{ route('stages.index') }}">
          <i class="material-symbols-rounded opacity-5">business_center</i>
          <span class="nav-link-text ms-1">Stages</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark {{ request()->routeIs('attestations.*') ? 'active' : '' }}" href="{{ route('attestations.index') }}">
          <i class="material-symbols-rounded opacity-5">description</i>
          <span class="nav-link-text ms-1">Attestations</span>
        </a>
      </li>
    </ul>
  </div>
</aside>