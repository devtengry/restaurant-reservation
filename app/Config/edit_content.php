<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site İçeriği Düzenle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Site İçeriğini Düzenle</h1>
    <form action="/admin/updateContent" method="post">
        <div class="mb-3">
            <label for="siteTitle" class="form-label">Site Başlığı</label>
            <input type="text" id="siteTitle" name="siteTitle" value="<?= $content['siteTitle']; ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label for="homepageText" class="form-label">Ana Sayfa Metni</label>
            <textarea id="homepageText" name="homepageText" rows="4" class="form-control"><?= $content['homepageText']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
