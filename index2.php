<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
      
		function prepareChart() {
			google.charts.setOnLoadCallback(drawChart);
		}

		function drawChart() {
			var jsonData = $.ajax({
			url: "index.php",
			dataType: "json",
			async: false
			}).responseText;
			alert(jsonData);
			// Create our data table out of JSON data loaded from server.
			var data = new google.visualization.DataTable(jsonData);

			var options = {
				legend: {position: 'none'},
				backgroundColor: '#000000'
			};



			// Instantiate and draw our chart, passing in some options.
			var chart = new google.visualization.LineChart(document.getElementById('chart'));
			chart.draw(data, options);
    	}
    </script>

<?php
    include 'service/weatherService.php';
	//include 'test.php';
    // for loading installed dependencies
    require __DIR__ . '/vendor/autoload.php';

    if (isset($_POST['city'])) {

        #$cityLocation = getCityLocation($_POST['city']);
    	#$weatherInfo = getWeatherInfoForLocation($cityLocation);
		#print_r(json_encode($weatherInfo));	
		$weatherInfo = json_decode(file_get_contents("test.json", FILE_USE_INCLUDE_PATH), True);	
		$current = current($weatherInfo['current']);
		session_start();
		$chartData = $weatherInfo['chart'];
		$_SESSION['chart'] = $chartData;
		echo "<script> prepareChart(); </script>";

		$today = current($weatherInfo['forecastLong']);
        //TODO insert to html
    }
?>

<html>

<head>

	<title>WEATHER APPLICATION</title>
	  	<link href='css/styles.css' rel='stylesheet' type='text/css'/>
		<link rel="favicon" href="images/logo.png" />
</head>
<script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('clock').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i}; 
    return i;
}
</script>
<body onload="startTime()">
<div style="background-color:black;">
	<div style="width:80%; margin:0 auto;">
		<table>
			<tr>
				<td>
					<img src="images/logo2.png" style="margin-top:1px;"/>
				</td>
				<td nowrap="nowrap">
					<span style="font-size:36pt; padding:0 8px; font-weight:bold;">WEATHER</span>
				</td>
				<td width="100%">
					<form method="post">
						Location
						<input type="text" name="city" value=<?php echo isset($_POST['city']) ? $_POST['city'] : ""; ?>>
						<input type="Submit" value="Submit"> 
					</form>	
				</td>	
				<td nowrap="nowrap" align="right">
				<div style="font-size: 26px;">
					Today is: 
					<?php
						$datum = StrFTime("%Y-%m-%d", Time());
						echo($datum."<br>");
					?>
					<div id="clock"></div>
				</div>
				</td>
			</tr>
		</table>
	</div>
</div>

<!-- toto je druhy pruh location a den v tydnu, uzky -->
<div id="hide" style="display:<?php echo (isset($weatherInfo) ? 'block':'none');?> ">
	<div style="background-color:#111111; font-size:10pt; color:white; ">

			<table style="width:80%; height:80px; margin:0 auto; font-size: 34px; font-weight:bold;">
				<tr>
					<td align="center" width="20%">
						<?php echo $_POST['city']; ?>
					</td>
					
					<td align="center" width="25%">
					<?php echo date("l"); ?> <br/>
					</td>
					<td align="left" width="55%">
					</td>
				</tr>
			</table>
	</div>


	<!-- prostredni pruh -->
	<div style="background-color:black; height:360px;">
		<table style="width:80%; height:360px; margin:0 auto;" cellspacing="0" cellpadding="0" border="0">
			<tr>
			
				<td align="left" valign="top" width="20%" style="color:white;">
					<table style="width:100%; height:350px; font-size: 20px;" cellspacing="0" cellpadding="0" border="0"">
						<tr><td>Wind</td><td> <?php echo $current[wind]; ?> m/s</td></tr>
						<tr><td>Humidity</td><td> <?php echo $current[humidity]; ?> %</td></tr>
						<tr><td>Precipitation</td><td> <?php echo $current[precipitation]; ?> mm</td></tr>
						<tr><td>Air pressure</td><td> <?php echo $current[pressure]; ?></td></tr>
						<tr><td>Sunrise</td><td> <?php echo $today['sunrise']; ?></td></tr>
						<tr><td>Sunset</td><td> <?php echo $today['sunset']; ?></td></tr>
					</table>
				</td>
				<td align="left" valign="top" width="25%" style="color:white;">
					<table style="width:100%; height:350px; font-size: 28px; font-weight: bold; margin:0 auto;" cellspacing="0" cellpadding="0" border="0">
						<tr><td align="center"><img width="65%" src="images/<?php echo getIconPath($current[desc]); ?>"></td></tr>
						<tr><td align="center"><?php echo $current[temp]; ?> °C</td></tr>
					</table>
									
					
				</td>
				<td align="left" valign="center" width="65%" style="color:white;">
					<table valign="center" align="center" style="width:100%; height:285px; text-align:center; font-size: 15px;" cellspacing="1" cellpadding="1" border="3">
						<tr height="10%" style="font-weight: bold;">
							<?php
								foreach(array_keys($weatherInfo['current']) as $hour) {
							?>
									<td><?php echo $hour; ?></td>
							<?php
								}
							?>			
						</tr>
						<tr>
							<?php 
								foreach($weatherInfo['current'] as $hour => $values) { 
							?>
							<td><img width="80%" src="images/<?php echo getIconPath($values[desc]); ?>"><br /><?php echo $values['temp']; ?> °C <br /> <?php echo $values['qpf'] ?> mm</td>
							<?php 
								}
							?>
						</tr>					
					</table>
				</td>
			</tr>
		</table>
	</div>

	<!-- GRAAAAAAAAAAAAAAAAAAF -->
	<div style="background-color:#111111; font-size:10pt; color:white;">
			<table style="width:80%; height:120px; margin:0 auto;">
				<tr>
					<td>
					<div id="chart"></div>
					</td>
				</tr>
			</table>
	</div>


	<div class="hr">
	<hr>
	</div>

	<!-- PREDPOVED NA TYDEN -->
	<div style="background-color:black; height:350px;">
		<table style="width:80%; height:350px; margin:0 auto; text-align:center;" cellspacing="2" cellpadding="2" border="0">
			<tr>
				<?php 
					foreach($weatherInfo['forecastLong'] as $key => $value) {
						if (strcmp($datum, $key) === 0 || $key < $datum) {
							continue;
						}	
				?>
				<td align="left" valign="center" width="10%" style="color:white;">
					<table style="width:100%; height:340px; text-align:center; font-weight: bold; font-size: 20px;" cellspacing="1" cellpadding="1" border="1"">
						<tr><td><?php echo $value['weekday']; ?></td></tr>
						<tr><td><img width="50%" src="images/<?php echo getIconPath($value[day][desc]); ?>"></td></tr>
						<tr><td><span style="font-size: 22px;"><?php echo $value[day][temp]; ?> °C / <?php echo $value['night'][temp]; ?> °C</span></td></tr>
						<tr><td align="left" ><span style="font-size: 14px;">Wind: <?php echo $value[day][wind]; ?> m/s</span></td></tr>
						<tr><td align="left"><span style="font-size: 14px;">Humidity: <?php echo $value[day][humidity]; ?> %</span></td></tr>
						<tr><td align="left"><span style="font-size: 14px;">Precipitation: <?php echo $value[precipitation]; ?> mm</span></td></tr>
					</table>
				</td>
				<?php 
					}
				?>	
			</tr>
		</table>
	</div>
	<div class="hr">
	<hr>
	</div>
</div>

<br/>
<br/>
<br/>
<br/>
</body>
</html>