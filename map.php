<?php
	session_start();
	require_once "utils//TransportDAO.php";
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Display a map</title>
	<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
	<script src="https://api.mapbox.com/mapbox-gl-js/v2.0.1/mapbox-gl.js"></script>
	<link href="https://api.mapbox.com/mapbox-gl-js/v2.0.1/mapbox-gl.css" rel="stylesheet" />
	<style>
		body {
			margin: 0;
			padding: 0;
		}

		#map {
			position: absolute;
			top: 0;
			bottom: 0;
			width: 100%;
		}
	</style>
</head>

<body>
	<div id="map"></div>
	<script>
		// TO MAKE THE MAP APPEAR YOU MUST
		// ADD YOUR ACCESS TOKEN FROM
		// https://account.mapbox.com
		mapboxgl.accessToken = 'pk.eyJ1IjoicXVpY2toYXdrIiwiYSI6ImNrazVidTBreTAzenQyc29hZzVzaGhhYm0ifQ.EW4dmHaAG41a4jgYlSMjHg';

		<?php
			if(isset($_SESSION['Patient_ID']))
				$tid = (new TransportDAO())->get_transport_id_from_patient($_SESSION['Patient_ID']);
				
			else
				$tid = (new TransportDAO())->get_transport_id($_SESSION['Driver_ID']);

			
			$s = json_decode((new TransportDAO())->get_patient_coord($tid), true)[0];
			$e = json_decode((new TransportDAO())->get_hospital_coord($tid), true)[0];

			// print_r($s);

		?>

		var map = new mapboxgl.Map({
			container: 'map', // container id
			style: 'mapbox://styles/mapbox/streets-v11', // style URL
			<?php

				echo "center: [" . $s['LocationFromLat'] . ", " . $s['LocationFromLong'] . "], ";
			?>
			zoom: 16 
		});
		
		map.on('load', function() {
			map.addSource('route', {
				'type': 'geojson',
				'data': {
					'type': 'Feature',
					'properties': {},
					'geometry': {
						'type': 'LineString',
						'coordinates': <?php echo (new TransportDAO())->route_coord(
							$s['LocationFromLat'], $s['LocationFromLong'],
							$e['LocationToLat'], $e['LocationToLong']
						)?>
					}
				}
			});
			map.addLayer({
				'id': 'route',
				'type': 'line',
				'source': 'route',
				'layout': {
					'line-join': 'round',
					'line-cap': 'round'
				},
				'paint': {
					'line-color': 'orangered',
					'line-width': 8
				}
			});
		});
	</script>

</body>

</html>