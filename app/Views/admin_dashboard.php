<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/admin">Admin Panel</a>
        <div class="d-flex">
            <span class="navbar-text me-3">Hoş Geldiniz, <?= session()->get('adminUsername'); ?>!</span>
            <a href="/admin/logout" class="btn btn-outline-light">Çıkış Yap</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center">Admin Paneli</h1>
    <div class="row mt-4">
        <div class="col-md-6">
            <h3>Rezervasyon Yönetimi</h3>
            <a href="/reservation/list" class="btn btn-primary mb-3">Rezervasyonları Görüntüle</a>
        </div>
        <div class="col-md-6">
            <h3>Site İçeriği Düzenle</h3>
            <a href="/admin/editContent" class="btn btn-secondary mb-3">Site İçeriğini Yönet</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
