<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ companySetting('nama_koperasi') }}</title>
    {{--  <link rel="shortcut icon" href="{{ url('') }}/public/logokop.png" />  --}}
    <link href="{{ asset('public/landing/assets') }}/img/favicon.png" rel="icon">
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('public/admin/template') }}/vendors/feather/feather.css">
    <link rel="stylesheet" href="{{ asset('public/admin/template') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('public/admin/template') }}/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->


    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('public/admin/template') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="{{ asset('public/admin/template') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/template') }}/js/select.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('public/admin/template') }}/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('public/admin/template') }}/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('public/admin/template') }}/css/vertical-layout-light/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
    <link rel="shortcut icon" href="{{ url('') }}/public/logokop.png" />
    <style>
        hr {
            display: block;
            height: 2px;
            background: black;
            width: 100%;
            border: none;
            border-top: solid 1px #aaa;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="main-panel">
        <div class="container">
            <table border="0">
                <tr align="center">
                    <td rowspan="4">
                        <img src="{{ asset('public/landing/assets') }}/img/logokop.png" alt=""
                width="200px">
                    </td>
                </tr>
                <tr>
                    <td width="75%">
                        <h3><b>{{ companySetting('nama_koperasi') }}</b></h3>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>{{  companySetting('alm_koperasi') }}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Telp. {{ companySetting('tlp_koperasi') }} - Email : {{ companySetting('email_koperasi') }} / {{ companySetting('web_koperasi') }}</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            {{--  <br>  --}}
            @yield('content-app')
            </div>
    </div>
</body>
</html>