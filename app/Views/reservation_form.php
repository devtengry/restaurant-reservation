<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezervasyon Yap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="mb-4 text-center">Rezervasyon Formu</h1>
    <form action="/reservation/create" method="post" class="p-4 border rounded bg-white shadow-sm">
        <div class="mb-3">
            <label for="name" class="form-label">İsim</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Telefon</label>
            <input type="text" id="phone" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Tarih</label>
            <input type="date" id="date" name="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="time" class="form-label">Saat</label>
            <input type="time" id="time" name="time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="guests" class="form-label">Kişi Sayısı</label>
            <input type="number" id="guests" name="guests" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Rezervasyon Yap</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
