<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Diğer head içeriği -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('navbar') <!-- Navbar'ı burada çağırıyoruz -->
    </div>

    <div class="container">
        <h2>Ayarlar</h2>
        <form action="{{ route('settings.update', $settingsData->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="api_key">Google Api Key:</label>
            <input type="text" name="api_key" value="{{ $settingsData->google_api_key }}" style="width: 400px;">
            <button type="submit">Güncelle</button>
        </form>
    </div>
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <!-- Bootstrap JS ve Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
