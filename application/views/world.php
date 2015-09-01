<?php 
	session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Pokemon - Google Maps</title>
	<!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="/materialize/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
	<style type="text/css">
      html, body { height: 100%; margin: 0; padding: 0; }
      #map { 
      	height: 500px; 
      	/*margin-left: 250px;*/
      	/*margin-right: 250px;*/
      	width: 500px;
      	display: inline-block;
      	text-align: top;
      }
      .starter_pokemon{
      	width: 250px;
      	display: inline-block;
      	vertical-align: top;
      }
     
    </style>
<!-- Script utilizing pokeapi for pokemon info -->
    <script>
    	$(document).ready(function(){ 
    		var id = "<?=$this->session->userdata('starter')?>";  
            $.get("http://pokeapi.co/api/v1/pokemon/"+id, function(res){
            		$('.starter_info').html(
            			"<h3>"+res.name+"</h3>"+
            			
            			"<p>Height: "+res.height+"</p>"+
            			"<p>Weight: "+res.weight+"</p>"
            			);
            		$('.poke_name').html(res.name);
            	}, "json");

            $('#loc1').click(function(){
            	pointloc = seattle;
            	alert('seattle');
            });
            $('#loc2').click(function(){
            	pointloc = beverly;
            	alert('la');
            });
            $('#loc3').click(function(){
            	pointloc = ny;
            	alert('ny');
            });
        })
    
	// <!-- initialize the world map through Google Maps API -->
		var map;
		var seattle = {lat: 47.615722, lng: -122.195017};
		var la = {lat: 34.062319, lng: -118.249512};
		var beverly = {lat: 34.074595, lng: -118.379533};
		var ny = {lat: 40.778164, lng:- 73.971355};
		// var miami = {lat: 25.686667, lng:- 80.396595};
		var miami = {lat: 25.688755, lng:- 80.312609};
		var pointstr = <?=$this->session->userdata('location')?>;
		var pointloc = pointstr;

		var teststr = "<p>Brock's Gym.</p><p>This gym leader specializes in rock type pokemon, such as Onyx and Geodude.</p><p><img src='/assets/brock_img_02.png'></p>";



		function initMap() {
		  	map = new google.maps.Map(document.getElementById('map'), {
			    center: pointloc,
			    zoom: 15,
			    disableDefaultUI: true,
			    mapTypeControlOptions: {
			      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
			      mapTypeIds: [
			        google.maps.MapTypeId.ROADMAP,
			        google.maps.MapTypeId.TERRAIN
			      ]
			    }
		 	 });

	

		  	
			var pokecenter_icon = {
			    url: "/assets/pokecenter_icon.png", // url
			    scaledSize: new google.maps.Size(35,35 ), // scaled size
			    origin: new google.maps.Point(0,0), // origin
			    anchor: new google.maps.Point(0, 0) // anchor
			};

			// var pokecenter = new google.maps.Marker({
   //  			position: {lat: 47.610886, lng: -122.197672},
   //  			map: map,
   //  			title: 'Pokecenter',
   //  			icon: pokecenter_icon
  	// 		});

  			var pokemart_icon = {
			    url: "/assets/pokemart_icon.png", // url
			    scaledSize: new google.maps.Size(35,35 ), // scaled size
			    origin: new google.maps.Point(0,0), // origin
			    anchor: new google.maps.Point(0, 0) // anchor
			};

			// var pokemart = new google.maps.Marker({
   //  			position: {lat: 47.618987, lng: -122.205483},
   //  			map: map,
   //  			title: 'Pokemart',
   //  			icon: pokemart_icon
  	// 		});
  	// 		var pokemart_02 = new google.maps.Marker({
   //  			position: {lat: 47.611486, lng: -122.195565},
   //  			map: map,
   //  			title: 'Pokemart',
   //  			icon: pokemart_icon
  	// 		});

  			// Gym features
  			// Gym marker icon
  			var gym_icon = {
			    url: "/assets/gym_01.png", // url
			    scaledSize: new google.maps.Size(52,35 ), // scaled size
			    origin: new google.maps.Point(0,0), // origin
			    anchor: new google.maps.Point(0, 0) // anchor
			};
			// Gym infowindow content
			var gym_string_01 = "<p>Brock's Gym.</p><p>This gym leader specializes in rock type pokemon, such as Onyx and Geodude.</p><p><img src='/assets/brock_img_02.png'></p><a href='google'><button>click here</button></a>";

			// var gym_01 = new google.maps.Marker({
   //  			position: {lat: 47.615015, lng: -122.198347},
   //  			map: map,
   //  			title: 'Rock Gym!',
   //  			icon: gym_icon
  	// 		});	

  	// 		var infowindow_gym = new google.maps.InfoWindow({
		 //    	content: gym_string_01
		 // 	});

			// // Listener to open infowindow
  	// 		gym_01.addListener('click', function() {
			//     infowindow_gym.open(map, gym_01);
			//   });
  	// 		// Listener to close infowindw
  	// 		google.maps.event.addListener(map, "click", function(event){
			// 	infowindow_gym.close();
			// });
  			// Creation of player sprite
			var player_sprite = "/assets/player_sprite_01.png";
  			var player_marker = new google.maps.Marker({
    			position: {lat: 47.609813, lng: -122.196613},
    			map: map,
    			title: 'You',
    			icon: player_sprite,
    			draggable: true
  			});	

  			// Search for Google Places
  			var service = new google.maps.places.PlacesService(map);
  			// Search for "supermarkets" => pokemarts
			  service.nearbySearch({
			    location: pointloc,
			    radius: 1000,
			    types: ['supermarket']
			  }, callback_mart);

			// Search for "gyms" => gyms
			  service.nearbySearch({
			    location: pointloc,
			    radius: 1000,
			    types: ['gym']
			  }, callback_gym);

			// Search for "pharmacy" => pokecenters
			  service.nearbySearch({
			    location: pointloc,
			    radius: 1000,
			    types: ['pharmacy']
			  }, callback_pokecenter);
	
		}

		function callback_mart(results, status) {
		  if (status === google.maps.places.PlacesServiceStatus.OK) {
		    for (var i = 0; i < 8; i++) {
		      createMart(results[i]);
		    }
		  }
		}

		function callback_gym(results, status) {
		  if (status === google.maps.places.PlacesServiceStatus.OK) {
		    for (var i = 0; i < 8; i++) {
		      createGym(results[i], i);
		    }
		  }
		}

		function callback_pokecenter(results, status) {
		  if (status === google.maps.places.PlacesServiceStatus.OK) {
		    for (var i = 0; i < 8; i++) {
		      createPokecenter(results[i]);
		    }
		  }
		}

		function createMart(place) {
			var pokemart_icon = {
			    url: "/assets/pokemart_icon.png", // url
			    scaledSize: new google.maps.Size(35,35 ), // scaled size
			    origin: new google.maps.Point(0,0), // origin
			    anchor: new google.maps.Point(0, 0) // anchor
			};
		  var placeLoc = place.geometry.location;
		  var marker = new google.maps.Marker({
		    map: map,
		    position: place.geometry.location,
		    icon: pokemart_icon
		  });

		  google.maps.event.addListener(marker, 'click', function() {
		    infowindow.setContent(place.name);
		    infowindow.open(map, this);
		  });
		}

		function createGym(place, i) {
			var gym_icon = {
			    url: "/assets/gym_01.png", // url
			    scaledSize: new google.maps.Size(52,35 ), // scaled size
			    origin: new google.maps.Point(0,0), // origin
			    anchor: new google.maps.Point(0, 0) // anchor
			};

			var count = i;
		  var placeLoc = place.geometry.location;
		  var i = new google.maps.Marker({
		    map: map,
		    position: place.geometry.location,
		    icon: gym_icon
		  });

		   // var gym_string_01 = "<p>Brock's Gym.</p><p>This gym leader specializes in rock type pokemon, such as Onyx and Geodude.</p><p><img src='/assets/misty_img.png'></p>";

		   var gym_strings = [
		   "<p>Brock's Gym.</p><p>This gym leader specializes in rock type pokemon, such as Onyx and Geodude.</p><p><img src='/assets/brock_img_02.png'></p><a href='google'><button>click here</button></a>",
		   "<p>Misty's Gym.</p><p>This gym leader specializes in water type pokemon, such as Starmie and Goldeen.</p><p><img src='/assets/misty_img.png'></p><a href='google'><button>click here</button></a>",
		   "<p>Giovanni's Gym.</p><p>This gym leader specializes in ground type pokemon, such as Sandslash.</p><p><img src='/assets/giovanni_img.png'></p><a href='google'><button>click here</button></a>",
		   "<p>Sabrina's Gym.</p><p>This gym leader specializes in psychic type pokemon, such as Alakazam.</p><p><img src='/assets/sabrina_img.png'></p><a href='google'><button>click here</button></a>",
		   "<p>Giovanni's Gym.</p><p>This gym leader specializes in ground type pokemon, such as Sandslash.</p><p><img src='/assets/giovanni_img.png'></p><a href='google'><button>click here</button></a>",
		   "<p>Misty's Gym.</p><p>This gym leader specializes in water type pokemon, such as Starmie and Goldeen.</p><p><img src='/assets/misty_img.png'></p><a href='google'><button>click here</button></a>",
		   "<p>Brock's Gym.</p><p>This gym leader specializes in rock type pokemon, such as Onyx and Geodude.</p><p><img src='/assets/brock_img_02.png'></p><a href='google'><button>click here</button></a>",
		   "<p>Misty's Gym.</p><p>This gym leader specializes in water type pokemon, such as Starmie and Goldeen.</p><p><img src='/assets/misty_img.png'></p><a href='google'><button>click here</button></a>"];

		   var gym_str = gym_strings[count];
		   // var gym_str = gym_strings[1];

		  // google.maps.event.addListener(i, 'click', function() {
		  //   infowindow.setContent(gym_string_01);
		  //   infowindow.open(map, this);
		  // });


  			var infowindow_gym = new google.maps.InfoWindow({
		    	content: gym_str
		 	});

		 	i.addListener('click', function() {
			    infowindow_gym.open(map, i);
			  });
  			// Listener to close infowindw
  			google.maps.event.addListener(map, "click", function(event){
				infowindow_gym.close();
			});



		}

		function createPokecenter(place) {
			var pokecenter_icon = {
			    url: "/assets/pokecenter_icon.png", // url
			    scaledSize: new google.maps.Size(35,35 ), // scaled size
			    origin: new google.maps.Point(0,0), // origin
			    anchor: new google.maps.Point(0, 0) // anchor
			};
		  var placeLoc = place.geometry.location;
		  var marker = new google.maps.Marker({
		    map: map,
		    position: place.geometry.location,
		    icon: pokecenter_icon
		  });

		  google.maps.event.addListener(marker, 'click', function() {
		    infowindow.setContent(place.name);
		    infowindow.open(map, this);
		  });
		}


		document.onkeydown = checkKey;

		function checkKey(e) {

		    e = e || window.event;

		    if (e.keyCode == '38') {
		        // up arrow
		        console.log('up');
		        player_marker.position = {lat:47.619813,lng:-122.196613};
		    }
		    else if (e.keyCode == '40') {
		        // down arrow
		        console.log('down');
		    }
		    else if (e.keyCode == '37') {
		       // left arrow
		       console.log('left');
		    }
		    else if (e.keyCode == '39') {
		       // right arrow
		       console.log('right');
		    }

		}	


	</script>	




</head>
<body>
	<h2>The world of Pokemon</h2>
	<p>You start your adventure with your pal <span class='poke_name'></span> here</p><br>
	<div class='starter_pokemon'>
		<div class='starter_info'>
		</div>
	<?php
		if($this->session->userdata('starter')==7)
		{
	?>	
		<img class='starter' src='/assets/squirtle_img.png'>
	<?php
		}
		elseif($this->session->userdata('starter')==4)
		{
	?>
		<img class='starter' src='/assets/charmander_img.png'>
	<?php
		}
		elseif($this->session->userdata('starter')==1)
		{
	?>
		<img class='starter' src='/assets/bulbasaur_img.png'>
	<?php
		}
	?>
	</div>
	<div id="map"></div>
	<script src="https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places&callback=initMap" async defer></script>
	<a href='/'><button>Return</button></a>
	<!-- <button id='loc1'>Seattle</button>
	<button id='loc2'>Los Angeles</button>
	<button id='loc3'>New York City</button> -->

</body>
</html>