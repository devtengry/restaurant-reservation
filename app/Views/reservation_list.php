<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezervasyon Listesi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1 class="mb-4 text-center">Rezervasyon Listesi</h1>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>İsim</th>
            <th>Telefon</th>
            <th>Tarih</th>
            <th>Saat</th>
            <th>Kişi Sayısı</th>
            <th>İşlemler</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($reservations as $reservation): ?>
            <tr id="reservation-<?= (string)$reservation->_id ?>">
                <td><?= (string)$reservation->_id ?></td>
                <td><?= $reservation->name ?></td>
                <td><?= $reservation->phone ?></td>
                <td><?= $reservation->date ?></td>
                <td><?= $reservation->time ?></td>
                <td><?= $reservation->guests ?></td>
                <td>
                    <a href="#" class="btn btn-warning btn-sm">Düzenle</a>
                    <button class="btn btn-danger btn-sm delete-reservation" data-id="<?= (string)$reservation->_id ?>">Sil</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Silme butonuna tıklandığında AJAX ile işlem yap
        $('.delete-reservation').click(function (e) {
            e.preventDefault();  // Sayfa yenilenmesin

            var reservationId = $(this).data('id');

            // Kullanıcıdan onay al
            if (confirm('Bu rezervasyonu silmek istediğinizden emin misiniz?')) {
                $.ajax({
                    url: '/reservation/delete/' + reservationId,
                    type: 'GET',
                    success: function (response) {
                        // Silme işlemi başarılıysa, satırı kaldır
                        if (response.status === 'success') {
                            $('#reservation-' + reservationId).remove();
                            alert(response.message);
                        } else {
                            alert('Silme işlemi başarısız oldu!');
                        }
                    },
                    error: function () {
                        alert('Bir hata oluştu!');
                    }
                });
            }
        });
    });
</script>
</body>
</html>
