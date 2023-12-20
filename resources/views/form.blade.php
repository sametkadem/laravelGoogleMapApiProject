<form action="/process-form" method="post">
    @csrf
    <label for="x">Enlem Bilgisi:</label>
    <input type="text" name="x" id="x" required>

    <label for="y">Boylam Bilgisi:</label>
    <input type="text" name="y" id="y" required>

    <label for="color">Renk:</label>
    <input type="color" name="color" id="color" required>

    <label for="color">Konumun Adı:</label>
    <input type="text" name="name" id="name" required>

    <button type="submit">Gönder</button>
</form>