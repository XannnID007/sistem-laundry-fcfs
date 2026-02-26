<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Sistem Manajemen Laundry RedDoorz" />
    <meta name="author" content="RedDoorz" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'RedDoorz Laundry System')</title>

    <link rel="icon" href="{{ asset('assets/img/icon.ico') }}" type="image/x-icon" />

    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['{{ asset('assets/css/fonts.min.css') }}']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <link rel="stylesheet" href="{{ asset('assets/js/plugin/datepicker/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugin/chosen/css/chosen.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/atlantis.min.css') }}">

    <style>
        /* TEMA: ROYAL PURPLE (Harmonis dengan Sidebar) */
        :root {
            --primary-color: #6861CE;
            /* Ungu Utama (Atlantis Style) */
            --secondary-color: #5C55BF;
            /* Ungu Gelap */
            --accent-color: #48ABF7;
            /* Biru Muda untuk variasi */
            --light-bg: #F2F1FA;
            /* Background Ungu Pudar */
            --text-main: #2a2f5b;
            /* Warna teks biru-ungu tua */
            --soft-shadow: 0 5px 15px rgba(104, 97, 206, 0.1);
            --hover-shadow: 0 8px 25px rgba(104, 97, 206, 0.25);
        }

        body {
            color: var(--text-main);
            font-family: 'Lato', sans-serif;
        }

        /* --- SIDEBAR & NAVBAR FIX --- */
        /* Pastikan header menggunakan ungu */
        .logo-header,
        .navbar-header {
            background: var(--primary-color) !important;
            background: linear-gradient(-45deg, var(--secondary-color), var(--primary-color)) !important;
        }

        /* Sidebar Active State (Matching) */
        .sidebar .nav>.nav-item.active>a {
            background: var(--primary-color) !important;
            box-shadow: 0 4px 10px rgba(104, 97, 206, 0.4) !important;
        }

        .sidebar .nav>.nav-item.active>a:hover {
            background: var(--secondary-color) !important;
        }

        .sidebar .nav>.nav-item a:hover {
            color: var(--primary-color) !important;
            background-color: var(--light-bg);
        }

        /* --- COMPONENTS --- */
        /* Cards */
        .card {
            border-radius: 15px;
            border: none;
            box-shadow: var(--soft-shadow);
            margin-bottom: 25px;
        }

        /* Buttons */
        .btn-primary,
        .btn-secondary {
            background: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            border-radius: 50px;
            /* Tombol bulat lebih modern */
            font-weight: 600;
        }

        .btn-primary:hover {
            background: var(--secondary-color) !important;
            box-shadow: 0 5px 15px rgba(104, 97, 206, 0.4);
            transform: translateY(-2px);
        }

        /* Icons & Text */
        .text-primary {
            color: var(--primary-color) !important;
        }

        .icon-primary {
            background: var(--primary-color) !important;
            color: #fff;
        }

        .badge-primary {
            background: var(--primary-color);
        }

        /* --- KHUSUS DASHBOARD STATUS CARD (BARU) --- */
        .card-status-gradient {
            background: linear-gradient(135deg, #6861CE 0%, #9B59B6 100%);
            color: white;
            overflow: hidden;
            position: relative;
        }

        /* Efek lingkaran dekorasi di background */
        .card-status-gradient::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .card-status-gradient::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        /* Indikator Live Pulse */
        .live-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            background-color: #2ecc71;
            border-radius: 50%;
            margin-right: 8px;
            box-shadow: 0 0 0 rgba(46, 204, 113, 0.4);
            animation: pulse-green 2s infinite;
        }

        @keyframes pulse-green {
            0% {
                box-shadow: 0 0 0 0 rgba(46, 204, 113, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(46, 204, 113, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(46, 204, 113, 0);
            }
        }

        /* Kotak Statistik Transparan */
        .stat-glass-box {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            transition: transform 0.2s;
        }

        .stat-glass-box:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-3px);
        }

        .bg-primary,
        .table-head-bg-primary thead th {
            background: var(--primary-color) !important;
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            color: #ffffff !important;
        }
    </style>

    @stack('styles')
</head>

<body>
    <div class="wrapper">
        @include('layouts.header')
        @include('layouts.sidebar')

        <div class="main-panel">
            <div class="content">
                @yield('content')
            </div>
            @include('layouts.footer')
        </div>
    </div>

    <div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-sign-out-alt mr-2"></i>Konfirmasi Logout</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center py-4">
                    <p class="mb-0 text-muted">Apakah Anda yakin ingin mengakhiri sesi ini?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light btn-round px-4" data-dismiss="modal">Batal</button>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-round px-4">Ya, Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/atlantis.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var tableIds = ['#basic-datatables', '#multi-filter-select', '#add-row'];
            $.each(tableIds, function(index, id) {
                if ($(id).length > 0 && $.fn.DataTable.isDataTable(id)) {
                    $(id).DataTable().destroy();
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
