<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Aplikasi Laporan Keuangan Sederhana">
        <meta name="author" content="Gemini AI">

        <title>@yield("title", "Dashboard") - Laporan Keuangan</title>

        <link href="{{ asset("vendor/fontawesome-free/css/all.min.css") }}" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <link href="{{ asset("css/sb-admin-2.min.css") }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    </head>

    <body id="page-top">

        <div id="wrapper">

            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route("beranda") }}">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Laporan Keuangan</div>
                </a>

                <hr class="sidebar-divider my-0">

                <li class="nav-item {{ Request::is("/") ? "active" : "" }}">
                    <a class="nav-link" href="{{ route("beranda") }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Beranda</span>
                    </a>
                </li>

                <hr class="sidebar-divider">

                <div class="sidebar-heading">
                    Menu Utama
                </div>

                <li class="nav-item {{ Request::is("laporan/*") ? "active" : "" }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan"
                        aria-expanded="true" aria-controls="collapseLaporan">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Laporan</span>
                    </a>
                    <div id="collapseLaporan" class="{{ Request::is("laporan/*") ? "show" : "" }} collapse"
                        aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="collapse-inner rounded bg-white py-2">
                            <h6 class="collapse-header">Jenis Laporan:</h6>
                            <a class="collapse-item" href="{{ route("report.arus_kas") }}">Arus Kas</a>
                            <a class="collapse-item" href="{{ route("report.laba_rugi") }}">Laba Rugi</a>
                            <a class="collapse-item" href="{{ route("report.perubahan_modal") }}">Perubahan Modal</a>
                            <a class="collapse-item" href="{{ route("report.neraca") }}">Neraca</a>
                        </div>
                    </div>
                </li>

                <hr class="sidebar-divider d-none d-md-block">

                <div class="d-none d-md-inline text-center">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <div id="content-wrapper" class="d-flex flex-column">

                <div id="content">

                    <nav class="navbar navbar-expand navbar-light topbar static-top mb-4 bg-white shadow">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                        <ul class="navbar-nav ml-auto">
                        </ul>
                    </nav>
                    <div class="container-fluid">

                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">@yield("title", "Dashboard")</h1>
                        </div>

                        @yield("content")

                    </div>
                </div>
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright my-auto text-center">
                            <span>Copyright &copy; Laporan Keuangan {{ date("Y") }}</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <script src="{{ asset("vendor/jquery/jquery.min.js") }}"></script>
        <script src="{{ asset("vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>

        <script src="{{ asset("vendor/jquery-easing/jquery.easing.min.js") }}"></script>

        <script src="{{ asset("js/sb-admin-2.min.js") }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- Script ini akan menampilkan notifikasi sukses global --}}
        @if (session("success"))
            <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session("success") }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif
        @yield("scripts")

    </body>

</html>
