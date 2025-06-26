<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Digital Nusantara - Kesehatan di Ujung Jari</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts (Mengganti Poppins dengan Roboto) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c5282;
            --secondary-color: #38b2ac;
            --accent-color: #ed8936;
            --text-dark: #2d3748;
            --text-light: #718096;
            --bg-light: #edf2f7;
            --white: #ffffff;
            --gradient-main: linear-gradient(90deg, #2b6cb0 0%, #4c51bf 100%);
            --gradient-alt: linear-gradient(90deg, #ed8936 0%, #f6ad55 100%);
            --shadow-soft: 0 2px 4px rgba(0, 0, 0, 0.08);
            --shadow-bold: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--bg-light);
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        /* Background Effect */
        .bg-pattern {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.05;
            background: radial-gradient(circle, var(--primary-color) 2px, transparent 2px);
            background-size: 20px 20px;
        }

        /* Navbar Styling */
        .navbar {
            background: var(--white);
            padding: 15px 0;
            box-shadow: var(--shadow-soft);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.6rem;
            color: var(--primary-color);
        }

        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            margin-left: 20px;
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--secondary-color) !important;
        }

        /* Hero Section */
        .hero-section {
            background: var(--gradient-main);
            color: var(--white);
            padding: 120px 0 80px;
            text-align: center;
            position: relative;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            animation: slideIn 1s ease-out;
        }

        .hero-section .subtitle {
            font-size: 1.3rem;
            margin-bottom: 30px;
            opacity: 0.9;
            animation: slideIn 1s ease-out 0.3s both;
        }

        .btn-hero {
            padding: 12px 35px;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 30px;
            margin: 8px;
            transition: all 0.3s ease;
        }

        .btn-hero-primary {
            background: var(--secondary-color);
            color: var(--white);
            border: none;
        }

        .btn-hero-primary:hover {
            background: var(--primary-color);
            transform: scale(1.05);
        }

        .btn-hero-outline {
            background: transparent;
            color: var(--white);
            border: 2px solid var(--white);
        }

        .btn-hero-outline:hover {
            background: var(--white);
            color: var(--primary-color);
        }

        /* Access Cards Section */
        .access-section {
            padding: 80px 0;
            background: var(--white);
        }

        .access-card {
            background: var(--white);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: var(--shadow-soft);
            transition: all 0.3s ease;
        }

        .access-card:hover {
            transform: scale(1.03);
            box-shadow: var(--shadow-bold);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            background: var(--gradient-alt);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.8rem;
            color: var(--white);
        }

        .access-card h4 {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 10px;
            font-size: 1.3rem;
        }

        .access-card p {
            color: var(--text-light);
            line-height: 1.5;
        }

        .btn-access {
            background: var(--primary-color);
            color: var(--white);
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-access:hover {
            background: var(--secondary-color);
            transform: scale(1.05);
        }

        /* Features Section */
        .features-section {
            padding: 80px 0;
            background: var(--bg-light);
        }

        .feature-card {
            background: var(--white);
            padding: 30px;
            border-radius: 15px;
            box-shadow: var(--shadow-soft);
            text-align: center;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: scale(1.03);
            box-shadow: var(--shadow-bold);
        }

        .feature-card i {
            color: var(--secondary-color);
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .feature-card h4 {
            font-weight: 600;
            color: var(--text-dark);
        }

        .feature-card p {
            color: var(--text-light);
            line-height: 1.5;
        }

        /* Testimonials Section */
        .testimonials-section {
            padding: 80px 0;
            background: var(--white);
        }

        .testimonial-card {
            background: var(--bg-light);
            padding: 25px;
            border-radius: 15px;
            box-shadow: var(--shadow-soft);
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: scale(1.02);
        }

        .testimonial-card p {
            font-style: italic;
            color: var(--text-light);
            margin-bottom: 15px;
        }

        .testimonial-card h5 {
            font-weight: 600;
            color: var(--primary-color);
        }

        /* Contact Section */
        .contact-section {
            padding: 80px 0;
            background: var(--bg-light);
        }

        .contact-form {
            background: var(--white);
            padding: 40px;
            border-radius: 15px;
            box-shadow: var(--shadow-bold);
        }

        .contact-section .form-control {
            margin-bottom: 20px;
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .contact-section .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(56, 178, 172, 0.1);
        }

        .btn-submit {
            background: var(--gradient-main);
            color: var(--white);
            padding: 12px 35px;
            border-radius: 30px;
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-bold);
        }

        /* Footer */
        footer {
            background: var(--primary-color);
            color: var(--white);
            padding: 40px 0;
            text-align: center;
        }

        /* Section Titles */
        .section-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 50px;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--gradient-alt);
            border-radius: 2px;
        }

        /* Animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2.2rem;
            }
            .hero-section .subtitle {
                font-size: 1.1rem;
            }
            .section-title {
                font-size: 1.8rem;
            }
            .btn-hero {
                padding: 10px 25px;
                font-size: 0.9rem;
            }
            .contact-form {
                padding: 25px;
            }
        }

        @media (max-width: 576px) {
            .hero-section {
                padding: 100px 0 60px;
            }
            .hero-section h1 {
                font-size: 1.8rem;
            }
            .access-section, .features-section, .testimonials-section, .contact-section {
                padding: 60px 0;
            }
        }
    </style>
</head>
<body>
    <!-- Background Pattern -->
    <div class="bg-pattern"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-stethoscope me-2"></i>Klinik Digital Udinus
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#access">Akses</a>
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
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <h1>Kesehatan Digital Modern</h1>
            <p class="subtitle">Akses layanan medis profesional dari rumah Anda dengan teknologi canggih</p>
            <div class="hero-buttons">
                <a href="#access" class="btn btn-hero btn-hero-primary">Mulai Konsultasi</a>
                <a href="#features" class="btn btn-hero btn-hero-outline">Lihat Fitur</a>
            </div>
        </div>
    </section>

    <!-- Access Section -->
    <section class="access-section" id="access">
        <div class="container">
            <h2 class="text-center section-title">Pilih Peran Anda</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="access-card">
                        <div class="card-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h4>Registrasi Pasien</h4>
                        <p>Gabung dengan jutaan pengguna yang menikmati konsultasi online mudah. Daftar sekarang untuk layanan kesehatan terbaik.</p>
                        <a href="/register" class="btn-access">Daftar</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="access-card">
                        <div class="card-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <h4>Masuk Dokter</h4>
                        <p>Akses portal khusus dokter untuk mengatur jadwal konsultasi dan mengelola data pasien dengan mudah.</p>
                        <a href="/login" class="btn-access">Masuk Dokter</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="access-card">
                        <div class="card-icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        <h4>Masuk Admin</h4>
                        <p>Kelola platform, pantau sistem, dan atur konfigurasi layanan klinik digital secara efisien.</p>
                        <a href="/login" class="btn-access">Masuk Admin</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="features">
        <div class="container">
            <h2 class="text-center section-title">Keunggulan Kami</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-video"></i>
                        <h4>Video Konsultasi</h4>
                        <p>Berbual dengan dokter melalui video call aman dengan kualitas tinggi untuk privasi terjamin.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-clock"></i>
                        <h4>Akses 24 Jam</h4>
                        <p>Layanan kesehatan tersedia kapan saja, di mana saja, dengan tim medis siap setiap saat.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-prescription-bottle-alt"></i>
                        <h4>Resep Digital</h4>
                        <p>Dapatkan resep elektronik langsung di perangkat Anda dengan pengiriman obat dari apotek mitra.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-shield-alt"></i>
                        <h4>Keamanan Data</h4>
                        <p>Data medis Anda dilindungi dengan enkripsi canggih dan standar keamanan internasional.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-mobile-alt"></i>
                        <h4>Aplikasi Mobile</h4>
                        <p>Pengalaman pengguna yang nyaman melalui aplikasi mobile yang mendukung semua perangkat.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-heartbeat"></i>
                        <h4>Pantau Kesehatan</h4>
                        <p>Lacak kesehatan Anda secara langsung dengan integrasi perangkat wearable dan laporan rutin.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section" id="testimonials">
        <div class="container">
            <h2 class="text-center section-title">Ulasan Pengguna</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p>Layanan luar biasa! Konsultasi dengan dokter sangat membantu, profesional, dan praktis tanpa harus ke klinik.</p>
                        <h5>Siti Aminah, 35 tahun</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p>Sangat cocok untuk pekerja sibuk seperti saya. Konsultasi cepat dan resep digital sangat memudahkan!</p>
                        <h5>Agus Pratama, 42 tahun</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p>Fitur pemantauan kesehatan membantu saya mengelola kondisi kronis dengan saran dokter yang akurat.</p>
                        <h5>Rina Lestari, 29 tahun</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="container">
            <h2 class="text-center section-title">Kontak Kami</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="contact-form">
                        <form action="/submit" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Nama Anda" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" placeholder="Alamat Email" required>
                                </div>
                            </div>
                            <input type="tel" class="form-control" placeholder="Nomor Telepon" required>
                            <textarea class="form-control" rows="5" placeholder="Tulis Pesan Anda..." required></textarea>
                            <div class="text-center">
                                <button type="submit" class="btn btn-submit">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="mb-3">
                <i class="fas fa-stethoscope me-2"></i>
                <strong>Klinik Digital Nusantara</strong>
            </p>
            <p>© 2025 Klinik Digital Nusantara. Hak cipta dilindungi.</p>
            <p class="mt-3">
                <small>Diawasi oleh Kementerian Kesehatan Republik Indonesia</small>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Scroll animation for cards
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.2 });

        document.querySelectorAll('.access-card, .feature-card, .testimonial-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateX(-20px)';
            el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            el.classList.add('animate-card');
            observer.observe(el);
        });

        // Add visible class for animation
        const styleSheet = document.createElement('style');
        styleSheet.textContent = `
            .animate-card.visible {
                opacity: 1 !important;
                transform: translateX(0) !important;
            }
        `;
        document.head.appendChild(styleSheet);

        // Form submission animation
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const submitBtn = form.querySelector('.btn-submit');
                const originalText = submitBtn.innerHTML;
                
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
                submitBtn.disabled = true;
                
                setTimeout(() => {
                    submitBtn.innerHTML = '<i class="fas fa-check me-2"></i>Berhasil!';
                    submitBtn.style.background = 'linear-gradient(90deg, #38b2ac 0%, #2c5282 100%)';
                    
                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                        submitBtn.style.background = '';
                        form.reset();
                    }, 1500);
                }, 1000);
            });
        }

        // Hover effect for cards
        document.querySelectorAll('.access-card, .feature-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'scale(1.03)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>