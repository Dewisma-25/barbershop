<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Barbershop')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; scroll-behavior: smooth; }
        
        body { 
            font-family: 'Poppins', sans-serif; 
            background: #0f0f0f;
            color: #fff;
        }

        /* Navbar */
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

        .nav-user {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.85rem;
            margin-right: 15px;
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

        main { padding-top: 60px; }

        @media (max-width: 991px) {
            .navbar-collapse {
                background: rgba(15, 15, 15, 0.98);
                padding: 20px;
                border-radius: 10px;
                margin-top: 10px;
            }
            .nav-link { margin: 8px 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

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
                    <li class="nav-item"><a class="nav-link" href="/user/dashboard">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/user/dashboard#service">Service</a></li>
                    <li class="nav-item"><a class="nav-link" href="/user/dashboard#contact">Contact</a></li>
                </ul>
                
                <ul class="navbar-nav align-items-center">
                    @auth
                        <li class="nav-user d-none d-md-block">
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

    <main>@yield('content')</main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>