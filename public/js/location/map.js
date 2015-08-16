function initialize() {

    var map = new google.maps.Map(document.getElementById("map-canvas"), {zoom: 15});
    var geocoder = new google.maps.Geocoder();
    var address = $('#address').text();
    
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            console.log('Google Lat: ' + results[0].geometry.location);
            console.log('Google Lng: ' + results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map, 
                position: results[0].geometry.location
            });
        } else {
            alert("Geocode was not successful for the following reason: " + status);
        }
    });
}

google.maps.event.addDomListener(window, 'load', initialize);