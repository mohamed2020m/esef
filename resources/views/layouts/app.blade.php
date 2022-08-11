<!DOCTYPE html>

@if (\Request::is('rtl'))
  <html dir="rtl" lang="ar">
@else
  <html lang="en" >
@endif

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @if (env('IS_DEMO'))
      <x-demo-metas></x-demo-metas>
  @endif

  <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">
  <link rel="icon" type="image/png" href="../assets/img/logo.png">
  <title>
    ESEF EL JADIDA
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
  <!-- Custom CSS -->
  <link rel="stylesheet" href="../assets/css/custom-css.css">
  <!-- Datatable CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>
  <!-- jQuery Library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Datatable JS -->
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" defer></script>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css" integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js" integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="g-sidenav-show  bg-gray-100 ">
  <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  @auth
    @yield('auth')
  @endauth
  @guest
    @yield('guest')
  @endguest

  @if(session()->has('success'))
    <div x-data="{ show: true}"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
      <p class="m-0">{{ session('success')}}</p>
    </div>
  @endif

  <!--   Core JS Files   -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/fullcalendar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  
  @stack('rtl')
  @stack('dashboard')
  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  
  <!-- Sticky  -->
  <script>
    window.onscroll = function() {myFunction()};

    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;

    function myFunction() {
      if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
      } else {
        navbar.classList.remove("sticky");
      }
    }
  </script>

  <!-- responsive SideBar -->
  <script>
    window.addEventListener('load', () => {
      if(window.innerWidth >= 1200){
        document.querySelector('#auth-wrap-nav-content').classList.add("col-10");
        document.querySelector('#auth-wrap-nav-content').classList.remove("col", "col-12");
      }
      else{
        document.querySelector('#auth-wrap-nav-content').classList.remove("col-10");
        document.querySelector('#auth-wrap-nav-content').classList.add("col-12");
      }
    })
    window.addEventListener('resize', () => {
      if(window.innerWidth >= 1200){
        document.querySelector('#auth-wrap-nav-content').classList.add("col-10");
        document.querySelector('#auth-wrap-nav-content').classList.remove("col", "col-12");
      }
      else{
        document.querySelector('#auth-wrap-nav-content').classList.remove("col-10");
        document.querySelector('#auth-wrap-nav-content').classList.add("col-12");
      }
    })

  </script>

  <script>
    let btn = document.querySelector('#toggler_btn'); 
    let sidebar = document.querySelector('.cusotom-sideBar');
    let btnCloseSidebar = document.querySelector('#btn-close-sidebar');
    btn.addEventListener('click', () => {
        if(sidebar.style.display === 'block'){
            sidebar.removeAttribute('style')
            sidebar.setAttribute('style', 'display:none !important')
            document.querySelector('#auth-wrap-nav-content').classList.remove("col-10");
            document.querySelector('#auth-wrap-nav-content').classList.add("col-12");
        }
        else{
            sidebar.removeAttribute('style')
            sidebar.setAttribute('style', 'display:block !important');
            btn.setAttribute('style', 'display:none !important');
            document.querySelector('#auth-wrap-nav-content').classList.add("col-10");
            document.querySelector('#auth-wrap-nav-content').classList.remove("col", "col-12");
        }
    })
    btnCloseSidebar.addEventListener('click', () => {
        sidebar.setAttribute('style', 'display:none !important');
        btn.setAttribute('style', 'display:block !important');
        document.querySelector('#auth-wrap-nav-content').classList.remove("col-10");
        document.querySelector('#auth-wrap-nav-content').classList.add("col-12");
    })
    
    window.addEventListener('resize', () => {
      if(window.innerWidth >= 1200){
        sidebar.setAttribute('style', 'display:block !important');
        btn.setAttribute('style', 'display:none !important');
      }
      if(window.innerWidth <= 400){
        sidebar.setAttribute('style', 'display:none !important');
        btn.setAttribute('style', 'display:block !important');
      }
    })
    
    document.querySelector("#btn_logout").addEventListener('click', () => {
      if(window.innerWidth >= 1200){
        sidebar.setAttribute('style', 'display:block !important');
        btn.setAttribute('style', 'display:none !important');
      }
      if(window.innerWidth <= 400){
        sidebar.setAttribute('style', 'display:none !important');
        btn.setAttribute('style', 'display:block !important');
      }
    })
  </script>

  <!-- preload -->
  <script>  
    $(window).on('load', function(event) {
        $('.preloader').delay(500).fadeOut(500);
    });
  </script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>

</body>

</html>
