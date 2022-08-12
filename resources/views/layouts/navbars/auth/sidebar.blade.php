<aside class="navbar navbar-vertical navbar-expand-xs fixed-start" style="overflow:hidden;background-color:#0f233a" id="">
  <div class="py-2 mb-4">
    <div class="d-flex justify-content-end mx-2" id="btn-close-sidebar">
      <i class="fa fa-close p-2"></i>
    </div>
    <div>
      <a class="d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <img src="../assets/img/newLogo.png" class="" width="100" alt="logo">
      </a>
    </div>
  </div>
  @if(auth()->user()->role == "admin")
  <div class="d-flex flex-column align-items-center" id="sidenav-collapse-main">
    <ul class="navbar-nav text-ligh">
  @else
  <div class="d-flex align-items-center" id="sidenav-collapse-main">
    <ul class="flex-grow-1 navbar-nav text-ligh">
  @endif

    @if(auth()->user()->role =='admin' || auth()->user()->role =='normal user')
      <li class="nav-item nav_btn">
        <a class="nav-link {{ (Request::is('dashboard') ? 'active' : '') }}" href="{{ url('dashboard') }}">
          <div class="icon-btn icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center {{ (Request::is('dashboard') ? 'bg-dark' : 'bg-white') }} ">
              <i style="font-size: 1rem;" class="fa fa-lg fa-home ps-2 pe-2 text-center {{ (Request::is('dashboard') ? 'text-white' : 'text-dark') }}" aria-hidden="true" ></i>
          </div>
          <span class="nav-link-text ms-1 {{ (Request::is('dashboard') ? 'text-dark' : 'text-white') }}">Accueil</span>
        </a>
      </li>
    @endif
      @if(auth()->user()->role == "normal user" || auth()->user()->role =='professeur')
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 ">Account pages</h6>
        </li>
        <li class="nav-item nav_btn">
          <a class="nav-link {{ (Request::is('user-profile') ? 'active' : '') }}" href="{{ url('user-profile') }}">
            <div class="icon-btn icon-shape icon-sm shadow border-radius-md  text-center me-2 d-flex align-items-center justify-content-center {{ (Request::is('user-profile') ? 'bg-dark' : 'bg-white') }}">
                <i style="font-size: 1rem;" class="fa fa-lg fa-user ps-2 pe-2 text-center {{ (Request::is('user-profile') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1 {{ (Request::is('user-profile') ? 'text-dark' : 'text-white') }}">Profile</span>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link {{ (Request::is('logout') ? 'active' : '') }}" href="{{ url('logout') }}">
            <div class="icon-btn icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i style="font-size: 1rem;" class="fa fa-lg fa-sign-out ps-2 pe-2 text-center text-dark {{ (Request::is('logout') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1">Se déconnecter</span>
          </a>
        </li> -->
      @endif


      

      @if(auth()->user()->role =='admin' || auth()->user()->role =='professeur')
      <li class="nav-item pb-2 nav_btn mt-2">
        <a class="nav-link {{ (Request::is('candidats') ? 'active' : '') }}" href="{{ url('candidats') }}">
            <div class="icon-btn icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center  {{ (Request::is('candidats') ? 'bg-dark' : 'bg-white') }}">
                <i style="font-size: 1rem;" class="fas fa-lg fa-users ps-2 pe-2 text-center  {{ (Request::is('candidats') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1 {{ (Request::is('candidats') ? 'text-dark' : 'text-white') }}">Candidatures</span>
        </a>
      </li>
      @endif
      
      @if(auth()->user()->role =="admin")
      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Gestion De Préselection </h6>
      </li>
     
      <li class="nav-item pb-2 nav_btn mt-2">
        <a class="nav-link {{ (Request::is('utilisateurs') ? 'active' : '') }}" href="{{ url('utilisateurs') }}">
            <div class="icon-btn icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center  {{ (Request::is('utilisateurs') ? 'bg-dark' : 'bg-white') }}">
                <i style="font-size: 1rem;" class="fa fa-lg fa-cogs ps-2 pe-2 text-center  {{ (Request::is('utilisateurs') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1 {{ (Request::is('utilisateurs') ? 'text-dark' : 'text-white') }}">Gestion des utilisateurs</span>
        </a>
      </li>
      
      
      <li class="nav-item nav_btn">
        <a class="nav-link {{ (Request::is('filiere') ? 'active' : '') }}" href="{{ url('filiere') }}">
          <div class="icon-btn icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center {{ (Request::is('filiere') ? 'bg-dark' : 'bg-white') }}">
            <i style="font-size: 1rem;" class="fa fa-lg fa-gear ps-2 pe-2 text-center  {{ (Request::is('filiere') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1  {{ (Request::is('filiere') ? 'text-dark' : 'text-white') }} ">Gestion des Filières </span>
        </a>
      </li>

      <li class="nav-item nav_btn">
        <a class="nav-link {{ (Request::is('matiere') ? 'active' : '') }}" href="{{ url('matiere') }}">
          <div class="icon-btn icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center {{ (Request::is('matiere') ? 'bg-dark' : 'bg-white') }}">
            <i style="font-size: 1rem;" class="fa fa-lg fa-gear ps-2 pe-2 text-center  {{ (Request::is('matiere') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1 {{ (Request::is('matiere') ? 'text-dark' : 'text-white') }} ">Gestion des Matières</span>
        </a>
      </li>

      <li class="nav-item nav_btn">
        <a class="nav-link {{ (Request::is('licence') ? 'active' : '') }}" href="{{ url('licence') }}">
          <div class="icon-btn icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center {{ (Request::is('licence') ? 'bg-dark' : 'bg-white') }}">
            <i style="font-size: 1rem;" class="fa fa-lg fa-gear ps-2 pe-2 text-center  {{ (Request::is('licence') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1 {{ (Request::is('licence') ? 'text-dark' : 'text-white') }} ">Gestion des Licences</span>
        </a>
      </li>

      <li class="nav-item nav_btn">
        <a class="nav-link {{ (Request::is('bac') ? 'active' : '') }}" href="{{ url('bac') }}">
          <div class="icon-btn icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center {{ (Request::is('bac') ? 'bg-dark' : 'bg-white') }}">
            <i style="font-size: 1rem;" class="fa fa-lg fa-gear ps-2 pe-2 text-center  {{ (Request::is('bac') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1 {{ (Request::is('bac') ? 'text-dark' : 'text-white') }}">Gestion des Baccalauréats</span>
        </a>
      </li>
    </ul>
    <div class="pb-4 position-absolute bottom-0">
      <a href="{{ url('user-profile') }}" class="d-flex align-items-center text-white text-decoration-none">
        <i class="fa fa-user-circle h2"></i>
      </a>
    </div>
    @endif

  </div>
</aside>

