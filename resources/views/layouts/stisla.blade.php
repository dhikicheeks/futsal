<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css">

    {{-- DATATABLE --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

    
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    {{-- LIGHTBOX --}}
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{Auth::user()->name}}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            {{-- <div class="dropdown-title">Logged in 5 min ago</div>
                            <a href="features-profile.html" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href="features-activities.html" class="dropdown-item has-icon">
                                <i class="fas fa-bolt"></i> Activities
                            </a>
                            <a href="features-settings.html" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Settings
                            </a> --}}
                            <!-- <div class="dropdown-divider"></div> -->
                            <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{url('/home')}}">Damar Futsal</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{url('/home')}}">DF</a>
                    </div>


                    <!-- LOGIN OWNER -->
                    @if(Auth::user()->role_id == 2
                    )
                    <ul class="sidebar-menu">
                        <li class="menu-header">INVENTORY</li>
                        <li class="nav-item dropdown
                                @if(
                                    Route::currentRouteName() == 'home')
                                    active
                                @endif">
                            <a href=" #" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-archive"></i>
                                <span>Inventory</span></a>
                            <ul class="dropdown-menu">

                                <li><a class="nav-link {{ (Route::currentRouteName() == 'home')?'nav-active':'' }}"
                                        href="{{url('home')}}">Lihat Inventory</a></li>
                            </ul>
                        </li>
                        <li class="menu-header">KEUANGAN</li>
                        <li class="nav-item dropdown
                                @if(Route::currentRouteName() == 'laporan_keuangan_futsal' ||
                                    Route::currentRouteName() == 'laporan_keuangan_snack'                                
                                    ) 
                                    active
                                @endif">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book"></i>
                                <span>Laporan Keuangan</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link {{ (Route::currentRouteName() == 'laporan_keuangan_futsal')?'nav-active':'' }}"
                                        href="{{url('laporan_keuangan_futsal')}}">Keuangan Futsal</a></li>
                                <li><a class="nav-link {{ (Route::currentRouteName() == 'laporan_keuangan_snack')?'nav-active':'' }}"
                                        href="{{url('laporan_keuangan_snack')}}">Keuangan Penjualan</a></li>
                            </ul>
                        </li>
                    </ul>
                    @endif

                    <!-- LOGIN ADMIN -->
                    @if(
                    Auth::user()->role_id == 1)
                    <ul class="sidebar-menu">
                        <li class="menu-header">Antrian Verifikasi</li>
                        <li class="nav-item dropdown
                                @if(Route::currentRouteName() == 'home' ||
                                    Route::currentRouteName() == 'verifikasi_pelunasan' ||
                                    Route::currentRouteName() == 'verifikasi_member_baru')
                                    active
                                @endif">
                            <a href="#" class="nav-link has-dropdown"><i
                                    class="fas fa-address-book"></i><span>Verifikasi</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link {{ (Route::currentRouteName() == 'home')?'nav-active':'' }}"
                                        href="{{url('home')}}">Verifikasi DP</a></li>
                                <li><a class="nav-link {{ (Route::currentRouteName() == 'verifikasi_pelunasan')?'nav-active':'' }}"
                                        href="{{url('verifikasi_pelunasan')}}">Verifikasi Pelunasan</a></li>
                                <li><a class="nav-link {{ (Route::currentRouteName() == 'verifikasi_member_baru')?'nav-active':'' }}"
                                        href="{{url('verifikasi_member_baru')}}">Verifikasi Member</a></li>
                            </ul>
                        </li>
                        <li class="menu-header">PENJUALAN</li>
                        <li class="nav-item dropdown
                                @if(Route::currentRouteName() == 'stock_snack')
                                    active
                                @endif">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-coffee"></i>
                                <span>Penjualan</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link {{ (Route::currentRouteName() == 'stock_snack')?'nav-active':'' }}"
                                        href="{{url('stock_snack')}}">Food and Drink</a></li>
                            </ul>
                        </li>
                    </ul>
                    @endif

                    <!-- LOGIN MEMBER -->
                    @if(Auth::user()->role_id == 3)
                    <ul class="sidebar-menu">
                        <li class="menu-header">PAKET ANDA</li>
                        <li class="nav-item dropdown
                            @if(Route::currentRouteName() == 'home'|| 
                             Route::currentRouteName() == 'upload_bukti_tf_member'
                                )
                                active
                            @endif">
                            <a href="#" class="nav-link has-dropdown"><i class="far fa-address-card"></i><span>Lihat
                                    Paket</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link {{ (Route::currentRouteName() == 'home')?'nav-active':'' }}"
                                        href="{{url('home')}}">Lihat Jadwal</a></li>
                                        <li><a class="nav-link {{ (Route::currentRouteName() == 'upload_bukti_tf_member')?'nav-active':'' }}"
                                        href="{{url('upload_bukti_tf_member')}}">Upload Bukti Pembayaran</a></li>
                                        

                            </ul>
                        </li>
                    </ul>
                    @endif
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>@yield('section-header')</h1>
                    </div>
                    @yield('content')
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Damar Futsal Wonogiri Copyright &copy; 2021
                </div>
            </footer>
        </div>
    </div>



    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    {{-- DATATABLE --}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>


    {{-- SEARCH view Snack --}}
    <script>
        $(document).ready(function () {
            $('#search-makanan').DataTable();
        });

    </script>

    {{-- SEARCH view Validasi DP --}}
    <script>
        $(document).ready(function () {
            $('#search-validasi-dp').DataTable();
        });

    </script>

    {{-- SEARCH view Validasi Member --}}
    <script>
        $(document).ready(function () {
            $('#search-verifikasi-member').DataTable();
        });

    </script>

    {{-- SEARCH view Validasi DP --}}
    <script>
        $(document).ready(function () {
            $('#search-verifikasi-dp').DataTable();
        });

    </script>

    {{-- SEARCH view inventory --}}
    <script>
        $(document).ready(function () {
            $('#search-inventory').DataTable();
        });

    </script>

    {{-- SEARCH view Keuangan Futsal --}}
    <script>
        $(document).ready(function () {
            $('#search-keuangan-futsal').DataTable();
        });

    </script>

    {{-- SEARCH view Keuangan Snack --}}
    <script>
        $(document).ready(function () {
            $('#search-keuangan-snack').DataTable();
        });

    </script>

    {{-- SEARCH view Keuangan Member --}}
    <script>
        $(document).ready(function () {
            $('#search-keuangan-member').DataTable();
        });

    </script>

</body>

</html>
