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

    <div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title">Konum Düzenleme Formu</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('location.updateById') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="id" class="form-label">Id:</label>
                    <input type="text" name="id" value="{{ $location->id }}" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Konum Adı:</label>
                    <input type="text" name="name" value="{{ $location->name }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="latitude" class="form-label">Enlem:</label>
                    <input type="text" name="latitude" value="{{ $location->latitude }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="longitude" class="form-label">Boylam:</label>
                    <input type="text" name="longitude" value="{{ $location->longitude }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="marker_color" class="form-label">Marker Rengi (Hexadecimal):</label>
                    <input type="color" name="marker_color" value="{{ $location->marker_color }}" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Düzenle</button>
            </form>
        </div>
    </div>
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
