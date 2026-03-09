@extends('layouts.navbaruser')

@section('title', 'Barbershop - Premium Haircut')

@push('styles')
<style>
    /* ===== HERO SECTION ===== */
    #home {
        min-height: 100vh;
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.8)), 
                    url('{{ asset("images/Latar_Barber.png") }}') center/cover;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 80px 20px;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .hero-subtitle {
        color: rgba(255,255,255,0.7);
        font-size: 1.1rem;
        margin-bottom: 30px;
    }

    .btn-booking {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255,255,255,0.3);
        color: #fff;
        padding: 15px 50px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s;
    }

    .btn-booking:hover {
        background: rgba(255,255,255,0.2);
        transform: translateY(-3px);
        color: #fff;
    }

    .hero-info {
        background: rgba(30,30,30,0.9);
        backdrop-filter: blur(15px);
        border-radius: 15px;
        padding: 25px;
        margin-top: 50px;
        display: flex;
        gap: 50px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .hero-info-item { text-align: center; }
    .hero-info-item i {
        font-size: 1.3rem;
        color: #fff;
        margin-bottom: 8px;
        display: block;
    }
    .hero-info-item small {
        color: rgba(255,255,255,0.6);
        font-size: 0.75rem;
    }
    .hero-info-item p {
        margin: 0;
        font-size: 0.9rem;
    }

    /* ===== SERVICE SECTION ===== */
    #service {
        padding: 60px 20px;
        background: #0f0f0f;
    }

    .section-title {
        text-align: center;
        margin-bottom: 40px;
    }

    .section-title h2 {
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .section-title p {
        color: rgba(255,255,255,0.6);
        font-size: 0.9rem;
    }

    .service-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        max-width: 1100px;
        margin: 0 auto;
    }

    .service-card {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        transition: all 0.3s;
    }

    .service-card:hover {
        background: rgba(255,255,255,0.08);
        transform: translateY(-5px);
    }

    .service-icon {
        width: 60px;
        height: 60px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 1.5rem;
    }

    .service-card h4 {
        font-size: 1rem;
        margin-bottom: 5px;
    }

    .service-card .price {
        color: #4ade80;
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .service-card .time {
        color: rgba(255,255,255,0.5);
        font-size: 0.8rem;
        margin-bottom: 10px;
    }

    .service-card p {
        color: rgba(255,255,255,0.6);
        font-size: 0.85rem;
        margin: 0;
    }

    /* ===== GALLERY SECTION ===== */
    #gallery {
        padding: 40px 20px;
        background: #0a0a0a;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        max-width: 900px;
        margin: 0 auto;
    }

    .gallery-item {
        aspect-ratio: 4/3;
        overflow: hidden;
        border-radius: 10px;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .gallery-item:hover img {
        transform: scale(1.1);
    }

    /* ===== REVIEW SECTION ===== */
    #review {
        padding: 50px 20px;
        background: #0f0f0f;
    }

    .review-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        max-width: 1000px;
        margin: 0 auto;
    }

    .review-card {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 15px;
        padding: 20px;
    }

    .review-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .review-avatar {
        width: 45px;
        height: 45px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }

    .review-meta h5 {
        font-size: 0.95rem;
        margin: 0;
    }

    .review-meta .stars {
        color: #fbbf24;
        font-size: 0.8rem;
    }

    .review-card p {
        color: rgba(255,255,255,0.7);
        font-size: 0.85rem;
        line-height: 1.6;
        margin: 0;
    }

    /* ===== CONTACT SECTION ===== */
    #contact {
        padding: 50px 20px;
        background: #0a0a0a;
    }

    .contact-wrapper {
        max-width: 1000px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }

    .contact-info h3 {
        font-size: 1.3rem;
        margin-bottom: 20px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
        color: rgba(255,255,255,0.8);
        font-size: 0.9rem;
    }

    .contact-item i {
        width: 35px;
        height: 35px;
        background: rgba(255,255,255,0.1);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .contact-form input,
    .contact-form textarea {
        width: 100%;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 10px;
        padding: 12px 15px;
        color: #fff;
        margin-bottom: 12px;
        font-size: 0.9rem;
    }

    .contact-form input::placeholder,
    .contact-form textarea::placeholder {
        color: rgba(255,255,255,0.4);
    }

    .contact-form textarea {
        min-height: 100px;
        resize: none;
    }

    .btn-send {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        color: #fff;
        padding: 12px 30px;
        border-radius: 25px;
        font-size: 0.9rem;
        transition: all 0.3s;
    }

    .btn-send:hover {
        background: rgba(255,255,255,0.2);
    }

    /* Footer */
    footer {
        text-align: center;
        padding: 20px;
        background: #0f0f0f;
        border-top: 1px solid rgba(255,255,255,0.05);
        color: rgba(255,255,255,0.4);
        font-size: 0.8rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title { font-size: 2rem; }
        .hero-info { gap: 25px; }
        .gallery-grid { grid-template-columns: 1fr; }
        .contact-wrapper { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

<!-- ===== HOME / HERO ===== -->
<section id="home">
    <h1 class="hero-title">Barbershop</h1>
    <p class="hero-subtitle">Professional and Affordable</p>
    
    <a href="#service" class="btn btn-booking">Booking Now</a>

    <div class="hero-info">
        <div class="hero-info-item">
            <i class="bi bi-telephone"></i>
            <small>Contact</small>
            <p>+62 857-3854-0804</p>
        </div>
        <div class="hero-info-item">
            <i class="bi bi-scissors"></i>
            <small>Service</small>
            <p>Haircut & Hairstyle</p>
        </div>
        <div class="hero-info-item">
            <i class="bi bi-geo-alt"></i>
            <small>Location</small>
            <p>Jl. Teuku Umar Barat</p>
        </div>
    </div>
</section>

<!-- ===== SERVICE ===== -->
<section id="service">
    <div class="section-title">
        <h2>Our Service</h2>
        <p>Professional and Affordable</p>
    </div>

    <div class="service-grid">
        <div class="service-card">
            <div class="service-icon"><i class="bi bi-scissors"></i></div>
            <h4>Basic Haircut</h4>
            <div class="price">Rp 50.000</div>
            <div class="time"><i class="bi bi-clock"></i> 30 Menit</div>
            <p>Potongan rambut standar dengan hasil rapi dan bersih</p>
        </div>

        <div class="service-card">
            <div class="service-icon"><i class="bi bi-award"></i></div>
            <h4>Premium Haircut</h4>
            <div class="price">Rp 80.000</div>
            <div class="time"><i class="bi bi-clock"></i> 45 Menit</div>
            <p>Potongan premium dengan konsultasi gaya rambut</p>
        </div>

        <div class="service-card">
            <div class="service-icon"><i class="bi bi-droplet"></i></div>
            <h4>Highlight / Bleaching</h4>
            <div class="price">Rp 200.000</div>
            <div class="time"><i class="bi bi-clock"></i> 1 Jam</div>
            <p>Warnai rambut dengan teknik modern dan aman</p>
        </div>

        <div class="service-card">
            <div class="service-icon"><i class="bi bi-wind"></i></div>
            <h4>Hair Styling</h4>
            <div class="price">Rp 60.000</div>
            <div class="time"><i class="bi bi-clock"></i> 60 Menit</div>
            <p>Styling rambut dengan berbagai teknik pomade</p>
        </div>

    </div>
</section>

<!-- ===== GALLERY ===== -->
<section id="gallery">
    <div class="section-title">
        <h2>Our Gallery</h2>
        <p>Portfolio of Our Work</p>
    </div>

    <div class="gallery-grid">
        <div class="gallery-item">
            <img src="{{ asset('images/gallery 1.png') }}" alt="Haircut 1">
        </div>
        <div class="gallery-item">
            <img src="{{ asset('images/gallery 2.png') }}" alt="Barbershop">
        </div>
        <div class="gallery-item">
            <img src="{{ asset('images/gallery 3.png') }}" alt="Haircut 2">
        </div>
        <div class="gallery-item">
            <img src="{{ asset('images/gallery 4.png') }}" alt="Beard">
        </div>
        <div class="gallery-item">
            <img src="{{ asset('images/gallery 5.png') }}" alt="Interior">
        </div>
        <div class="gallery-item">
            <img src="https://images.unsplash.com/photo-1622286342621-4bd786c2447c?w=400" alt="Styling">
        </div>
    </div>
</section>

<!-- ===== REVIEW ===== -->
<section id="review">
    <div class="section-title">
        <h2>Review</h2>
        <p>What Our Customers Say</p>
    </div>

    <div class="review-grid">
        <div class="review-card">
            <div class="review-header">
                <div class="review-avatar">B</div>
                <div class="review-meta">
                    <h5>Budi</h5>
                    <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                </div>
            </div>
            <p>"Pelayanan sangat bagus, potongan rambut rapi dan barbernya ramah. Tempatnya juga nyaman dan bersih."</p>
        </div>

        <div class="review-card">
            <div class="review-header">
                <div class="review-avatar">D</div>
                <div class="review-meta">
                    <h5>Dedekun</h5>
                    <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></div>
                </div>
            </div>
            <p>"Sudah langganan disini, hasilnya selalu konsisten. Harga terjangkau untuk kualitas yang diberikan."</p>
        </div>

        <div class="review-card">
            <div class="review-header">
                <div class="review-avatar">B</div>
                <div class="review-meta">
                    <h5>Batubara</h5>
                    <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                </div>
            </div>
            <p>"Recommended banget! Barbernya profesional dan ngerti banget sama style yang saya mau."</p>
        </div>
    </div>
</section>

<!-- ===== CONTACT ===== -->
<section id="contact">
    <div class="section-title">
        <h2>Contact Us</h2>
        <p>Get in Touch</p>
    </div>

    <div class="contact-wrapper">
        <div class="contact-info">
            <h3>Hubungi Kami</h3>
            
            <div class="contact-item">
                <i class="bi bi-telephone"></i>
                <span>+62 857-3854-0804</span>
            </div>
            <div class="contact-item">
                <i class="bi bi-envelope"></i>
                <span>barbershop@gmail.com</span>
            </div>
            <div class="contact-item">
                <i class="bi bi-instagram"></i>
                <span>@barbershop.id</span>
            </div>
            <div class="contact-item">
                <i class="bi bi-tiktok"></i>
                <span>@barbershop.id</span>
            </div>
            <div class="contact-item">
                <i class="bi bi-geo-alt"></i>
                <span>Jl. Teuku Umar Barat, Gn Lumut</span>
            </div>

            <h3 class="mt-4">Jam Operasional</h3>
            <div class="contact-item">
                <i class="bi bi-clock"></i>
                <span>Senin - Minggu: 10.00 - 21.00</span>
            </div>
        </div>

        <div class="contact-form">
            <h3>Kirim Pesan</h3>
            <form>
                <input type="text" placeholder="Nama Anda" required>
                <input type="email" placeholder="Email Anda" required>
                <input type="text" placeholder="Subjek">
                <textarea placeholder="Pesan Anda..." required></textarea>
                <button type="submit" class="btn-send">Kirim Pesan</button>
            </form>
        </div>
    </div>
</section>

<footer>
    <p>&copy; 2024 Barbershop. All rights reserved.</p>
</footer>

@endsection