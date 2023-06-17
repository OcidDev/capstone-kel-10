<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $title }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Favicons -->
    <link href="{{ asset('/template/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('/template/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    @stack('style')
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('/template/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/template/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('/template/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/template/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('/template/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('/template/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('/template/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Template Main CSS File -->
    <link href="{{ asset('/template/assets/css/style.css') }}" rel="stylesheet">

    <!-- Auto Numerik -->
    <script src="{{ asset('vendor/autoNumeric/src/AutoNumeric.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>





</head>

<body>

    @include('layouts.navbar')

    @include('layouts.sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $judul }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">{{ $judul }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            @yield('contents')
        </section>

    </main><!-- End #main -->

    @include('layouts.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('/template/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/template/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/template/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('/template/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('/template/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('/template/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('/template/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('/template/assets/vendor/php-email-form/validate.js') }}"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('/template/assets/js/main.js') }}"></script>


    @stack('script')
    <script type="text/javascript">
        $('.show-alert-delete-box').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: "Apakah anda yakin ingin menghapus?",
                text: "Data akan hilang selamanya",
                icon: "warning",
                type: "warning",
                buttons: ["Cancel", "Yes!"],
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script>




    <script>
        const swal2 = $('.swal2').data('swal2');
        const swal3 = $('.swal3').data('swal3');

        if (swal2) {
            swal({
                title: "SUKSES !!",
                text: swal2,
                icon: 'success',
            })
        } else if (swal3) {
            swal({
                title: "MAAF !!",
                text: swal3,
                icon: 'error',
            })
        }
    </script>
</body>

</html>
