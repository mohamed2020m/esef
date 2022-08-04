<footer class="footer py-5 custom-footer">
  <div class="container-fluid">
    <div class="d-flex justify-content-center mb-3 usefulLinks">
        <div>
          <a href="http://www.esef.ucd.ac.ma/" target="_blank" class="text-secondary mx-3">
            ACCUEIL
          </a>
        </div>

        <div>
          <a href="http://www.esef.ucd.ac.ma/index.php/formation/" target="_blank" class="text-secondary mx-3">
            FORMATION
          </a>
        </div>
        
        <div>
          <a href="http://www.esef.ucd.ac.ma/index.php/actualites/" target="_blank" class="text-secondary mx-3">
            ACTUALITES
          </a>
        </div>
        
        <div>
          <a href="http://www.esef.ucd.ac.ma/index.php/esef-j/" target="_blank" class="text-secondary mx-3">
            ESEF-J
          </a>
        </div>
        
        <div>
          <a href="http://www.esef.ucd.ac.ma/index.php/espace-etudiants/" target="_blank" class="text-secondary mx-3">
            ESPACE ETUDIANTS
          </a>
        </div>
        
        <div>
          <a href="http://www.esef.ucd.ac.ma/index.php/contacez-nous/" target="_blank" class="text-secondary mx-3">
            CONTACTEZ NOUS
          </a>
        </div>
        
    </div>
    @if (!auth()->user() || \Request::is('static-sign-up')) 
    <div class="d-flex justify-content-center mb-3">
        <div>
          <a href="https://web.facebook.com/esef.ucd?_rdc=1&_rdr" target="_blank" class="text-secondary mr-3">
            <span class="text-lg fab fa-facebook" aria-hidden="true"></span>
          </a>
        </div>
        <div>
          <a href="http://www.instagram.com/esef.ucd" target="_blank" class="text-secondary mx-3">
            <span class="text-lg fab fa-instagram" aria-hidden="true"></span>
          </a>
        </div>
        <div>
          <a href="https://www.youtube.com/channel/UCTgcvczvkujOoju6Oof7-LQ" target="_blank" class="text-secondary ml-3">
            <span class="text-lg fab fa-youtube" aria-hidden="true"></span>
          </a>
        </div>
    </div>
    @endif
    @if (!auth()->user() || \Request::is('static-sign-up')) 
    <div class="d-flex justify-content-center">
      <p class="text-secondary text-italic">
        Copyright © <script>
          document.write(new Date().getFullYear())
        </script>
      </p>
    </div>
    @endif
  </div>
</footer>