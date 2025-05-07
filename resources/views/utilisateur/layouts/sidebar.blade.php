<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
      <!--begin::Brand Link-->
      <a href="./index.html" class="brand-link">
        <!--begin::Brand Image-->
        <img
          src="../../dist/assets/img/AdminLTELogo.png"
          alt="AdminLTE Logo"
          class="brand-image opacity-75 shadow"
        />
        <!--end::Brand Image-->
        <!--begin::Brand Text-->
        <span class="brand-text fw-light">préinscription</span>
        <!--end::Brand Text-->
      </a>
      <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
      <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul
          class="nav sidebar-menu flex-column"
          data-lte-toggle="treeview"
          role="menu"
          data-accordion="false"
        >
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon bi bi-speedometer"></i>
              <p>
                Dashboard
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('administrateurs.index')}}" class="nav-link">
                <i class="bi bi-person-circle"></i>
                    <p>Administrateurs</p>
                </a>
            </li>
            <li class="nav-item">
              <a href="{{route('formations.index')}}" class="nav-link">
              <i class="bi bi-journal-check"></i>
                  <p>Formations</p>
              </a>
          </li>
          <li class="nav-item">
    <a href="{{ route('formation-stats') }}" class="nav-link">
        <i class="bi bi-bar-chart"></i>
        <p>Statistiques des Formations</p>
    </a>
</li>
        <li class="nav-item">
          <a href="{{route('candidats.index')}}" class="nav-link">
          <i class="bi bi-people"></i>
            <p>Candidat</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('diplomes.index')}}" class="nav-link">
          <i class="bi bi-folder2"></i>
              <p>diplome</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('experiences.index')}}" class="nav-link">
          <i class="bi bi-folder2"></i>
              <p>Experiences</p>
          </a>
      </li>
      <li class="nav-item">
        <a href="{{route('stages.index')}}" class="nav-link">
        <i class="bi bi-folder2"></i>
            <p>Stages</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('attestations.index')}}" class="nav-link">
        <i class="bi bi-folder2"></i>
            <p>Attestations</p>
        </a>
      </li>


                


               


                </a>
              </li>




            </ul>
          </li>
          
          
        </ul>
        <!--end::Sidebar Menu-->
      </nav>
    </div>
    <!--end::Sidebar Wrapper-->
  </aside>