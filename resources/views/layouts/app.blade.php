<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield("title", "Laporan Keuangan")</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background-color: #6a63f5;
                padding-bottom: 50px;
            }

            .main-container {
                background-color: white;
                border-radius: 15px;
                padding: 2rem;
                margin-top: 50px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            }

            .nav-pills .nav-link {
                background-color: #f1f1f1;
                color: #555;
                margin: 0 5px;
                border-radius: 8px;
            }

            .nav-pills .nav-link.active {
                background-color: #483dff;
                /* Warna biru yang lebih sesuai dengan screenshot */
                color: white;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            }

            .report-item {
                display: flex;
                justify-content: space-between;
                padding: 1rem;
                background-color: #f8f9fa;
                border-radius: 8px;
                margin-bottom: 10px;
                font-size: 1.1rem;
            }

            .report-item-total {
                font-weight: bold;
                border-top: 2px solid #ddd;
                margin-top: 10px;
                padding-top: 1rem;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="main-container">
                <h1 class="mb-4 text-center">@yield("title")</h1>

                <ul class="nav nav-pills justify-content-center mb-5">
                    <li class="nav-item"><a href="{{ route("beranda") }}"
                            class="nav-link {{ Request::is("/") ? "active" : "" }}">🏠 Beranda</a></li>
                    <li class="nav-item"><a href="{{ route("report.arus_kas") }}"
                            class="nav-link {{ Request::is("laporan/arus-kas") ? "active" : "" }}">Laporan Arus Kas</a>
                    </li>
                    <li class="nav-item"><a href="{{ route("report.laba_rugi") }}"
                            class="nav-link {{ Request::is("laporan/laba-rugi") ? "active" : "" }}">Laporan Laba
                            Rugi</a></li>
                    <li class="nav-item"><a href="{{ route("report.perubahan_modal") }}"
                            class="nav-link {{ Request::is("laporan/perubahan-modal") ? "active" : "" }}">Perubahan
                            Modal</a></li>
                    <li class="nav-item"><a href="{{ route("report.neraca") }}"
                            class="nav-link {{ Request::is("laporan/neraca") ? "active" : "" }}">Neraca</a></li>
                </ul>

                @yield("content")

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
