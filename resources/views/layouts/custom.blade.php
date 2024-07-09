<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') - </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-light-layout/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo_polinema.png" ') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        @yield('content')
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js"') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js"></scrip') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js"></scrip') }}"></script>
    <script src="{{ asset('assets/js/misc.js"></scrip') }}"></script>
    <script src="{{ asset('assets/js/settings.js"></scrip') }}"></script>
    <scrip src="{{ asset('assets/js/todolist.js"></scrip') }}">
        </script>
        <!-- endinject -->
</body>

</html>
