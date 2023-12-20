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
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('location.store') }}" method="POST">
            @csrf
            <label for="name" class="form-label">Konum Adı:</label>
            <input type="text" name="name" class="form-control" required>
            <label for="latitude" class="form-label">Enlem:</label>
            <input type="text" name="latitude" class="form-control" required>
            <label for="longitude" class="form-label">Boylam:</label>
            <input type="text" name="longitude" class="form-control" required>
            <label for="marker_color" class="form-label">Marker Rengi (Hexadecimal):</label>
            <input type="color" name="marker_color" class="form-control" required>
            <button type="submit" class="btn btn-primary mt-3">Ekle</button>
        </form>

        <h2 class="mt-4">Konumlar</h2>
        <form action="{{ route('location.create') }}" method="POST">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Seç</th>
                        <th scope="col">Id</th>
                        <th scope="col">Konum Adı</th>
                        <th scope="col">Enlem</th>
                        <th scope="col">Boylam</th>
                        <th scope="col">Marker Rengi</th>
                        <th scope="col">Düzenle</th>
                        <th scope="col">Haritada Göster</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($locations as $location)
                        <tr>
                            <td><input type="checkbox" name="selectedLocations[]" value="{{ $location->id }}"></td>
                            <td>{{ $location->id }}</td>
                            <td>{{ $location->name }}</td>
                            <td>{{ $location->latitude }}</td>
                            <td>{{ $location->longitude }}</td>
                            <td>{{ $location->marker_color }}</td>
                            <td><a href="{{ route('location.edit', ['id' => $location->id]) }}" class="btn btn-warning">Düzenle</a></td>
                            <td><a href="{{ route('location.showById', ['id' => $location->id]) }}" class="btn btn-info">Haritada Göster</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-success mt-3">Seçilenleri Yönlendir</button>
        </form>
    </div>

    <!-- Bootstrap JS ve Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
