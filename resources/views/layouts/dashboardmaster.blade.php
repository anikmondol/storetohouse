<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Dashtrap - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('dashboard') }}/assets/images/favicon.ico">

    <link href="{{ asset('dashboard') }}/assets/libs/morris.js/morris.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('dashboard') }}/assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('dashboard') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="{{ asset('dashboard') }}/assets/js/config.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


    {{-- custom css --}}

    <!-- third party css -->
    <link href="{{ asset('dashboard') }}/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard') }}/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard') }}/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard') }}/assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <!-- third party css end -->


    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Plugins css -->
    <link href="{{ asset('dashboard') }}/assets/libs/quill/quill.core.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard') }}/assets/libs/quill/quill.bubble.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard') }}/assets/libs/quill/quill.snow.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    {{-- <link href="{{ asset('dashboard') }}/assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('dashboard') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css"> --}}
    <script src="{{ asset('dashboard') }}/assets/js/config.js"></script>



    @stack('css')

</head>

<body>

    <!-- Begin page -->
    <div class="layout-wrapper">

        <!-- ========== Left Sidebar ========== -->
        <div class="main-menu">
            <!-- Brand Logo -->
            <div class="logo-box">
                <!-- Brand Logo Light -->
                <a class='logo-light' href='{{ route('dashboard') }}'>
                    <img src="{{ asset('dashboard') }}/assets/images/logo-light.png" alt="logo" class="logo-lg"
                        height="28">
                    <img src="{{ asset('dashboard') }}/assets/images/logo-sm.png" alt="small logo" class="logo-sm"
                        height="28">
                </a>

                <!-- Brand Logo Dark -->
                <a class='logo-dark' href='{{ route('dashboard') }}'>
                    <img src="{{ asset('dashboard') }}/assets/images/logo-dark.png" alt="dark logo" class="logo-lg"
                        height="28">
                    <img src="{{ asset('dashboard') }}/assets/images/logo-sm.png" alt="small logo" class="logo-sm"
                        height="28">
                </a>
            </div>

            <!--- Menu -->
            <div data-simplebar>
                <ul class="app-menu">

                    <li class="menu-title">Menu</li>

                    <li class="menu-item">
                        <a class='menu-link waves-effect waves-light' href='{{ route('dashboard') }}'>
                            <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                            <span class="menu-text"> Dashboards </span>
                            <span class="badge bg-primary rounded ms-auto">01</span>
                        </a>
                    </li>


                    {{-- item --}}
                    <li class="menu-item">
                        <a class='menu-link waves-effect waves-light' href='{{ route('vehicle.index') }}'>
                            <span class="menu-icon"><i class="mdi mdi-bus-multiple"></i></span>
                            <span class="menu-text"> vehicles </span>
                        </a>
                    </li>

                    {{-- item --}}
                    <li class="menu-item">
                        <a class='menu-link waves-effect waves-light' href='{{ route('item.index') }}'>
                            <span class="menu-icon"><i class="mdi mdi-book-plus-outline"></i></span>
                            <span class="menu-text"> New Item </span>
                        </a>
                    </li>

                    {{-- brand --}}
                    <li class="menu-item">
                        <a class='menu-link waves-effect waves-light' href='{{ route('brand.index') }}'>
                            <span class="menu-icon"><i class="mdi mdi-alpha-b-box-outline"></i></span>
                            <span class="menu-text"> Brand </span>
                        </a>
                    </li>

                    {{-- category --}}
                    <li class="menu-item">
                        <a class='menu-link waves-effect waves-light' href='{{ route('category.index') }}'>
                            <span class="menu-icon"><i class="mdi mdi-alpha-c-box-outline"></i></span>
                            <span class="menu-text"> Category </span>
                        </a>
                    </li>

                    {{-- store --}}
                    <li class="menu-item">
                        <a class='menu-link waves-effect waves-light' href='{{ route('store.index') }}'>
                            <span class="menu-icon"><i class="mdi mdi-cart-variant"></i></span>
                            <span class="menu-text"> Store </span>
                        </a>
                    </li>

                    {{-- maintenance --}}
                    <li class="menu-item">
                        <a class='menu-link waves-effect waves-light' href='{{ route('maintenance.index') }}'>
                            <span class="menu-icon"><i class="mdi mdi-wrench-outline"></i></span>
                            <span class="menu-text"> Maintenance </span>
                        </a>
                    </li>


                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
                        <li class="menu-title">Management User</li>
                        <li class="menu-item">
                            <a href="#menuRole" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                                <span class="menu-icon"><i class="bx bx-file"></i></span>
                                <span class="menu-text"> Role & Permission </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="menuRole">
                                <ul class="sub-menu">
                                    <li class="menu-item">
                                        <a class='menu-link' href='{{ route('management.index') }}'>
                                            <span class="menu-text">Assign Role & Register</span>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a class='menu-link' href='{{ route('management.role.index') }}'>
                                            <span class="menu-text">Assign Existing Users Role</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif

                    <li class="menu-item">
                        <a class='menu-link waves-effect waves-light' href="{{ route('home.profile') }}">
                            <span class="menu-icon"><i class="fa-regular fa-face-smile"></i></span>
                            <span class="menu-text"> Profile </span>
                        </a>
                    </li>

                </ul>
            </div>

        </div>



        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="page-content">

            <!-- ========== Topbar Start ========== -->
            <div class="navbar-custom">
                <div class="topbar">
                    <div class="topbar-menu d-flex align-items-center gap-lg-2 gap-1">

                        <!-- Brand Logo -->
                        <div class="logo-box">
                            <!-- Brand Logo Light -->
                            <a class='logo-light' href='{{ route('dashboard') }}'>
                                <img src="{{ asset('dashboard') }}/assets/images/logo-light.png" alt="logo"
                                    class="logo-lg" height="22">
                                <img src="{{ asset('dashboard') }}/assets/images/logo-sm.png" alt="small logo"
                                    class="logo-sm" height="22">
                            </a>

                            <!-- Brand Logo Dark -->
                            <a class='logo-dark' href='{{ route('dashboard') }}'>
                                <img src="{{ asset('dashboard') }}/assets/images/logo-dark.png" alt="dark logo"
                                    class="logo-lg" height="22">
                                <img src="{{ asset('dashboard') }}/assets/images/logo-sm.png" alt="small logo"
                                    class="logo-sm" height="22">
                            </a>
                        </div>

                        <!-- Sidebar Menu Toggle Button -->
                        <button class="button-toggle-menu">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </div>

                    <ul class="topbar-menu d-flex align-items-center gap-4">

                        <li class="d-none d-md-inline-block">
                            <a class="nav-link" href="#" data-bs-toggle="fullscreen">
                                <i class="mdi mdi-fullscreen font-size-24"></i>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none"
                                data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false">
                                <i class="mdi mdi-magnify font-size-24"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end dropdown-lg p-0">
                                <form class="p-3">
                                    <input type="search" class="form-control" placeholder="Search ..."
                                        aria-label="Recipient's username">
                                </form>
                            </div>
                        </li>


                        <li class="dropdown d-none d-md-inline-block">
                            <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none"
                                data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false">
                                <img src="{{ asset('dashboard') }}/assets/images/flags/us.jpg" alt="user-image"
                                    class="me-0 me-sm-1" height="18">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <img src="{{ asset('dashboard') }}/assets/images/flags/germany.jpg"
                                        alt="user-image" class="me-1" height="12"> <span
                                        class="align-middle">German</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <img src="{{ asset('dashboard') }}/assets/images/flags/italy.jpg"
                                        alt="user-image" class="me-1" height="12"> <span
                                        class="align-middle">Italian</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <img src="{{ asset('dashboard') }}/assets/images/flags/spain.jpg"
                                        alt="user-image" class="me-1" height="12"> <span
                                        class="align-middle">Spanish</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <img src="{{ asset('dashboard') }}/assets/images/flags/russia.jpg"
                                        alt="user-image" class="me-1" height="12"> <span
                                        class="align-middle">Russian</span>
                                </a>

                            </div>
                        </li>

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none"
                                data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false">
                                <i class="mdi mdi-bell font-size-24"></i>
                                <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                                <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 font-size-16 fw-semibold"> Notification</h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="javascript: void(0);"
                                                class="text-dark text-decoration-underline">
                                                <small>Clear All</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-1" style="max-height: 300px;" data-simplebar>

                                    <h5 class="text-muted font-size-13 fw-normal mt-2">Today</h5>
                                    <!-- item-->

                                    <a href="javascript:void(0);"
                                        class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-1">
                                        <div class="card-body">
                                            <span class="float-end noti-close-btn text-muted"><i
                                                    class="mdi mdi-close"></i></span>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="notify-icon bg-primary">
                                                        <i class="mdi mdi-comment-account-outline"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 text-truncate ms-2">
                                                    <h5 class="noti-item-title fw-semibold font-size-14">Datacorp
                                                        <small class="fw-normal text-muted ms-1">1 min ago</small>
                                                    </h5>
                                                    <small class="noti-item-subtitle text-muted">Caleb Flakelar
                                                        commented on Admin</small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);"
                                        class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                        <div class="card-body">
                                            <span class="float-end noti-close-btn text-muted"><i
                                                    class="mdi mdi-close"></i></span>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="notify-icon bg-info">
                                                        <i class="mdi mdi-account-plus"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 text-truncate ms-2">
                                                    <h5 class="noti-item-title fw-semibold font-size-14">Admin <small
                                                            class="fw-normal text-muted ms-1">1 hours ago</small></h5>
                                                    <small class="noti-item-subtitle text-muted">New user
                                                        registered</small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <h5 class="text-muted font-size-13 fw-normal mt-0">Yesterday</h5>

                                    <!-- item-->
                                    <a href="javascript:void(0);"
                                        class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                        <div class="card-body">
                                            <span class="float-end noti-close-btn text-muted"><i
                                                    class="mdi mdi-close"></i></span>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="notify-icon">
                                                        <img src="{{ asset('dashboard') }}/assets/images/users/avatar-2.jpg"
                                                            class="img-fluid rounded-circle" alt="" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 text-truncate ms-2">
                                                    <h5 class="noti-item-title fw-semibold font-size-14">Cristina Pride
                                                        <small class="fw-normal text-muted ms-1">1 day ago</small>
                                                    </h5>
                                                    <small class="noti-item-subtitle text-muted">Hi, How are you? What
                                                        about our next meeting</small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <h5 class="text-muted font-size-13 fw-normal mt-0">30 Dec 2021</h5>

                                    <!-- item-->
                                    <a href="javascript:void(0);"
                                        class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                        <div class="card-body">
                                            <span class="float-end noti-close-btn text-muted"><i
                                                    class="mdi mdi-close"></i></span>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="notify-icon bg-primary">
                                                        <i class="mdi mdi-comment-account-outline"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 text-truncate ms-2">
                                                    <h5 class="noti-item-title fw-semibold font-size-14">Datacorp</h5>
                                                    <small class="noti-item-subtitle text-muted">Caleb Flakelar
                                                        commented on Admin</small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);"
                                        class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                        <div class="card-body">
                                            <span class="float-end noti-close-btn text-muted"><i
                                                    class="mdi mdi-close"></i></span>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="notify-icon">
                                                        <img src="{{ asset('dashboard') }}/assets/images/users/avatar-4.jpg"
                                                            class="img-fluid rounded-circle" alt="" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 text-truncate ms-2">
                                                    <h5 class="noti-item-title fw-semibold font-size-14">Karen Robinson
                                                    </h5>
                                                    <small class="noti-item-subtitle text-muted">Wow ! this admin looks
                                                        good and awesome design</small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <div class="text-center">
                                        <i class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"></i>
                                    </div>
                                </div>

                                <!-- All-->
                                <a href="javascript:void(0);"
                                    class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                                    View All
                                </a>

                            </div>
                        </li>

                        <li class="nav-link" id="theme-mode">
                            <i class="bx bx-moon font-size-24"></i>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light"
                                data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false">
                                @if (auth()->user()->image == 'default.webp')
                                    <img src="{{ asset('uploads/default') }}/{{ auth()->user()->image }}"
                                        alt="user-image" class="rounded-circle">
                                @else
                                    <img src="{{ asset('uploads/profile') }}/{{ auth()->user()->image }}"
                                        alt="user-image" class="rounded-circle">
                                @endif
                                <span class="ms-1 d-none d-md-inline-block">
                                    {{ auth()->user()->name }} . <i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>My Account</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-settings"></i>
                                    <span>Settings</span>
                                </a>

                                <!-- item-->
                                <a class='dropdown-item notify-item' href='pages-lock-screen.html'>
                                    <i class="fe-lock"></i>
                                    <span>Lock Screen</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <!-- item-->
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class='dropdown-item notify-item' type="submit">
                                        <i class="fe-log-out"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>

                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- ========== Topbar End ========== -->

            <div class="px-3 mt-4">

                <!-- Start Content-->
                <div class="container-fluid">

                    @yield('content')

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> © Dashtrap
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-none d-md-flex gap-4 align-item-center justify-content-md-end">
                                <p class="mb-0">Design & Develop by <a href="https://myrathemes.com/"
                                        target="_blank">MyraStudio</a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- App js -->

    <script src="{{ asset('dashboard') }}/assets/js/vendor.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/app.js"></script>

    <!-- Knob charts js -->
    <script src="{{ asset('dashboard') }}/assets/libs/jquery-knob/jquery.knob.min.js"></script>

    <!-- Sparkline Js-->
    <script src="{{ asset('dashboard') }}/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

    <script src="{{ asset('dashboard') }}/assets/libs/morris.js/morris.min.js"></script>

    <script src="{{ asset('dashboard') }}/assets/libs/raphael/raphael.min.js"></script>

    <!-- Dashboard init-->
    <script src="{{ asset('dashboard') }}/assets/js/pages/dashboard.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>



    <!-- third party js -->
    <script src="{{ asset('dashboard') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js">
    </script>
    <script src="{{ asset('dashboard') }}/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <!-- third party js ends -->

    <!-- Datatables js -->
    <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>

    <!-- Plugins js -->
    <script src="{{ asset('dashboard') }}/assets/libs/quill/quill.min.js"></script>


    <!-- Demo js-->
    <script src="{{ asset('dashboard') }}/assets/js/pages/form-quilljs.js"></script>


    <!-- jQuery -->




    @yield('script')
</body>




</html>
