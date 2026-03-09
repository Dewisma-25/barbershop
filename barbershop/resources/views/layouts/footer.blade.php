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

        main { flex: 1; }

        /*FOOTER*/
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

        .footer-brand i {
            font-size: 1.8rem;
        }

        .footer-brand span {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .footer-service h4 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #fff;
        }

        .footer-service ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-service li {
            margin-bottom: 8px;
        }

        .footer-service a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .footer-service a:hover {
            color: #fff;
        }

        .footer-contact h4 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 5px;
            color: #fff;
        }

        .footer-contact small {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.75rem;
            display: block;
            margin-bottom: 15px;
        }

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
            transition: color 0.3s;
        }

        .contact-item a:hover {
            color: #fff;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            margin-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.85rem;
        }

        @media (max-width: 768px) {
            .footer { padding: 40px 20px 20px; }
            .footer-service, .footer-contact { margin-bottom: 30px; }
        }
    </style>
    @stack('styles')
</head>
<body>

    <main>@yield('content')</main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                
                <!-- Brand & Service -->
                <div class="col-md-4 col-6">
                    <div class="footer-brand">
                        <i class="bi bi-scissors"></i>
                        <span>Barbershop</span>
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
                        <h4>Hubungi Kami</h4>
                        <small>Media Sosial</small>
                        
                        <div class="contact-item">
                            <i class="bi bi-telephone-fill"></i>
                            <a href="https://wa.me/62881037303437" target="_blank">+62 881-0373-03437</a>
                        </div>
                        
                        <div class="contact-item">
                            <i class="bi bi-instagram"></i>
                            <a href="https://instagram.com/barbershop.id" target="_blank">barbershop.id</a>
                        </div>
                        
                        <div class="contact-item">
                            <i class="bi bi-twitter-x"></i>
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