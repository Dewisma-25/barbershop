<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Barbershop')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; scroll-behavior: smooth; }
        
        body { 
            font-family: 'Poppins', sans-serif; 
            background: #0f0f0f;
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main { flex: 1; padding-top: 60px; }

        /* ===== NAVBAR ===== */
        .navbar {
            background: rgba(15, 15, 15, 0.15);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 12px 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar-brand {
            color: #fff !important;
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.7) !important;
            font-size: 0.9rem;
            margin: 0 15px;
            transition: color 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            color: #fff !important;
        }

        .btn-nav {
            padding: 6px 18px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-outline-light {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            margin-right: 8px;
        }

        .btn-outline-light:hover { background: rgba(255, 255, 255, 0.1); }

        .btn-light {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .btn-light:hover { background: rgba(255, 255, 255, 0.2); }

        .btn-danger {
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid rgba(220, 53, 69, 0.4);
            color: #ff6b6b;
        }

        .btn-danger:hover { background: rgba(220, 53, 69, 0.3); }

        /* ===== FOOTER ===== */
        .footer {
            background: #0a0a0a;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding: 50px 0 20px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .footer-brand i { font-size: 1.8rem; }
        .footer-brand span { font-size: 1.2rem; font-weight: 600; }

        .footer-service h4, .footer-contact h4 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .footer-contact small {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.75rem;
            display: block;
            margin-bottom: 15px;
        }

        .footer-service ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-service li { margin-bottom: 8px; }

        .footer-service a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .footer-service a:hover { color: #fff; }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.85rem;
        }

        .contact-item i {
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .contact-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        .contact-item a:hover { color: #fff; }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            margin-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.85rem;
        }

        @media (max-width: 768px) {
            .footer-service, .footer-contact { margin-bottom: 30px; }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <img src="{{asset('images/Babershop (4).png')}}" alt="Logo" width="130">
            </a>
            
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="/user/dashboard#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/user/dashboard#service">Service</a></li>
                    <li class="nav-item"><a class="nav-link" href="/user/dashboard#review">Review</a></li>
                </ul>
                
                <ul class="navbar-nav align-items-center">
                    @auth
                        <li class="nav-user d-none d-md-block me-3">
                            Halo, <strong>{{ Auth::user()->username }}</strong>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn-nav btn-danger">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}" class="btn-nav btn-outline-light">Login</a>
                            <a href="{{ route('register') }}" class="btn-nav btn-light">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>@yield('content')</main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                
                <!-- Brand & Service -->
                <div class="col-md-4 col-6">
                    <div class="footer-brand">
                        <a class="navbar-brand" href="#home">
                            <img src="{{asset('images/Babershop (4).png')}}" alt="Logo" width="130">
                        </a>
                    </div>
                    
                    <div class="footer-service">
                        <h4>Service</h4>
                        <ul>
                            <li><a href="#service">basic haircut</a></li>
                            <li><a href="#service">premium haircut</a></li>
                            <li><a href="#service">highlight / bleaching</a></li>
                            <li><a href="#service">hair styling</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Media Sosial -->
                <div class="col-md-4 col-6">
                    <div class="footer-contact">
                        <h4>Contact Us</h4>
                        <small>Social media</small>
                        
                        <div class="contact-item">
                            <i class="bi bi-telephone-fill"></i>
                            <a href="https://wa.me/62881037303437" target="_blank">+62 881-0373-03437</a>
                        </div>
                        
                        <div class="contact-item">
                            <i class="bi bi-instagram"></i>
                            <a href="https://instagram.com/barbershop.id" target="_blank">barbershop.id</a>
                        </div>
                        
                        <div class="contact-item">
                            <i class="bi bi-twitter"></i>
                            <a href="https://twitter.com/barbershop.id" target="_blank">barbershop.id</a>
                        </div>
                        
                        <div class="contact-item">
                            <i class="bi bi-tiktok"></i>
                            <a href="https://tiktok.com/@barbershop.id" target="_blank">barbershop.id</a>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-md-4 col-12">
                    <div class="footer-contact mt-4 mt-md-0">
                        <h4>Contact</h4>
                        <small>&nbsp;</small>
                        
                        <div class="contact-item">
                            <i class="bi bi-telephone"></i>
                            <a href="tel:+6281999581880">+62819-9958-1880</a>
                        </div>
                        
                        <div class="contact-item">
                            <i class="bi bi-envelope"></i>
                            <a href="mailto:barbershopid@gmail.com">barbershopid@gmail.com</a>
                        </div>
                        
                        <div class="contact-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>Jl.Teuku Umar Barat, Gn Lumut</span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 BarberShop</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>