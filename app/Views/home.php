<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoran Ana Sayfa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
        }
        .hero-section {
            background: url('images/mainBackround.jpg') no-repeat center center/cover;
            color: white;
            height: 60vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        .hero-section h1 {
            font-size: 3rem;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Restoran</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/reservation/form">Rezervasyon Yap</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/reservation/list">Rezervasyon Takip Et</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/login">Admin Panel</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="hero-section text-center">
    <div>
        <h1>Lezzetli Yemeklere Hoş Geldiniz!</h1>
        <p class="lead">Rezervasyon yaparak bize katılın</p>
        <a href="/reservation/form" class="btn btn-primary btn-lg">Hemen Rezervasyon Yap</a>
    </div>
</div>

<!-- Content Section -->
<div class="container my-5">
    <div class="row text-center">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <img src="images/foods.jpg" class="card-img-top" alt="Yemek">
                <div class="card-body">
                    <h5 class="card-title">Menümüz</h5>
                    <p class="card-text">En iyi yemek seçeneklerini deneyin.</p>
                    <a href="#" class="btn btn-outline-primary">Detaylar</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <img src="images/interior.jpg" class="card-img-top" alt="Yemek">
                <div class="card-body">
                    <h5 class="card-title">Mekanımız</h5>
                    <p class="card-text">Konforlu ve şık bir ortam sizi bekliyor.</p>
                    <a href="#" class="btn btn-outline-primary">Detaylar</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <img src="images/chefs.jpg" class="card-img-top" alt="Yemek">
                <div class="card-body">
                    <h5 class="card-title">Profesyonel Şefler</h5>
                    <p class="card-text">Alanında uzman şeflerimiz hizmetinizde.</p>
                    <a href="#" class="btn btn-outline-primary">Detaylar</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
