<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Diğer head içeriği -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<title>Settings</title>
<body>
    <div id="app">
        @include('navbar') <!-- Navbar'ı burada çağırıyoruz -->
    </div>

    <div class="container mt-5">
        <h2 class="mb-4">Ayarlar</h2>
        <form action="{{ route('settings.update', $settingsData->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="api_key" class="form-label">Google Api Key:</label>
                <input type="text" name="api_key" value="{{ $settingsData->google_api_key }}" class="form-control" style="width: 400px;">
            </div>
            
            <button type="submit" class="btn btn-primary">Güncelle</button>
        </form>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Bootstrap JS ve Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
