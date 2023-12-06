<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title', 'Dashboard - SB Admin')</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.17.0/font/bootstrap-icons.css" rel="stylesheet">
        <link href="{{ asset($asset_dir . 'styles.css') }}" rel="stylesheet" type="text/css" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <style>
            .navbar-brand {
                font-family: 'Arial', sans-serif;
                font-size: 18px;
                font-weight: bold;
                color: #ffffff; /* Set your desired text color */
                text-decoration: none;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Add a subtle text shadow */
            }
    
            .navbar-brand:hover {
                color: #ff0000; /* Change the text color on hover */
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <button class="btn btn-link btn-sm order-0 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand ps-3" href="index">FAKECEZ</a>
            <!-- Sidebar Toggle-->
            <!-- Navbar Search-->
            <div class="d-none d-md-inline-block ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="badge bg-secondary text-wrap"><i class="fa-solid fa-money-bill-wave"></i>  Rp. {{ number_format(Auth::user()->balance, 0, ',', '.') }}</div>
            </div>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-fw"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="min-width: 300px;">
                        <div class="p-3 bg-secondary text-white">
                            <div class="mb-2">
                                <i class="fas fa-user fa-fw"></i> {{ Auth::user()->name }}
                                @if (Auth::user()->role == 'user' or Auth::user()->role == null)  
                                    @if (Auth::user()->spent < 1000000)  
                                        <div class="badge bg-info">
                                            <i class="fa-solid fa-star-half-stroke"></i> RESELLER
                                        </div>
                                    @elseif (Auth::user()->spent >= 1000000 and Auth::user()->spent < 2000000)  
                                        <div class="badge bg-primary">
                                            <i class="fa-solid fa-star"></i> RESELLER++
                                        </div>
                                    @elseif (Auth::user()->spent >= 2000000)  
                                        <div class="badge bg-success">
                                            <i class="fa-solid fa-ranking-star"></i> TOP RESELLER
                                        </div>
                                    @endif
                                    @if (Auth::user()->balance >= 1000000)  
                                    <div class="badge bg-success">
                                        <i class="fa-solid fa-crown"></i> SULTAN
                                    </div>
                                    @endif
                                @else
                                    <div class="badge bg-danger">
                                        Role: {{ Auth::user()->role }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-2">
                                <i class="fa-solid fa-money-bill-wave"></i><strong></strong> Rp. {{ number_format(Auth::user()->balance, 0, ',', '.') }}
                            </div>
                        </div>
                        <li><a class="dropdown-item" href="#!" style="font-size: 16px; padding: 10px;">Settings</a></li>
                        <li><a class="dropdown-item" href="#!" style="font-size: 16px; padding: 10px;">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="{{ route('index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="news.html">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-newspaper"></i></div>
                                News & Update
                            </a>
                            <div class="sb-sidenav-menu-heading">License</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-key"></i></div>
                                Key Generator
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="ml_generator">Mobile Legends</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">8 Ball Pool</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-wrench"></i></div>
                                Key Tools
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="layout-static.html">Perpanjang</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Reset</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">OTHER</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-file-zipper"></i></div>
                                File cheat
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                                Activity
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                          <!-- Nav footer disini -->
                    </div>
                </nav>
            </div>
            
            <div id="layoutSidenav_content">
            @yield('content')
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Jarlife 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
