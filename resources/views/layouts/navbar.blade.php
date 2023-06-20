<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
            <span class="d-none d-lg-block">Sikasir</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">


            <li class="nav-link nav-icon">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="align-items-center btn btn-outline-dark">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </li>
        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
