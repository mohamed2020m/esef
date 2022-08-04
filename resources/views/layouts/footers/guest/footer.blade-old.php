  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
      <div class="col-lg-8 mb-4 mx-auto text-center">
          <a href="http://www.esef.ucd.ac.ma/" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
          ACCUEIL
          </a>
          <a href="http://www.esef.ucd.ac.ma/index.php/formation/" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
          FORMATION
          </a>
          <a href="http://www.esef.ucd.ac.ma/index.php/actualites/" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
          ACTUALITES
          </a>
          <a href="http://www.esef.ucd.ac.ma/index.php/esef-j/" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
          ESEF-J
          </a>
          <a href="http://www.esef.ucd.ac.ma/index.php/espace-etudiants/" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
              ESPACE ETUDIANTS
          </a>
          <a href="http://www.esef.ucd.ac.ma/index.php/contacez-nous/" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
              CONTACTEZ NOUS
          </a>
      </div>
        @if (!auth()->user() || \Request::is('static-sign-up')) 
          <div class="col-lg-8 mx-auto text-center mb-4 mt-2">

              <a href="https://web.facebook.com/esef.ucd?_rdc=1&_rdr" target="_blank" class="text-secondary me-xl-4 me-4">
                  <span class="text-lg fab fa-facebook" aria-hidden="true"></span>
              </a>
            
              
              <a href="http://www.instagram.com/esef.ucd" target="_blank" class="text-secondary me-xl-4 me-4">
                  <span class="text-lg fab fa-instagram" aria-hidden="true"></span>
              </a>
              
              <a href="https://www.youtube.com/channel/UCTgcvczvkujOoju6Oof7-LQ" target="_blank" class="text-secondary me-xl-4 me-4">
                  <span class="text-lg fab fa-youtube" aria-hidden="true"></span>
              </a>

              <a href="" target="_blank" class="text-secondary me-xl-4 me-4">
                  <span class="text-lg fab fa-location-pin" aria-hidden="true"></span>
              </a>
            
              
          </div>
        @endif
      </div>
      @if (!auth()->user() || \Request::is('static-sign-up')) 
        <div class="row">
          <div class="col-8 mx-auto text-center mt-1">
            <p class="mb-0 text-secondary">
              Copyright © <script>
                document.write(new Date().getFullYear())
              </script>
            </p>
          </div>
        </div>
      @endif
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
