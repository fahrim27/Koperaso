<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Koperasi Untung Bareng</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('public/admin/template') }}/vendors/feather/feather.css">
    <link rel="stylesheet" href="{{ asset('public/admin/template') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('public/admin/template') }}/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->


    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet"
        href="{{ asset('public/admin/template') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="{{ asset('public/admin/template') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/template') }}/js/select.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('public/admin/template') }}/vendors/select2/select2.min.css">
    <link rel="stylesheet"
        href="{{ asset('public/admin/template') }}/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('public/admin/template') }}/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{--  <link rel="shortcut icon" href="{{ url('') }}/public/logokop.png" />  --}}
    <link href="{{ asset('public/landing/assets') }}/img/favicon.png" rel="icon">

    <script>
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
        }
    </script>
    </script>
    <script type="text/javascript" class="init">
        $(document).ready(function() {
            var table = $('#tabel-data').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/id.json',
                },
                pageLength: 100,
            });
            var table2 = $('#tabel-data-2').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/id.json',
                },
                pageLength: 100,
            });
            var table2 = $('#tabel-data-3').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/id.json',
                },
                pageLength: 100,
            });

            var table = $('#tabel-data-tagih').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/id.json',
                },
                fixedColumns: {
                    left: 1
                },
                pageLength: 100,
            });


            var table2 = $('#tabel-data-4').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/id.json',
                },
                pageLength: 100,
            });
            var table2 = $('#tabel-data-5').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/id.json',
                },
                pageLength: 100,
            });



            var rupiah = document.getElementById('nominal');
            rupiah.addEventListener('focus', function(e) {
                rupiah.value = formatRupiah(this.value, '');
            });
        });
    </script>
    <script type="text/javascript">
        function printReport() {
            var prtContent = document.getElementById("reportPrinting");
            var WinPrint = window.open();
            WinPrint.document.write(prtContent.innerHTML);
            document.write(
                "<link rel='stylesheet' href='{{ asset('public/admin/template') }}/css/vertical-layout-light/style.css' type='text/css' media='screen'/>"
            );
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        }
    </script>

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="{{ url('/') }}"><img
                        src="{{ url('') }}/public/logokop.png" class="mr-2" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}"><img
                        src="{{ url('') }}/public/logokop.png" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-search d-none d-lg-block">
                        <div class="input-group">
                            <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                                <span class="input-group-text" id="search">
                                    <i class="fa fa-calendar fa-fw"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="navbar-search-input" disabled
                                value="{{ periodeTagihan('periode_tag') }}" aria-label="search"
                                aria-describedby="search">
                        </div>                        
                    </li>
                </ul>

                <ul class="navbar-nav navbar-nav-right">
                    {{--  <li class="nav-item dropdown">
                        <a class="nav-link count-indicator" href="#">
                        <i class="ti-shopping-cart mx-0"></i>
                        <span class="count"></span>
                        </a>
                    </li>  --}}

                    @if (companySetting('is_notification') == 1)
                        <li class="nav-item dropdown">
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                                data-toggle="dropdown">
                                <i class="ti-bell mx-0"></i>

                                @if (notifHelper('Admin', 'All') > 0)
                                    <span class="count"></span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="notificationDropdown">
                                <p class="mb-0 font-weight-bold float-left dropdown-header">Notifikasi
                                </p>
                                @if (notifHelper('Admin', 'All') > 0)
                                    @foreach (notifHelper('Admin', 'new_anggota') as $k)
                                        <a href="{{ url('/admin/notification/update/' . $k->id) }}"
                                            class="dropdown-item preview-item">
                                            @switch($k->jenis)
                                                @case('Anggota')
                                                    :
                                                    <div class="preview-thumbnail">
                                                        <div class="preview-icon bg-info">
                                                            <i class="ti-user mx-0"></i>
                                                        </div>
                                                    </div>
                                                @break

                                                @case('Pinjaman')
                                                    :
                                                    <div class="preview-thumbnail">
                                                        <div class="preview-icon bg-primary">
                                                            <i class="ti-receipt mx-0"></i>
                                                        </div>
                                                    </div>
                                                @break

                                                @case('Pengajuan')
                                                    :
                                                    <div class="preview-thumbnail">
                                                        <div class="preview-icon bg-warning">
                                                            <i class="ti-clipboard mx-0"></i>
                                                        </div>
                                                    </div>
                                                @break

                                                @case('Simpanan')
                                                    :
                                                    <div class="preview-thumbnail">
                                                        <div class="preview-icon bg-success">
                                                            <i class="ti-wallet mx-0"></i>
                                                        </div>
                                                    </div>
                                                @break

                                                @case('Setoran')
                                                    :
                                                    <div class="preview-thumbnail">
                                                        <div class="preview-icon bg-success">
                                                            <i class="ti-info mx-0"></i>
                                                        </div>
                                                    </div>
                                                @break

                                                @default
                                            @endswitch

                                            <div class="preview-item-content">
                                                <h6 class="preview-subject font-weight-normal">
                                                    @if ($k->jenis == 'Setoran')
                                                        {{ $k->keterangan }}
                                                    @else
                                                        {{ $k->Anggota->nama_anggota }} {{ $k->keterangan }}
                                                    @endif

                                                </h6>
                                                <p class="font-weight-light small-text mb-0 text-muted">
                                                    {{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('d F Y') }}
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach

                                    <a href="{{ url('/admin/notification/readall/') }}">
                                        <p class="mb-0 font-weight-bold float-right dropdown-header text-info">Tandai
                                            semua dibaca
                                        </p>
                                    </a>
                                @else
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-item-content">
                                            <h6 class="preview-subject font-weight-normal">
                                                Tidak ada pemberitahuan
                                            </h6>
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </li>
                    @endif

                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"
                            id="profileDropdown">
                            <img src="https://png.pngtree.com/png-vector/20191103/ourlarge/pngtree-handsome-young-guy-avatar-cartoon-style-png-image_1947775.jpg"
                                alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            
                            <a class="dropdown-item" href="{{ url('/admin/edit_profil') }}">
                                <i class="ti-settings text-primary"></i>
                                Update Profile
                            </a>
                            <a href="{{ route('logout') }}" class="dropdown-item"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>

                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/dashboard') }}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    @if (userHelpers('department') == 'ADMIN')
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#master" aria-expanded="false"
                                aria-controls="master">
                                <i class="icon-layout menu-icon"></i>
                                <span class="menu-title">Data Master</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="master">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/admin/ms_perusahaan') }}">Data
                                            Perusahaan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/admin/ms_department') }}">Data
                                            Departement</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/admin/ms_jabatan') }}">Data Level
                                            Jabatan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/admin/simp_master') }}">Data Simpanan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/admin/pby_master') }}">Data Pinjaman</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/admin/master_user') }}">Data Users</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/admin/setting') }}">Pengaturan</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif

                    @if (userHelpers('department') == 'HR' || userHelpers('department') == 'ADMIN' || userHelpers('department') == 'USP')
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#anggota" aria-expanded="false"
                                aria-controls="anggota">
                                <i class="icon-bar-graph menu-icon"></i>
                                <span class="menu-title">Keanggotaan</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="anggota">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/admin/master_anggota') }}">Data
                                            Anggota</a>
                                    </li>
                                    @if (userHelpers('department') == 'HR' || userHelpers('department') == 'ADMIN')
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('/admin/master_anggota/verifikasi_anggota') }}">Verifikasi
                                                Anggota</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                    @endif

                    @if (userHelpers('department') == 'ADMIN' || userHelpers('department') == 'USP')
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false"
                                aria-controls="charts">
                                <i class="icon-bar-graph menu-icon"></i>
                                <span class="menu-title">Simpanan</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="charts">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/admin/simp_rekening') }}">Data
                                            Rekening</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/admin/simp_mutasi') }}"> Transaksi
                                            Simpanan
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/admin/simp_verifikasi') }}"> Verifikasi
                                            Setoran </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/admin/lap_simpanan') }}"> Nominatif Simpanan </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                    @endif

                    @if (userHelpers('department') == 'ADMIN' || userHelpers('department') == 'USP' || userHelpers('department') == 'HR')
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#pinjaman" aria-expanded="false"
                                aria-controls="pinjaman">
                                <i class="icon-bar-graph menu-icon"></i>
                                <span class="menu-title">Pinjaman</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="pinjaman">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/admin/pengajuan') }}">Pengajuan
                                            Pinjaman</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/admin/pencairan') }}">Pencairan
                                            Pinjaman</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/admin/pby_rekening') }}"> Data Pinjaman
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/admin/lap_pinjaman') }}"> Nominatif Pinjaman </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#autotagih" aria-expanded="false"
                                aria-controls="autotagih">
                                <i class="icon-bar-graph menu-icon"></i>
                                <span class="menu-title">Auto Tagih</span>
                                <i class="menu-arrow"></i>
                            </a>

                            <div class="collapse" id="autotagih">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ url('/admin/autotagih') }}">Proses
                                            Auto Tagih</a></li>

                                </ul>
                            </div>
                        </li>
                    @endif

                    @if (userHelpers('department') == 'ADMIN' || userHelpers('department') == 'USP')
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#akunting" aria-expanded="false"
                                aria-controls="akunting">
                                <i class="icon-bar-graph menu-icon"></i>
                                <span class="menu-title">Akunting</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="akunting">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ url('/admin/master_akun') }}">Master Akun</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ url('/admin/mutasi_kas') }}">Transaksi Kas</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ url('/admin/memorial') }}">Transaksi Memorial</a></li>
                                    {{--  <li class="nav-item"><a class="nav-link" href="{{ url('/admin/shu') }}">Pembagian SHU</a></li>  --}}

                                </ul>
                            </div>
                        </li>
                    @endif

                    @if (userHelpers('department') == 'ADMIN' || userHelpers('department') == 'UJB')
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#jual-beli" aria-expanded="false"
                                aria-controls="jual-beli">
                                <i class="icon-columns menu-icon"></i>
                                <span class="menu-title">Unit Jual Beli</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="jual-beli">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ url('/admin/master_produk') }}">Master Produk</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ url('/admin/pembelian') }}">Pembelian</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ url('/admin/purchasing') }}">Data
                                            Pesanan</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                        href="{{ url('/admin/lap_penjualan') }}">Laporan Penjualan</a></li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    @if (userHelpers('department') == 'ADMIN' || userHelpers('department') == 'USP')
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#lap-akunting" aria-expanded="false"
                                aria-controls="lap-akunting">
                                <i class="icon-columns menu-icon"></i>
                                <span class="menu-title">Laporan Akunting</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="lap-akunting">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ url('/admin/lap_akunting/lapjurnal') }}">Laporan Jurnal</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ url('/admin/lap_akunting/bukubesar') }}">Laporan Buku Besar</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ url('/admin/lap_akunting/aruskas') }}">Laporan Arus Kas</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                        href="{{ url('/admin/lap_akunting/neracasaldo') }}">Laporan Neraca</a>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ url('/admin/lap_akunting/labarugi') }}">Laporan Laba Rugi</a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/closing') }}">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Closing Bulanan</span>
                        </a>
                    </li>



                    {{--  
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#pengaturan" aria-expanded="false"
                            aria-controls="pengaturan">
                            <i class="icon-columns menu-icon"></i>
                            <span class="menu-title">Pengatuan</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="pengaturan">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ route('pengaturan.index') }}">Pengaturan Umum</a></li>
                            </ul>
                        </div>
                    </li>  --}}


                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content-app')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023.
                            Alta Media Software All rights reserved.</span>
                        {{-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span> --}}
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <script>
        $(function() {
            var rupiah = document.getElementById('nominal');
            rupiah.addEventListener('keyup', function(e) {
                rupiah.value = formatRupiah(this.value, '');
            });
            var rupiah2 = document.getElementById('nominal2');
            rupiah2.addEventListener('keyup', function(e) {
                rupiah2.value = formatRupiah(this.value, '');
            });
        });

        $('input[type=radio]').change(function(evt) {
            $('.changename').html($(this).data('description'));
        });
    </script>
    {{--  <script>
        function increaseQty(cartId) {
            qty = $('#input-quantity-' + cartId).val();
            newQty = parseInt(qty)+1;
            $.ajax({
                url: "{{ route('update.list') }}",
                type: "PATCH",
                data: {
                    cart_id: cartId,
                    quantity: newQty,
                    _token: $('meta[name="csrf-token"]').attr('content') 
                },
                success: function(response) {
                    console.log(response.message);
                    location.reload(); // Reload halaman setelah update berhasil
                },
                error: function(xhr) {
                    console.log(cartId);
                    alert(xhr.responseJSON.error);
                }
            });
        }
        function decreaseQty(cartId) {
            qty = $('#input-quantity-' + cartId).val();
            if (qty>1){
                newQty = parseInt(qty)-1;
            }else{
                newQty = 1;
            }
           
            $.ajax({
                url: "{{ route('update.list') }}",
                type: "PATCH",
                data: {
                    cart_id: cartId,
                    quantity: newQty,
                    _token: $('meta[name="csrf-token"]').attr('content') 
                },
                success: function(response) {
                    console.log(response.message);
                    location.reload(); // Reload halaman setelah update berhasil
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.error);
                }
            });
        }
    </script>  --}}

    <!-- plugins:js -->
    <script src="{{ asset('public/admin/template') }}/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('public/admin/template') }}/vendors/chart.js/Chart.min.js"></script>
    <script src="{{ asset('public/admin/template') }}/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{ asset('public/admin/template') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="{{ asset('public/admin/template') }}/js/dataTables.select.min.js"></script>


    <script src="{{ asset('public/admin/template') }}/vendors/select2/select2.min.js"></script>
    <script src="{{ asset('public/admin/template') }}/js/select2.js"></script>


    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('public/admin/template') }}/js/off-canvas.js"></script>
    <script src="{{ asset('public/admin/template') }}/js/hoverable-collapse.js"></script>
    <script src="{{ asset('public/admin/template') }}/js/template.js"></script>
    <script src="{{ asset('public/admin/template') }}/js/file-upload.js"></script>

    <script src="{{ asset('public/admin/template') }}/js/settings.js"></script>
    <script src="{{ asset('public/admin/template') }}/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('public/admin/template') }}/js/tabs.js"></script>
    <script src="{{ asset('public/admin/template') }}/js/dashboard.js"></script>
    <script src="{{ asset('public/admin/template') }}/js/Chart.roundedBarCharts.js"></script>

</body>

</html>
