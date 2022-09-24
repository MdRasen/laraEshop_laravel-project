<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/base/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('assets/admin/images/favicon.png')}}" />

    <style>
        .table-img{
            width: 50px !important;
            height: 50px !important;
            border-radius: 0% !important;
        }
        .content-wrapper{
            padding: 15px !important;
        }

        .height{
        height: 15vh;
       }
       
       .search{
       position: relative;
       }

       .search input{
        height: 40px;
        text-indent: 25px;
       }

       .search .mdi-magnify{
        position: absolute;
        top: 5px;
        left: 16px;
       }

       .search button{
        position: absolute;
        top: 0px;
        right: 0px;
        height: 40px;
        background: #4D83FF;
       }

       .form-group{
        margin-bottom: 0.8rem !important;
       }
    </style>

</head>
<body>

    <div class="container-scroller">
        @include('layouts.inc.customer-navbar')

        <div class="container-fluid page-body-wrapper">
            @include('layouts.inc.customer-sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>

                <div>
                    @include('layouts.inc.customer-footer')
                </div>
            </div>
        </div>
    </div>

     <!-- plugins:js -->
    <script src="{{asset('assets/admin/vendors/base/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="{{asset('assets/admin/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('assets/admin/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{asset('assets/admin/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/admin/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('assets/admin/js/template.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{asset('assets/admin/js/dashboard.js')}}"></script>
    <script src="{{asset('assets/admin/js/data-table.js')}}"></script>
    <script src="{{asset('assets/admin/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/admin/js/dataTables.bootstrap4.js')}}"></script>
    <!-- End custom js for this page-->

    @yield('scripts')
</body>
</html>