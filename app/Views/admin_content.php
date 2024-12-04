<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site İçeriği Yönetimi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Site İçeriğini Düzenle</h1>
    <a href="/admin/dashboard" class="btn btn-secondary mb-3">Geri Dön</a>
    <form action="/admin/content/update" method="post">
        <div class="mb-3">
            <label for="homepageContent" class="form-label">Ana Sayfa İçeriği</label>
            <textarea class="form-control" id="homepageContent" name="homepageContent" rows="5"><?= $content['homepage'] ?? '' ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Güncelle</button>
    </form>
</div>
</body>
</html>
