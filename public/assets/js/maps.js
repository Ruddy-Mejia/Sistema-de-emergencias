var map;
document.addEventListener("DOMContentLoaded", function (event) {
    if (document.getElementById('maps')) {
        map = new GMaps({
            div: '#maps',
            lat: -17.3938784,
            lng: -66.2462782,
            click: function (event) {
                placeMarker(event.latLng);
            }
        });
        function placeMarker(location) {
            map.removeMarkers();
            map.addMarker({
                lat: location.lat(),
                lng: location.lng(),
            });

            document.getElementById('latitude').value = location.lat();
            document.getElementById('longitude').value = location.lng();
        }
    }
    if (document.getElementById('maps-edit')) {
        map = new GMaps({
            div: '#maps-edit',
            lat: document.getElementById('latitude').value,
            lng: document.getElementById('longitude').value,
            click: function (event) {
                placeMarker(event.latLng);
            }
        });
        map.addMarker({
            lat: document.getElementById('latitude').value,
            lng: document.getElementById('longitude').value,
        });
        function placeMarker(location) {
            map.removeMarkers();
            map.addMarker({
                lat: location.lat(),
                lng: location.lng(),
            });

            document.getElementById('latitude').value = location.lat();
            document.getElementById('longitude').value = location.lng();
        }
    }
    if (document.getElementById('maps-show')) {
        map = new GMaps({
            div: '#maps-show',
            lat: document.getElementById('latitude').value,
            lng: document.getElementById('longitude').value,
            click: function (event) {
                placeMarker(event.latLng);
            }
        });
        map.addMarker({
            lat: document.getElementById('latitude').value,
            lng: document.getElementById('longitude').value,
        });
    }
    if (document.getElementById('maps-dashboard')) {
        map = new GMaps({
            div: '#maps-dashboard',
            lat: -17.3938784,
            lng: -66.2462782,
            zoom: 10
        });
        for (var i = 0; i < data_maps.length; i++) {
            var location = data_maps[i];
            var nature = location.nature;
            var latitude = (location.latitude);
            var longitude = (location.longitude);

            // Agrega un marcador al mapa
            map.addMarker({
                lat: latitude,
                lng: longitude,
                title: nature, // Puedes utilizar la naturaleza como título del marcador
            });
        }
    }
});


