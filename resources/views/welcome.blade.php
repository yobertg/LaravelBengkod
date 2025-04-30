<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poliklinik Sehat Online - Konsultasi Kesehatan Modern</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fa;
            scroll-behavior: smooth;
        }
        /* Navbar Styling */
        .navbar {
            background: linear-gradient(90deg, #2c3e50, #34495e);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.9rem;
            color: #ecf0f1 !important;
        }
        .nav-link {
            color: #ecf0f1 !important;
            font-weight: 400;
            margin-left: 25px;
            position: relative;
            transition: color 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: #1abc9c;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .nav-link:hover {
            color: #1abc9c !important;
        }
        .btn-login {
            background-color: #1abc9c;
            color: #fff;
            border-radius: 30px;
            padding: 8px 25px;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-login:hover {
            background-color: #16a085;
            transform: scale(1.05);
        }
        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: #fff;
            padding: 150px 0;
            text-align: left;
            position: relative;
        }
        .hero-section .container {
            max-width: 700px;
        }
        .hero-section h1 {
            font-size: 3.2rem;
            font-weight: 700;
            animation: slideInLeft 1s ease;
        }
        .hero-section p {
            font-size: 1.2rem;
            margin: 20px 0 40px;
            animation: slideInRight 1s ease 0.3s;
            animation-fill-mode: both;
        }
        .btn-primary {
            background-color: #1abc9c;
            border: none;
            padding: 15px 40px;
            font-size: 1.1rem;
            border-radius: 50px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #16a085;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }
        /* Features Section */
        .features-section {
            padding: 100px 0;
            background-color: #fff;
        }
        .feature-card {
            background: #f5f7fa;
            padding: 40px 20px;
            border-radius: 20px;
            text-align: center;
            margin-bottom: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        .feature-card i {
            color: #1abc9c;
            margin-bottom: 15px;
        }
        .feature-card h4 {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        /* Testimonials Section */
        .testimonials-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #ecf0f1, #f5f7fa);
        }
        .testimonial-card {
            background: #fff;
            padding: 30px;
            border-left: 5px solid #1abc9c;
            border-radius: 10px;
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }
        .testimonial-card:hover {
            transform: translateX(10px);
        }
        .testimonial-card p {
            color: #7f8c8d;
            font-size: 1rem;
        }
        .testimonial-card h5 {
            font-weight: 600;
            color: #2c3e50;
        }
        /* Contact Section */
        .contact-section {
            padding: 100px 0;
            background-color: #2c3e50;
            color: #fff;
        }
        .contact-section h2 {
            color: #ecf0f1;
        }
        .contact-section .form-control {
            margin-bottom: 20px;
            border-radius: 8px;
            padding: 12px;
            border: none;
            background: #34495e;
            color: #fff;
            transition: background 0.3s ease;
        }
        .contact-section .form-control::placeholder {
            color: #bdc3c7;
        }
        .contact-section .form-control:focus {
            background: #3d566e;
            box-shadow: none;
        }
        /* Footer */
        footer {
            background-color: #1a252f;
            color: #bdc3c7;
            padding: 40px 0;
            text-align: center;
        }
        footer p {
            margin: 0;
            font-size: 0.95rem;
        }
        /* Animations */
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-section {
                padding: 100px 0;
                text-align: center;
            }
            .hero-section h1 {
                font-size: 2.3rem;
            }
            .hero-section p {
                font-size: 1rem;
            }
            .navbar-brand {
                font-size: 1.6rem;
            }
            .nav-link {
                margin-left: 0;
                margin-top: 15px;
            }
            .feature-card, .testimonial-card {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Poliklinik Sehat Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Testimoni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a href="/login" class="btn btn-login">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <h1>Konsultasi Kesehatan Modern</h1>
            <p>Akses dokter profesional dari mana saja dengan layanan online kami.</p>
            <a href="#contact" class="btn btn-primary">Buat Janji Sekarang</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="features">
        <div class="container">
            <h2 class="text-center mb-5">Keunggulan Layanan Kami</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-video fa-3x"></i>
                        <h4>Konsultasi Virtual</h4>
                        <p>Berbual dengan dokter melalui video call tanpa perlu ke klinik.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-calendar-check fa-3x"></i>
                        <h4>Penjadwalan Mudah</h4>
                        <p>Atur janji temu sesuai kenyamanan Anda.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-prescription fa-3x"></i>
                        <h4>Resep Online</h4>
                        <p>Terima resep digital langsung di perangkat Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section" id="testimonials">
        <div class="container">
            <h2 class="text-center mb-5">Cerita Pasien Kami</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p>"Layanan ini sangat memudahkan hidup saya. Dokternya sangat perhatian!"</p>
                        <h5>- Ani, 34 tahun</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p>"Penjadwalan yang fleksibel sangat cocok untuk rutinitas sibuk saya."</p>
                        <h5>- Budi, 40 tahun</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p>"Proses resep digital sangat cepat dan praktis!"</p>
                        <h5>- Citra, 28 tahun</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="container">
            <h2 class="text-center mb-5">Kontak Kami</h2>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="/submit" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control" placeholder="Nomor Telepon" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="4" placeholder="Pesan atau Pertanyaan" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>© 2025 Poliklinik Sehat Online. Hak cipta dilindungi.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>