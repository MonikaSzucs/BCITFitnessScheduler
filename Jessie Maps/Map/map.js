function initMap() {
        var uluru = {lat: 49.248817, lng: -123.00035300000002
					};
	
        var map = new google.maps.Map(document.getElementById('map'), {
			
          zoom: 15,
          center: uluru
        });
        var marker = new google.maps.Marker({
			
          position: uluru,
          map: map
        })
}