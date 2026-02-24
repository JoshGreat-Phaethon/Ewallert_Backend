<!DOCTYPE html>
<html>
<head>
    <title>E-Wallet App - Digital Wallet Modern</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- ✅ CSRF Token untuk fetch API -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #030303 100%);
            color: white;
            padding: 100px 0;
        }
        .feature-icon {
            font-size: 2.5rem;
            color: #697dd6;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">💰 E-Wallet</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <span class="nav-link text-light">
                            👋 {{ Auth::user()->name }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="/logout" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm nav-link" 
                                    style="border: none; background: none;">
                                🚪 Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="/login" class="btn btn-outline-light btn-sm me-2">🔑 Login</a>
                        <a href="/register" class="btn btn-warning btn-sm">📝 Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">Digital Wallet Modern & Aman</h1>
        <p class="lead fs-3 mb-4">Topup, transfer, dan kelola saldo dengan mudah.</p>
        
        @guest
            <a href="/register" class="btn btn-light btn-lg px-5 py-3 fw-bold">
                🚀 Mulai Sekarang
            </a>
            <p class="mt-3 text-white-50">Sudah punya akun? <a href="/login" class="text-white fw-bold">Login</a></p>
        @else
            <a href="/dashboard" class="btn btn-light btn-lg px-5 py-3 fw-bold">
                📊 Buka Dashboard
            </a>
        @endguest
    </div>
</section>

<!-- Features -->
<section class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">✨ Kenapa Pilih E-Wallet?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon mb-3">⚡</div>
                        <h4 class="fw-bold">Top Up Cepat</h4>
                        <p class="text-secondary">Isi saldo dalam hitungan detik, 24/7.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon mb-3">💸</div>
                        <h4 class="fw-bold">Transfer Mudah</h4>
                        <p class="text-secondary">Kirim uang ke user lain tanpa ribet.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon mb-3">📊</div>
                        <h4 class="fw-bold">Riwayat Lengkap</h4>
                        <p class="text-secondary">Lihat semua transaksi secara real-time.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-black text-white py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">Siap Mengelola Keuangan Lebih Mudah?</h2>
        <p class="lead mb-4">Gabung dengan ribuan pengguna lainnya sekarang!</p>
        @guest
            <a href="/register" class="btn btn-light btn-lg px-4">Daftar Gratis</a>
        @endguest
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white-50 py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5 class="text-white">💰 E-Wallet</h5>
                <p>Digital wallet solution for modern lifestyle.</p>
            </div>
            <div class="col-md-3">
                <h6 class="text-white">Fitur</h6>
                <ul class="list-unstyled">
                    <li>Top Up</li>
                    <li>Transfer</li>
                    <li>Riwayat</li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="text-white">Bantuan</h6>
                <ul class="list-unstyled">
                    <li>FAQ</li>
                    <li>Kontak</li>
                    <li>Kebijakan</li>
                </ul>
            </div>
        </div>
        <hr class="border-secondary">
        <p class="text-center mb-0 text-white-50">
            © {{ date('Y') }} E-Wallet App. All rights reserved.
        </p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>