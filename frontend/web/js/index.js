var geolocationMap, dir;

window.onload = function () {
    var popup = L.popup();
    geolocationMap = L.map('mapid', {
        layers: MQ.mapLayer(),
        center: [3.517350, 98.609770],
        zoom: 12
    });

    function geolocationErrorOccurred(geolocationSupported, popup, latLng) {
        popup.setLatLng(latLng);
        popup.setContent(geolocationSupported ?
            '<b>Error:</b> The Geolocation service failed.' :
            '<b>Error:</b> This browser doesn\'t support geolocation.');
        popup.openOn(geolocationMap);
    }

    geolocationErrorOccurred(false, popup, geolocationMap.getCenter());

    placeSearch({
        key: 'GG9Q0qO9MQ0phAsdtFOGKZDAZfGEz0AB',
        container: document.querySelector('#place-search-input'),
        useDeviceLocation: true,
        collection: [
            'adminArea',
        ]
    });

}

function searchLocationTarif() {
    var dir = MQ.routing.directions();
    dir.route({
        locations: [
            '3.517350,98.609770',
            $('#mastertarifambulance-daerah_tujuan').val()

        ]
    });
    geolocationMap.addLayer(MQ.routing.routeLayer({
        directions: dir,
        fitBounds: true
    }));
    // console.log(latLng.toString())
    dir.on('success', function (data) {
        console.log(data.route.locations);
        console.log("Rp. " + parseInt(parseFloat(data.route.distance) * 20000));
        console.log(data.route.distance);
        $('#form-address-location').attr('hidden', false);
        $('#mastertarifambulance-perkiraan_jarak_tempuh').val(parseFloat(data.route.distance).toFixed(2));
        $('#mastertarifambulance-tarif').val(Math.floor(parseFloat(data.route.distance) * 10) * 1000);
    });

    dir.on('error', function (e){
        console.log('Not Found!');
        alert("Tidak ada data ditemukan");
    })
}

function searchLocation() {
    var dir = MQ.routing.directions();
    dir.route({
        locations: [
            '3.517350,98.609770',
            $('#pemesananambulance-alamat_pemesan').val()

        ]
    });
    geolocationMap.addLayer(MQ.routing.routeLayer({
        directions: dir,
        fitBounds: true
    }));
    // console.log(latLng.toString())
    dir.on('success', function (data) {
        console.log(data.route.locations);
        console.log("Rp. " + parseInt(parseFloat(data.route.distance) * 20000));
        console.log(data.route.distance);
        $('#form-address-location').attr('hidden', false);
        $('#pemesananambulance-jarak_tambahan').val(parseFloat(data.route.distance).toFixed(2));
    });

    dir.on('error', function (e){
        console.log('Not Found!');
        alert("Tidak ada data ditemukan");
    })
}