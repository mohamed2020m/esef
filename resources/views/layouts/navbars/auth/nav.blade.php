<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <!-- <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li> -->
                <li class="breadcrumb-item text-dark active text-capitalize" aria-current="page"><?php echo html_entity_decode(str_replace('-', ' ', Request::path())) ?> /</li>

            </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-between" id="nav-header"> 
            <div class="flex-grow-1 d-flex justify-content-center">
                <div class="nav-item">
                    <div class="p-2 header-logo">
                        <img src="../assets/img/esef.jpeg" alt="logo">
                    </div>
                </div>
            </div>
            <ul class="navbar-nav justify-content-end align-items-center">
                <li class="nav-item d-flex align-items-center logout-btn">
                    <!-- <a href="{{ url('/logout')}}" >
                        </a> -->
                        <button class="nav-link text-body font-weight-bold px-0 border-0 bg-transparent" type="button" data-bs-toggle="modal" data-bs-target="#deconnecter">
                            <i class="fa fa-sign-out me-sm-1"></i>
                            <span class="d-sm-inline d-none" id="span_logout">Se déconnecter</span>
                    </button>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center" id="toggler_btn">
                    <button href="javascript:;" class="nav-link text-body p-0 border-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="modal fade" id="deconnecter" tabindex="-1" aria-labelledby="deconnecterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deconnecterModalLabel">Se déconnecter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir vous déconnecter ?
            </div>
            <div class="modal-footer d-flex align-items-center">
                <button type="button" class="btn btn-secondary mt-3" data-bs-dismiss="modal">No</button>
                <a href="{{ url('/logout')}}" class="nav-link text-white py-2 px-3 rounded font-weight-bold bg-danger">
                    <span class="d-sm-inline d-none bg-daner" id="span_logout">Oui</span>
                </a>
            </div>
        </div>
    </div>
</div>
