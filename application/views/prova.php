

        <div>
			
			<ul class="nav nav-pills">
			  <li class="active"><a data-toggle="tab" href="#home">Mapa Tempo-Real</a></li>
			  <li><a data-toggle="tab" href="#menu1">Dados</a></li>
			  <li><a data-toggle="tab" href="#menu2">Mensagens</a></li>
			  <li><a data-toggle="tab" href="#menu3">Checkpoints</a></li>
			</ul>
			
			<div class="tab-content">
			  <div id="home" class="tab-pane fade in active">
			    <div id="map"></div>
			  </div>
			  <div id="menu1" class="tab-pane fade">
			    <h3>Menu 1</h3>
			    <p>Some content in menu 1.</p>
			  </div>
			  <div id="menu2" class="tab-pane fade">
			    <h3>Menu 2</h3>
			    <p>Some content in menu 2.</p>
			  </div>
			  <div id="menu3" class="tab-pane fade">
			    <h3>Menu 3</h3>
			    <p>Some content in menu 3.</p>
			  </div>
			</div>
			
            
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   
    
    
    <script>

// This example creates a 2-pixel-wide red polyline showing the path of William
// Kingsford Smith's first trans-Pacific flight between Oakland, CA, and
// Brisbane, Australia.

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 18,
    center: {lat: -21.972000, lng: -46.7720442},
    mapTypeId: google.maps.MapTypeId.SATELLITE
  });

  var flightPlanCoordinates = [
    {lat: 37.772, lng: -122.214},
    {lat: 21.291, lng: -157.821},
    {lat: -18.142, lng: 178.431},
    {lat: -27.467, lng: 153.027}
  ];
  var flightPath = new google.maps.Polyline({
    path: flightPlanCoordinates,
    geodesic: true,
    strokeColor: '#FF0000',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });

  flightPath.setMap(map);
}

    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnHZBnaTphUHLT4ow884Cd24itv9x-D8Y&signed_in=true&callback=initMap"></script>

    