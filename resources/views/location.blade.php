<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Diğer head içeriği -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1, h2 {
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .success-message {
            color: green;
        }

        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div id="app">
        @include('navbar') <!-- Navbar'ı burada çağırıyoruz -->
    </div>

    <div class="container">
    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('location.store') }}" method="POST">
        @csrf
        <label for="name">Konum Adı:</label>
        <input type="text" name="name" required>
        <br>
        <label for="latitude">Enlem:</label>
        <input type="text" name="latitude" required>
        <br>
        <label for="longitude">Boylam:</label>
        <input type="text" name="longitude" required>
        <br>
        <label for="marker_color">Marker Rengi (Hexadecimal):</label>
        <input type="text" name="marker_color" required>
        <br>
        <button type="submit">Ekle</button>
    </form>

    <!-- Geri kalan HTML kodları buraya gelecek -->

    <h2>Konumlar</h2>
    <form action="#" method="POST" id="redirectForm">
    @csrf
    <table id="locationTable">
        <thead>
            <tr>
                <th>Seç</th>
                <th>Id</th>
                <th>Konum Adı</th>
                <th>Enlem</th>
                <th>Boylam</th>
                <th>Marker Rengi</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>

    <button type="button" onclick="redirectToSelectedLocations()">Seçilenleri Yönlendir</button>
</form>

    
    </div>


    <!-- Bootstrap JS ve Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
