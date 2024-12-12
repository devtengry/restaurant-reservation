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
    <form id="reservationForm" class="p-4 border rounded bg-white shadow-sm">
        <?= csrf_field() ?> <!-- CSRF token'ı buraya eklendi -->
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

<!-- Toast Container -->
<div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Rezervasyon</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toast-message">
            <!-- Mesaj buraya gelecek -->
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('reservationForm');

        form.addEventListener('submit', function(event) {
            event.preventDefault();  // Formun normal gönderilmesini engelle

            const formData = new FormData(form);

            fetch('/reservation/create', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Başarılı mesajı ve toast tipi
                        const message = data.message;
                        const type = 'success';

                        // Toast mesajını göster
                        showToast(message, type);
                    } else {
                        // Hata mesajı
                        const message = 'Bir hata oluştu, lütfen tekrar deneyin.';
                        const type = 'danger';

                        // Toast mesajını göster
                        showToast(message, type);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Bir hata oluştu', 'danger');
                });
        });

        function showToast(message, type) {
            const toastEl = document.getElementById('toast');
            const toastMessage = document.getElementById('toast-message');
            toastMessage.textContent = message;

            // Mesajın tipine göre stil belirleme
            if (type === 'success') {
                toastEl.classList.add('bg-success', 'text-white');
            } else if (type === 'danger') {
                toastEl.classList.add('bg-danger', 'text-white');
            }

            // Toast'ı göster
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
    });
</script>

</body>
</html>
