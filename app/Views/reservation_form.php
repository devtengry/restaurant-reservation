<form action="/reservation/create" method="post">
    <label>İsim:</label>
    <input type="text" name="name" required><br>

    <label>Telefon:</label>
    <input type="text" name="phone" required><br>

    <label>Tarih:</label>
    <input type="date" name="date" required><br>

    <label>Saat:</label>
    <input type="time" name="time" required><br>

    <label>Kişi Sayısı:</label>
    <input type="number" name="guests" min="1" required><br>

    <button type="submit">Rezervasyon Yap</button>
</form>
