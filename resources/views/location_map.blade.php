<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Diğer head içeriği -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <head>
    <title>Maps</title>
    <script src="https://maps.googleapis.com/maps/api/js?key="{{ $google_api_key }}"&callback=initMap" async defer></script>
    <script>
        function initMap() {
            var myLatLng = { lat: 40.7128, lng: -74.0060 };
            var map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng,
                zoom: 8
            });
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Konum'
            });
        }
    </script>
</head>
<body>
    <div id="app">
        @include('navbar') <!-- Navbar'ı burada çağırıyoruz -->
    </div>

    <div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title">Konum</h2>
        </div>
        <div class="card-body">
        
        <div id="map" style="height: 400px;"></div>

        </div>
    </div>
</div>
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <!-- Bootstrap JS ve Popper.js -->
    <script>
        function initMap() {
            var location = @json($location);
            var googleApiKey = @json($google_api_key);

            var myLatLng = { lat: parseFloat(location.latitude), lng: parseFloat(location.longitude) };
            var map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng,
                zoom: 15
            });

            // İşaretçi rengini belirleme
            var markerColor = location.marker_color || '#FF0000'; // Default renk: Kırmızı
            var markerImage = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|' + markerColor;

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: location.name,
                icon: {
                    url: markerImage,
                    scaledSize: new google.maps.Size(30, 30) // İşaretçi boyutu
                }
            });
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ $google_api_key }}&callback=initMap" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
