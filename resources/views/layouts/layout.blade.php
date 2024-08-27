<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Inventory Manager</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href={{ asset('assets/img/invlogo.png') }} rel="icon">
    <link href={{ asset('assets/img/apple-touch-icon.png') }} rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href={{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <link href={{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }} rel="stylesheet">
    <link href={{ asset('assets/vendor/aos/aos.css') }} rel="stylesheet">
    <link href={{ asset('assets/vendor/swiper/swiper-bundle.min.css') }} rel="stylesheet">
    <link href={{ asset('assets/vendor/glightbox/css/glightbox.min.css') }} rel="stylesheet">

    <!-- Main CSS File -->
    <link href={{ asset('assets/css/main.css') }} rel="stylesheet">

    <!-- =======================================================
  * Template Name: Appland
  * Template URL: https://bootstrapmade.com/free-bootstrap-app-landing-page-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src=assets/img/logo.png" alt=""> -->
                <h1 class="sitename">Inventory Manager</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="nav-link" data-section="hero">Home</a></li>
                    <li><a href="#features" class="nav-link" data-section="features">Features</a></li>
                    <li><a href="#about" class="nav-link" data-section="about">About</a></li>
                    <li><a href="https://github.com/devin4713">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>
    </header>

    @yield('content')

    <footer id="footer" class="footer">

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">QR Inventory</strong> <span>All Rights
                    Reserved</span></p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Created by <a href="https://github.com/devin4713">Devin Sanyoka</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src={{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <script src={{ asset('assets/vendor/php-email-form/validate.js') }}></script>
    <script src={{ asset('assets/vendor/aos/aos.js') }}></script>
    <script src={{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}></script>
    <script src={{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}></script>

    <!-- Main JS File -->
    <script src={{ asset('assets/js/main.js') }}></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('#navmenu .nav-link');

            links.forEach(link => {
                link.addEventListener('click', function(event) {
                    const section = this.getAttribute('data-section');
                    const targetElement = document.querySelector(`#${section}`);

                    if (!targetElement) {
                        event.preventDefault();
                        const homeUrl = '{{ route('home') }}';
                        window.location.href = `${homeUrl}#${section}`;
                    }
                });
            });
        });
    </script>

</body>

</html>
