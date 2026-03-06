<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbershop Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: #1a1a1a;
        }

        .dashboard-container {
            min-height: 100vh;
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.8)), 
                              url('https://img.freepik.com/premium-photo/black-barber-tools-barber-shop-professional-barber-hair-cutting-scissors-thinning-shears-hairdresser-concept-black-background_275559-24282.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
        }

        /* Logo Section */
        .brand-section {
            position: absolute;
            top: 30px;
            left: 40px;
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 10;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            position: relative;
        }

        .scissors-icon {
            width: 100%;
            height: 100%;
            filter: brightness(0) invert(1);
        }

        .brand-text {
            color: #fff;
            font-size: 1.3rem;
            font-weight: 600;
            letter-spacing: 1px;
        }

        /* Main Content */
        .main-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex: 1;
            width: 100%;
            max-width: 1200px;
        }

        /* Booking Button */
        .booking-wrapper {
            margin-bottom: 80px;
        }

        .btn-booking {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            padding: 18px 60px;
            font-size: 1.3rem;
            font-weight: 600;
            border-radius: 50px;
            text-transform: none;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .btn-booking:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.6);
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
            color: #fff;
        }

        /* Info Cards Container */
        .info-container {
            width: 100%;
            max-width: 900px;
            background: rgba(30, 30, 30, 0.85);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 35px 45px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
        }

        .info-item {
            text-align: center;
        }

        .info-label {
            display: inline-block;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            letter-spacing: 0.5px;
        }

        .info-content {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
            line-height: 1.6;
            font-weight: 400;
        }

        .info-content i {
            margin-right: 8px;
            color: #fff;
        }

        .contact-link {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-link:hover {
            color: #fff;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .brand-section {
                left: 20px;
                top: 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 25px;
            }

            .info-container {
                padding: 30px 25px;
            }

            .btn-booking {
                padding: 16px 45px;
                font-size: 1.1rem;
            }

            .booking-wrapper {
                margin-bottom: 50px;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .booking-wrapper {
            animation: fadeInUp 0.8s ease;
        }

        .info-container {
            animation: fadeInUp 0.8s ease 0.2s both;
        }

        .brand-section {
            animation: fadeInUp 0.8s ease;
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <!-- Brand Logo -->
        <div class="brand-section">
            <div class="brand-icon">
                <svg class="scissors-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="6" cy="6" r="3"></circle>
                    <circle cx="6" cy="18" r="3"></circle>
                    <line x1="20" y1="4" x2="8.12" y2="15.88"></line>
                    <line x1="14.47" y1="14.48" x2="20" y2="20"></line>
                    <line x1="8.12" y1="8.12" x2="12" y2="12"></line>
                </svg>
            </div>
            <span class="brand-text">Barbershop</span>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Booking Button -->
            <div class="booking-wrapper">
                <button class="btn btn-booking">Booking now</button>
            </div>

            <!-- Info Cards -->
            <div class="info-container">
                <div class="info-grid">
                    <!-- Contact -->
                    <div class="info-item">
                        <span class="info-label">Contact</span>
                        <div class="info-content">
                            <i class="bi bi-telephone"></i>
                            <a href="tel:+6285738540804" class="contact-link">+62 857-3854-0804</a>
                        </div>
                    </div>

                    <!-- Service -->
                    <div class="info-item">
                        <span class="info-label">Service</span>
                        <div class="info-content">
                            haircut and hairstyle
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="info-item">
                        <span class="info-label">Location</span>
                        <div class="info-content">
                            Jl.Teuku Umar Barat.<br>
                            Gn Lumut
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>