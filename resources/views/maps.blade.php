<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harita Üzerinde Konum Gösterme</title>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Harita Üzerinde Konum Gösterme</h1>
    <div id="map"></div>

    <script>
        // Google Maps API Key'i buraya ekleyin.
        const apiKey = 'YOUR_API_KEY';

        // Hedef enlem ve boylam koordinatları
        const latitude = 37.7749;
        const longitude = -122.4194;

        function initMap() {
            const map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: latitude, lng: longitude },
                zoom: 15,
            });

            // Konum marker'ı ekleme
            new google.maps.Marker({
                position: { lat: latitude, lng: longitude },
                map: map,
                title: 'Hedef Konum'
            });
        }
    </script>

    <!-- Google Maps API'yi yükleyin -->
    <script src="https://maps.googleapis.com/maps/api/js?key=${apiKey}&callback=initMap" async defer></script>
</body>
</html>