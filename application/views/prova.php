

        <div>
			
			<ul class="nav nav-pills">
			  <li class="active"><a data-toggle="tab" href="#home">Mapa Tempo-Real</a></li>
			  <li><a data-toggle="tab" href="#menu1">Dados</a></li>
			  <li><a data-toggle="tab" href="#menu2">Mensagens</a></li>
			  <li><a data-toggle="tab" href="#menu3">Checkpoints</a></li>
			  <div class="nome-prova"><?php echo $prova->nome; ?></div>
			</ul>
			
			<div class="tab-content">
			  <div id="home" class="tab-pane fade in active">
			  	<div id="map_toolbar">
			  		<ul>
			  			<li><a href="javascript:centraliza_trajeto(map, trajeto, 1)">Ver Trajeto</a></li>
			  			<li><a href="javascript:centraliza_trajeto(map, trajeto, 2)">Ver Largada</a></li>
			  			<li><a href="javascript:centraliza_trajeto(map, trajeto, 3)">Ver Chegada</a></li>
			  			<li><a href="javascript:centraliza_ciclistas(map, markers)">Centralizar Mapa</a></li>
			  			<li><label><input type="checkbox" id="autocenter"> Auto-centralizar</label></li>
			  			<li class="sep"></li>
			  			<li><label>Atualizar a cada <input type="number" min="1" step="1" id="update-time" value="60" maxlength="2" size="1"> segundos</label></li>
			  		</ul>
			  		<div id="loader">
			  			<img src="assets/img/loader.gif">
			  			<p id="loader-msg">Aguarde, carregando...</p>
			  		</div>
			  	</div>
			    <div id="map"></div>
			  </div>
			  <div id="menu1" class="tab-pane fade">

					<div class="row">
					                    <div class="col-lg-12">
					                     
					                        <div class="table-responsive">
					                            <table class="table table-bordered table-hover table-striped" id="tabela-dados">
					                                <thead>
					                                    <tr>
					                                        <th>Nome</th>
					                                        <th>Data/Hora</th>
					                                        <th>BPM</th>
					                                        <th>Temp. Corp.</th>
					                                        <th>Giro X</th>
					                                        <th>Giro Y</th>
					                                        <th>Giro Z</th>
					                                        <th>Acel X</th>
					                                        <th>Acel Y</th>
					                                        <th>Acel Z</th>
					                                        <th>Direção</th>
					                                        <th>Lat</th>
					                                        <th>Lon</th>
					                                        <th>Altitude</th>
					                                        <th>Temp. Ar</th>
					                                        <th>Umidade Ar</th>
					                                        <th>Pressão Atm.</th>
					                                    </tr>
					                                </thead>
					                                <tbody>
					                                    <tr>
					                                        <td>Fulano de Tal</td>
					                                        <td>29/10/2015 12h00</td>
					                                        <td>122</td>
					                                        <td>37.2º</td>
					                                        <td>122</td>
					                                        <td>34</td>
					                                        <td>-98</td>
					                                        <td>44</td>
					                                        <td>-18</td>
					                                        <td>412</td>
					                                        <td>172º</td>
					                                        <td>-21.9181</td>
					                                        <td>-46.8171</td>
					                                        <td>716 m</td>
					                                        <td>23.7º</td>
					                                        <td>56%</td>
					                                        <td>920 pa</td>
					                                    </tr>
					                                </tbody>
					                            </table>
					                        </div>
					                    </div>
					                    
					                </div>

			  </div>
			  <div id="menu2" class="tab-pane fade">
			    <div class="row">
                    
                    <div class="col-lg-12">
                     
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="tabela-msgs">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Tipo</th>
                                        <th>Data/Hora</th>
                                        <th>Lat</th>
                                        <th>Lon</th>
                                        <th>Altitude</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Fulano de Tal</td>
                                        <td>Fome</td>
                                        <td>29/10/2015 12h00</td>
                                        <td>-21.9181</td>
                                        <td>-46.8171</td>
                                        <td>716 m</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
			  </div>
			  <div id="menu3" class="tab-pane fade">
			    <div class="row">
                    
                    <div class="col-lg-12">
                     
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Prova</th>
                                        <th>Data/Hora</th>
                                        <th>Lat</th>
                                        <th>Lon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>n/d</td>
                                        <td>n/d</td>
                                        <td>n/d</td>
                                        <td>n/d</td>
                                        <td>n/d</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
			  </div>
			</div>
			
            
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   
    
    
    <script>
    var trajeto;
    var map;
    var response = true;
    var ciclistas;
    var markers = [];
    var ballons = [];
    var trajeto_ciclista = [];
    var trajetos_ciclistas = [];
    
    function atualiza_dados(){	
        
        if (response == true){
            response = false;
			$("#loader-msg").html("Aguarde, carregando...");
			$("#loader img").fadeIn();
            $("#loader").fadeIn();
            var req = $.getJSON( "prova/get_bikers/<?php echo $prova->id_prova; ?>", function(ciclistas) {

					// limpa o mapa e trajetos
					limpar_ciclistas(map);
					limpar_trajetos(map);
					
					var infowindow = null;
					var bike_marker = null;
					

					// plota mapa
					
	            	for (var i=0; i < ciclistas.posicoes.length; ++i) {  // percorre ciclistas
		            	
	            	    var ciclista = ciclistas.posicoes[i];

						// cria trajeto deste ciclista
						trajeto_ciclista = [];

	            	    for (var i=0; i < ciclista.dados.length; ++i) { // precorre coordenadas dos ciclistas

		            	    var dados = ciclista.dados[i];

							var latLng = new google.maps.LatLng(dados.lat, dados.lon);
							trajeto_ciclista.push(latLng);
							
							if (i>=0) { // cria balao apenas na ultima posicao da bike
		            	    bike_marker = new google.maps.Marker({
		            	        position: latLng,
		            	        map: map,
		            	        html: "<h4 class='balao-nome'>"+ciclista.nome+"</h4>"+
				            	      " 	<table style='width: 400px;'>"+
				            	      "  <tr>"+
				            	      "  	<td style='width: 40%'><b>Data/Hora Recebimento</b></td><td style='width: 60%'>"+dados.data_hora+"</td>"+
				            	      "  </tr>"+
				            	      "  <tr>	"+
				            	      "  	<td class='balao-titulo' style='width: 100%' colspan='2'>Dados do Ciclista</td>"+
				            	      "  </tr>"+
				            	      "  <tr>	"+
				            	      "  	<td style='width: 40%'><b>BPM</b></td><td style='width: 60%'>"+dados.bpm+"</td>"+
				            	      "  </tr>"+
				            	      "  <tr>	"+
				            	      "  	<td style='width: 40%'><b>Temp. Corporal</b></td><td style='width: 60%'>"+dados.corp_temperatura+" º</td>"+
				            	      "  </tr>	"+
				            	      "  <tr>	"+
				            	      "  	<td style='width: 40%'><b>Oxigenação Sang.</b></td><td style='width: 60%'>n/d</td>"+
				            	      "  </tr>	"+
				            	      "  <tr>	"+
				            	      "  	<td class='balao-titulo' style='width: 100%' colspan='2'>Dados da Bicicleta</td>"+
				            	      "  </tr>	"+
				            	      "  <tr>	"+
				            	      "  	<td style='width: 40%'><b>Giroscópio</b></td><td style='width: 60%'>XYZ ("+dados.giro_x+", "+dados.giro_y+", "+dados.giro_z+")</td>"+
				            	      "  </tr>"+
				            	      "  <tr>	"+
				            	      "  	<td style='width: 40%'><b>Acelerômetro</b></td><td style='width: 60%'>XYZ ("+dados.acel_x+", "+dados.acel_y+", "+dados.acel_z+")</td>"+
				            	      "  </tr>"+
				            	      "  <tr>	"+
				            	      "  	<td style='width: 40%'><b>Direção</b></td><td style='width: 60%'>"+dados.direcao+" º</td>"+
				            	      "  </tr>"+
				            	      "  <tr>	"+
				            	      "  	<td style='width: 40%'><b>Posição</b></td><td style='width: 60%'>"+dados.lat+", "+dados.lon+"</td>"+
				            	      "  </tr>"+
				            	      "  <tr>	"+
				            	      "  	<td style='width: 40%'><b>Altitude</b></td><td style='width: 60%'>"+dados.altitude+" m</td>"+
				            	      "  </tr>"+
				            	      "  <tr>	"+
				            	      "  	<td class='balao-titulo' style='width: 100%' colspan='2'>Dados do Ambiente</td>"+
				            	      "  </tr>	"+
				            	      "  <tr>	"+
				            	      "  	<td style='width: 40%'><b>Temp. Ar</b></td><td style='width: 60%'>"+dados.ar_temperatura+" º</td>"+
				            	      "  </tr>"+
				            	      "  <tr>	"+
				            	      "  	<td style='width: 40%'><b>Umidade Ar</b></td><td style='width: 60%'>"+dados.ar_umidade+" %</td>"+
				            	      "  </tr>"+
				            	      "  <tr>	"+
				            	      "  	<td style='width: 40%'><b>Pressão Bar.</b></td><td style='width: 60%'>"+dados.ar_pressao+" mmHg</td>"+
				            	      "  </tr>"+
				            	      "  <tr>	"+
				            	      "  	<td class='balao-titulo' style='width: 100%' colspan='2'>Última Mensagem</td>"+
				            	      "  </tr>	"+
				            	      "  <tr>	"+
				            	      "  	<td style='width: 40%'><b>Data/Hora</b></td><td style='width: 60%'>"+ciclista.msg.data_hora+"</td>"+
				            	      "  </tr>"+
				            	      "  <tr>	"+
				            	      "  	<td style='width: 40%'><b>Mensagem</b></td><td style='width: 60%'>"+ciclista.msg.tipo+"</td>"+
				            	      "  </tr>"+	
				            	      "  <tr>	"+
				            	      "  	<td style='width: 40%'><b>Posição</b></td><td style='width: 60%'>"+ciclista.msg.lat+", "+ciclista.msg.lon+"</td>"+
				            	      "  </tr>"+	 
				            	      "  <tr>	"+
				            	      "  	<td style='width: 40%'><b>Altitude</b></td><td style='width: 60%'>"+ciclista.msg.altitude+" m</td>"+
				            	      "  </tr>"+           	      
				            	      "  </table>",
		            	        icon: "assets/img/icon-biker.png"
		            	      });
	
		            	      infowindow = new google.maps.InfoWindow({
		            	        content: "Carregando..."
		            	      });
		            	      
		            	     bike_marker.addListener('click', function() {
		            	    	infowindow.setContent(this.html);
		            	        infowindow.open(map, this);
		            	     });
	
		            	     markers.push(bike_marker);
	
							}

	            	    } // posicoes

	            	    
	            	      var plotagem_trageto_ciclista = new google.maps.Polyline({
						    path: trajeto_ciclista,
						    geodesic: true,
						    strokeColor: ciclista.cor_trajeto,
						    strokeOpacity: 1.0,
						    strokeWeight: 2,
						    map: map
						  });
	            	      plotagem_trageto_ciclista.setMap(map);
	            	      
	            	      trajetos_ciclistas.push(plotagem_trageto_ciclista);

	            	      

	            	     // auto centraliza, se estiver marcado
	            	     if ($('#autocenter:checked').length) {
	            	    	 centraliza_ciclistas(map, markers);
		            	 }
						
	    	            
	            	}


	            	// plota dados
	            	$("#tabela-dados tbody").html('');
	            	for (var i=0; i < ciclistas.dados.length; ++i) {
		            	var dado = ciclistas.dados[i];
	            	    var linha = "<tr>"+
			                        "    <td>"+dado.nome+"</td>"+
			                        "    <td>"+dado.data_hora+"</td>"+
			                        "    <td>"+dado.bpm+"</td>"+
			                        "    <td>"+dado.corp_temperatura+"º</td>"+
			                        "    <td>"+dado.giro_x+"</td>"+
			                        "    <td>"+dado.giro_y+"</td>"+
			                        "    <td>"+dado.giro_z+"</td>"+
			                        "    <td>"+dado.acel_x+"</td>"+
			                        "    <td>"+dado.acel_y+"</td>"+
			                        "    <td>"+dado.acel_z+"</td>"+
			                        "    <td>"+dado.direcao+" º</td>"+
			                        "    <td>"+dado.lat+"</td>"+
			                        "    <td>"+dado.lon+"</td>"+
			                        "    <td>"+dado.altitude+" m</td>"+
			                        "    <td>"+dado.ar_temperatura+" º</td>"+
			                        "    <td>"+dado.ar_umidade+" %</td>"+
			                        "    <td>"+dado.ar_pressao+" mmHg</td>"+
			                        "</tr>";
	            	    $("#tabela-dados tbody").append(linha);
	            	}


	            	// plota msgs
	            	$("#tabela-msgs tbody").html('');
	            	for (var i=0; i < ciclistas.msgs.length; ++i) {
		            	var msg = ciclistas.msgs[i];
		            	var linha = "<tr>"+
			                        "    <td>"+msg.nome+"</td>"+
			                        "    <td>"+msg.tipo+"</td>"+
			                        "    <td>"+msg.data_hora+"</td>"+
			                        "    <td>"+msg.lat+"</td>"+
			                        "    <td>"+msg.lon+"</td>"+
			                        "    <td>"+msg.altitude+" m</td>"+
			                        "</tr>";
		            	$("#tabela-msgs tbody").append(linha);
	            	}
	            	
            	}).done(function() {
            		response = true;
            		$("#loader").fadeOut();
            	}).error(function() {
            		$("#loader img").hide();
            		$("#loader-msg").html("Erro ao obter dados! <a href='javascript:reiniciar_dados();'>Tentar Novamente.</a>");
                });    
        }
        setTimeout("atualiza_dados()", parseInt($("#update-time").val(), 10)*1000); // 1 segundo
    }

    function reiniciar_dados(){	
    	response = true;
    	atualiza_dados();
    }


    function limpar_ciclistas(map) {
    	  for (var i = 0; i < markers.length; i++) {
    	    markers[i].setMap(null);
    	  }
    	  markers = [];
    	  ballons = [];
    }

    function limpar_trajetos(map) {
  	  for (var i = 0; i < trajetos_ciclistas.length; i++) {
  		trajetos_ciclistas[i].setMap(null);
  	  }
  	  trajetos_ciclistas = [];
  }
    		

