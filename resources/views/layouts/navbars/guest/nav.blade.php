<!-- Navbar -->
<div class="d-flex justify-content-center">
  <div class="p-2 header-logo">
    <img src="../assets/img/esef.jpeg" alt="logo">
  </div>
</div>

<nav class="navbar navbar-expand-lg d-flex justify-content-around text-white navbar-custom" id="navbar">
  <div class="btns-container">
    <a  class="border px-3 py-2 mx-3 rounded-pill text-light" href="{{url('/Accueil')}}">
      <i class="fas fa-home opacity-6 me-1" aria-hidden="true"></i>
      Accueil
    </a>
    @if(\Request::is('inscription'))    
      <a class="border px-3 py-2 mx-2 rounded-pill text-light" href="{{url('/Accueil')}}">
        <i class="fas fa-key opacity-6 me-1" aria-hidden="true"></i>
        s'identifier
      </a>
    @else
    <a class="border px-3 py-2 mx-2 rounded-pill text-light" href="{{url('/inscription')}}">
        <i class="fas fa-key opacity-6 me-1" aria-hidden="true"></i>
        S'inscrire 
    </a>
    @endif
  </div>
</nav>

<!-- End Navbar -->
