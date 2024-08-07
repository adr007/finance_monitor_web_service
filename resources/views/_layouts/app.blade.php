@php
    $user = Auth::user();
@endphp
<!DOCTYPE html>
<html lang="id-ID">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ADR Finance Monitor | @yield('pageName', 'Dashboard')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('komponen/app') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('komponen/app') }}/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .loading1 {
            display: none;
            position: fixed;
            z-index: 99999;
            background-color: rgba(77, 77, 77, 0.7);
            width: 100%;
            min-height: 100vh !important;
            padding-top: 15%;
        }
    </style>
    @yield('css', '')
    @stack('additional_css')
</head>

<body id="page-top">
    <div class="loading1 text-center">
        <span class="text-white">Memproses..</span>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">ADR <sup>fm</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item" id="mn1">
                <a class="nav-link" href="{{ route('user.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Finance Data
            </div>

            {{-- <li class="nav-item" id="mn2">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-table"></i>
          <span>Assets</span></a>
      </li> --}}

            <li class="nav-item" id="mn-asset">
                <a class="nav-link" href="{{ route('user.asset') }}">
                    <i class="fas fa-fw fa-cubes"></i>
                    <span>Asset</span></a>
            </li>

            <li class="nav-item" id="mn-trans">
                <a class="nav-link" href="{{ route('user.transaction') }}">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Transaction</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item" id="mn3">
                <a class="nav-link" href="{{ route('user.report') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Activity Report</span></a>
            </li>

            <li class="nav-item" id="mn4">
                <a class="nav-link" href="{{ route('user.logs') }}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Logs</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="buttons.html">Buttons</a>
            <a class="collapse-item" href="cards.html">Cards</a>
          </div>
        </div>
      </li> --}}



            {{-- <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Addons
      </div> --}}

            <!-- Nav Item - Pages Collapse Menu -->
            {{-- <li class="nav-item ">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item active" href="blank.html">Blank Page</a>
          </div>
        </div>
      </li> --}}

            <!-- Nav Item - Tables -->


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $user->user_name }}</span>
                                <img class="img-profile rounded-circle" src="{{ $user->user_photo }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <form name="form_logout" action="{{ route('web.login.logout') }}" method="POST">
                                    @csrf
                                </form>
                                <a class="dropdown-item" href="#"
                                    onclick="document.forms['form_logout'].submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h4 class="h4 mb-4 text-gray-800">@yield('pageName', 'Dashboard')</h4>

                    @yield('body', 'NO DATA')


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; ADR Finance Monitor 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('komponen/app') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('komponen/app') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('komponen/app') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('komponen/app') }}/js/sb-admin-2.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            @if (session('success'))
                alert(`{!! session('success') !!}`);
            @endif

            @if (session('error'))
                alert(`{!! session('error') !!}`);
            @endif
        });

        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
                maximumFractionDigits: 0,
                minimumFractionDigits: 0,
            }).format(number);
        }

        async function sendAjax(link, dataKirim = {}, metode = "POST", proData = true, conType =
            'application/x-www-form-urlencoded') {
            $('.loading1').fadeIn(300);
            return $.ajax({
                url: link,
                type: metode,
                data: dataKirim,
                // cache: false,
                processData: proData,
                contentType: conType,
                success: function(res) {
                    $('.loading1').fadeOut(300);
                },
                error: function(e) {
                    $('.loading1').fadeOut(300);
                    alert("Terjadi kesalahan pada koneksi. Silahkan coba lagi");
                    console.log(e);
                }
            });
        }
    </script>
    @yield('script', '')
    @stack('additional_script')
</body>

</html>
