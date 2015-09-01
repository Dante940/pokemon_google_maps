<!DOCTYPE HTML>
<html>
<head>
	<title>Choose your pokemon!</title>
	<link type="text/css" rel="stylesheet" href="/materialize/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
</head>
<body>
	<h1>Choose your pokemon!</h1>
	<form action='/starter/choose/' method='post'>
		
		<input type='radio' name='starter_poke' value='7' checked='checked' id='poke1'>
		<label for='poke1'><img src="/assets/squirtle_img.png"><br>Squirtle</label>
		
		<input type='radio' name='starter_poke' value='4' id='poke2'>
		<label for='poke2'><img src="/assets/charmander_img.png"><br>Charmander</label>
		
		<input type='radio' name='starter_poke' value='1' id='poke3'>
		<label for='poke3'><img src="/assets/bulbasaur_img.png"><br>Bulbasaur</label>
		<input type='submit' value='I choose you!'>
		<br>
		<p>Starting Town:</p>
		<input type='radio' name='location' value='seattle' id='loc1' checked='checked'>
		<label for='loc1'>Seattle</label>
		<input type='radio' name='location' value='beverly' id='loc2'>
		<label for='loc2'>Los Angeles</label>
		<input type='radio' name='location' value='ny' id='loc3'>
		<label for='loc3'>New York City</label>
		<input type='radio' name='location' value='miami' id='loc4'>
		<label for='loc4'>Miami</label>
	</form>
</body>
</html>
