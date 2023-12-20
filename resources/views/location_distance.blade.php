<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maps</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <p id="distance"></p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Şehir</th>
                            <th>Enlem</th>
                            <th>Boylam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($locations as $location)
                            <tr>
                                <td>{{ $location->name }}</td>
                                <td>{{ $location->latitude }}</td>
                                <td>{{ $location->longitude }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8,
                center: { lat: {{ $locations[0]->latitude }}, lng: {{ $locations[0]->longitude }} }
            });

            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer({
                map: map,
                suppressMarkers: true
            });

            var waypoints = [];
            
            @foreach($locations as $location)
                waypoints.push({
                    location: new google.maps.LatLng({{ $location->latitude }}, {{ $location->longitude }}),
                    stopover: true
                });

                var marker = new google.maps.Marker({
                    position: { lat: {{ $location->latitude }}, lng: {{ $location->longitude }} },
                    map: map,
                    title: '{{ $location->name }}',
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        scale: 8,
                        fillColor: '#{{ $location->marker_color }}',
                        fillOpacity: 1,
                        strokeColor: '#000',
                        strokeWeight: 1
                    }
                });
            @endforeach

            var request = {
                origin: new google.maps.LatLng({{ $locations[0]->latitude }}, {{ $locations[0]->longitude }}),
                destination: new google.maps.LatLng({{ $locations[count($locations)-1]->latitude }}, {{ $locations[count($locations)-1]->longitude }}),
                waypoints: waypoints,
                travelMode: google.maps.DirectionsTravelMode.DRIVING
            };

            directionsService.route(request, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsRenderer.setDirections(response);
                    var route = response.routes[0];
                    var totalDistance = 0;
                    for (var i = 0; i < route.legs.length; i++) {
                        totalDistance += route.legs[i].distance.value;
                    }
                    var totalDistanceInKm = totalDistance / 1000;
                    document.getElementById('distance').innerText = 'Toplam Mesafe: ' + totalDistanceInKm.toFixed(2) + ' km';

                    // İki konumun bilgilerini göster
                    document.getElementById('locationInfo').innerHTML = '<h4>Şehir 1: ' + route.legs[0].end_address + '</h4>' +
                                                                       '<h4>Şehir 2: ' + route.legs[route.legs.length - 1].end_address + '</h4>';
                } else {
                    window.alert('Yol tarifi alınamadı: ' + status);
                }
            });
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ $google_api_key }}&callback=initMap" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