function initMap() {
	
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 18,
    center: {lat: -21.972000, lng: -46.7720442},
    mapTypeId: google.maps.MapTypeId.HYBRID
  });

  var jsonData = {"overview_trajeto" : {
      "points" : "<?php echo $prova->trajeto; ?>"}};
  var path = google.maps.geometry.encoding.decodePath(jsonData.overview_trajeto.points);

  
  trajeto = new google.maps.Polyline({
      path: path,
      strokeColor: 'orange',
      strokeOpacity: 0.5,
      strokeWeight: 5,
      fillColor: '#FF0000',
      fillOpacity: 0.35,
      map: map
  });
  
  trajeto.setMap(map);

  	var startMarker = new google.maps.Marker({
      position: trajeto.getPath().getAt(0), 
      map:map,
      animation: google.maps.Animation.DROP,
      icon: "http://www.google.com/intl/en_de/mapfiles/icon-dd-play-trans.png"
    });
	var endMarker =  new google.maps.Marker({
      position: trajeto.getPath().getAt(trajeto.getPath().getLength()-1), 
      map:map,
      animation: google.maps.Animation.DROP,
      icon: "http://www.google.com/intl/en_de/mapfiles/icon-dd-stop-trans.png"
    });
  
  centraliza_trajeto(map, trajeto, 1);
  
  // inicia captura de dados
  atualiza_dados();
  
}


// centraliza
function centraliza_trajeto(map, polyline, tipo) {
	  var bounds = new google.maps.LatLngBounds();
	  var points = polyline.getPath().getArray();

	  if (tipo==1) {
		  for (var n = 0; n < points.length ; n++){
		      bounds.extend(points[n]);
		  }
	  } else if (tipo==3) {
		  bounds.extend(points[points.length-1]);
	  } else if (tipo==2) {
		  bounds.extend(points[0]);
	  }

	  map.fitBounds(bounds);
}

function centraliza_ciclistas(map, markers) {
	  var bounds = new google.maps.LatLngBounds();
	  //var points = polyline.getPath().getArray();

	  for (var n = 0; n < markers.length ; n++){
		bounds.extend(markers[n].position);
      }
	 
	  map.fitBounds(bounds);
}

    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnHZBnaTphUHLT4ow884Cd24itv9x-D8Y&signed_in=true&callback=initMap&libraries=geometry"></script>

    