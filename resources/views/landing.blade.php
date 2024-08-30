@extends('layouts.layout')
@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
                        <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
                    </div>
                    <div class="col-lg-6  d-flex flex-column justify-content-center text-center text-md-start"
                        data-aos="fade-in">
                        <h2>Welcome to Inventory Manager</h2>
                        <p>Manage your inventory with ease using QR code.</p>
                        <div class="d-flex mt-4 justify-content-center justify-content-md-start">
                            @auth
                            <a href="{{ route('scan.cam') }}" class="download-btn"><i class="bi bi-camera"></i> <span>Scan Inventory</span></a>
                            <a href="{{ route('add.cam') }}" class="download-btn"><i class="bi bi-plus"></i> <span>Add Inventory</span></a>
                            @else
                            <a href="{{ route('login') }}" class="download-btn"><i class="bi bi-key"></i> <span>Login</span></a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- Features Section -->
        <section id="features" class="features section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Features</h2>
                <p>Scan, store, and edit information in your inventory list.</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-5">

                    <div class="col-xl-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="100">
                        <img src="assets/img/features-2.png" class="img-fluid" alt="">
                    </div>

                    <div class="col-xl-7 d-flex" data-aos="fade-up" data-aos-delay="200">

                        <div class="row align-self-center gy-5">

                            <div class="col-md-6 icon-box">
                                <i class="bi bi-camera"></i>
                                <div>
                                    <h4><a href="{{ route('scan.cam') }}"
                                            style="text-decoration: none; color: inherit;">Scan</a></h4>
                                    <p>Scan the QR code of your inventory to see the details easily.</p>
                                </div>
                            </div><!-- End Feature Item -->

                            <div class="col-md-6 icon-box">
                                <i class="bi bi-plus"></i>
                                <div>
                                    <h4><a href="{{ route('add.cam') }}"
                                            style="text-decoration: none; color: inherit;">Add</a></h4>
                                    <p>Scan the QR code of your inventory to add it to the database.</p>
                                </div>
                            </div><!-- End Feature Item -->

                            <div class="col-md-6 icon-box">
                                <i class="bi bi-pencil"></i>
                                <div>
                                    <h4><a href="{{ route('edit.cam') }}"
                                            style="text-decoration: none; color: inherit;">Edit</a></h4>
                                    <p>You can also edit your inventory list.</p>
                                </div>
                            </div><!-- End Feature Item -->

                            <div class="col-md-6 icon-box">
                                <i class="bi bi-list"></i>
                                <div>
                                    <h4><a href="{{ route('list.page') }}"
                                            style="text-decoration: none; color: inherit;">Your List</a></h4>
                                    <p>See all of your saved inventory list here.</p>
                                </div>
                            </div><!-- End Feature Item -->

                        </div>

                    </div>

                </div>

            </div>

        </section><!-- /Features Section -->

        <!-- About Section -->
        <section id="about" class="about section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>About</h2>
                <p>This application was developed to make inventory management easier and more efficient.</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                        <p>
                            Technology used in this application development:
                        </p>
                        <ul>
                            <li><i class="bi bi-check2-circle"></i> <span>Laravel: A robust PHP framework for building web
                                    applications.</span></li>
                            <li><i class="bi bi-check2-circle"></i> <span>JavaScript: For handling asynchronous operations
                                    and enhancing user interactions.</span></li>
                            <li><i class="bi bi-check2-circle"></i> <span>SQL Database: To store and manage all inventory
                                    data securely.</span></li>
                            <li><i class="bi bi-check2-circle"></i> <span>Bootstrap: A CSS framework to ensure a clean and
                                    responsive design.</span></li>
                        </ul>
                    </div>

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <p>This application is built using Laravel, a powerful and flexible PHP framework, designed to
                            handle various tasks efficiently. It leverages modern web technologies like JavaScript for
                            real-time interactivity and utilizes a SQL database integration for data management. The system
                            is designed to simplify inventory management by using QR code scanning to easily add and
                            retrieve item details. With a focus on user-friendly interfaces and reliable performance, this
                            application aims to streamline your inventory processes, making it easier to keep track of your
                            assets.</p>
                    </div>

                </div>

            </div>

        </section><!-- /About Section -->

    </main>
@endsection
