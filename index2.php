<!-- mozna naky doctype tady jeste -->
<html>

<head>
	<title>WEATHER APPLICATION</title>
	  	<link href='css/styles.css' rel='stylesheet' type='text/css'/>
		<link rel="favicon" href="images/logo.png" />
</head>

<body>
<div style="background-color:black;">
	<div style="width:75%; margin:0 auto;">
		<table>
			<tr>
				<td>
					<img src="images/logo2.png" style="margin-top:1px;"/>
				</td>
				<td nowrap="nowrap">
					<span style="font-size:36pt; padding:0 8px; font-weight:bold;">WEATHER</span>
				</td>
				<td width="100%">
				</td>
				<td nowrap="nowrap" align="right">
				<div style="font-size: 26px;">
					Today is: 
					<?php
						$datum = StrFTime("%d.%m.%Y", Time());
						$cas = StrFTime("%H:%M", Time());
						echo($datum."<br>");
						echo($cas);
					?>
				</div>
				</td>
			</tr>
		</table>
	</div>
</div>

<!-- toto je druhy pruh location a den v tydnu, uzky -->
<div style="background-color:#111111; font-size:10pt; color:white;">

		<table style="width:75%; height:80px; margin:0 auto; font-size: 34px; font-weight:bold;">
			<tr>
				<td align="center" width="20%">
					LOCATION
				</td>
				
				<td align="center" width="25%">
				MONDAY <br/>
				<div style="font-size: 17px;"><?php
					$datum = StrFTime("%d.%m.%Y", Time());
							echo($datum."<br>"); //neholduji zarovnavani
							?>
							</div>
				</td>
				<td align="left" width="55%">
				</td>
			</tr>
		</table>
</div>


<!-- prostredni pruh -->
<div style="background-color:black; height:360px;">
	<table style="width:75%; height:360px; margin:0 auto;" cellspacing="0" cellpadding="0" border="0">
		<tr>
		
			<td align="left" valign="top" width="20%" style="color:white;">
				<table style="width:100%; height:350px; font-size: 20px;" cellspacing="0" cellpadding="0" border="0"">
					<tr><td>Wind</td><td>3 m/s</td></tr>
					<tr><td>Humidity</td><td>a</td></tr>
					<tr><td>Precipitation</td><td>a</td></tr>
					<tr><td>Air pressure</td><td>a</td></tr>
					<tr><td>Sunrise</td><td>a</td></tr>
					<tr><td>Sunset</td><td>a</td></tr>
				</table>
			</td>
			<td align="left" valign="top" width="25%" style="color:white;">
				<table style="width:100%; height:350px; font-size: 28px; font-weight: bold; margin:0 auto;" cellspacing="0" cellpadding="0" border="0">
					<tr> <td align="center"> 14:00</td></tr>
					<tr><td align="center"><img width="65%" src="images/sunny.png"></td></tr>
					<tr><td align="center">22 C</td></tr>
				</table>
								
				
			</td>
			<td align="left" valign="center" width="55%" style="color:white;">
				<table valign="center" align="center" style="width:100%; height:285px; text-align:center; font-size: 20px;" cellspacing="1" cellpadding="1" border="3">
					<tr height="10%" style="font-weight: bold;"><td>15:00</td><td>16:00</td><td>17:00</td><td>18:00</td><td>19:00</td><td>20:00</td></tr>
					<tr>
						<td><img width="100%" src="images/sunny.png"><br /> 21 C <br /> 0 mm</td>
						<td><img width="100%" src="images/sunny.png"><br /> 21 C <br /> 0 mm</td>
						<td><img width="100%" src="images/cloudy.png"><br /> 21 C <br /> 0 mm</td>
						<td><img width="100%" src="images/storm.png"><<br /> 21 C <br /> 0 mm</td>
						<td><img width="100%" src="images/rainy.png"><br /> 21 C <br /> 0 mm</td>
						<td><img width="100%" src="images/sunny.png"><br /> 21 C <br /> 0 mm</td></tr>
										
				</table>
								
				
			</td>
		</tr>
	</table>
</div>

<!-- GRAAAAAAAAAAAAAAAAAAF -->
<div style="background-color:#111111; font-size:10pt; color:white;">

		<table style="width:75%; height:120px; margin:0 auto;">
			<tr>
				<td>
					Tady je ten graf, kterej nevim, jak udelat. :D
				</td>
			
				
			</tr>
		</table>

</div>


<div class="hr">
<hr>
</div>

<!-- PREDPOVED NA TYDEN -->
<div style="background-color:black; height:350px;">
	<table style="width:75%; height:350px; margin:0 auto; text-align:center;" cellspacing="2" cellpadding="2" border="0">
		<tr>
			<td align="left" valign="center" width="14%" style="color:white;">
				<table style="width:100%; height:340px; text-align:center; font-weight: bold; font-size: 20px;" cellspacing="1" cellpadding="1" border="1"">
					<tr><td>Tuesday</td></tr>
					<tr><td><img width="70%" src="images/sunny.png"></td></tr>
					<tr><td><span style="font-size: 26px;">17 C / 15 C</span></td></tr>
				<tr><td align="left" ><span style="font-size: 14px;">Wind: </span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Humidity:</span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Precipitation: </span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Air pressure:</span></td></tr>
				</table>
			</td>
			<td align="left" valign="center" width="14%" style="color:white;">
				<table style="width:100%; height:340px; text-align:center; font-weight: bold; font-size: 20px;" cellspacing="1" cellpadding="1" border="1"">
					<tr><td>Wednesday</td></tr>
					<tr><td><img width="70%" src="images/rainy.png"></td></tr>
					<tr><td><span style="font-size: 26px;">17 C / 15 C</span></td></tr>
				<tr><td align="left" ><span style="font-size: 14px;">Wind: </span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Humidity:</span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Precipitation: </span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Air pressure:</span></td></tr>
				</table>
			</td>
			<td align="left" valign="center" width="14%" style="color:white;">
				<table style="width:100%; height:340px; text-align:center; font-weight: bold; font-size: 20px;" cellspacing="1" cellpadding="1" border="1"">
					<tr><td>Thursday</td></tr>
					<tr><td><img width="70%" src="images/sunny.png"></td></tr>
					<tr><td><span style="font-size: 26px;">17 C / 15 C</span></td></tr>
					<tr><td align="left" ><span style="font-size: 14px;">Wind: </span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Humidity:</span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Precipitation: </span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Air pressure:</span></td></tr>
				</table>
			</td>
			<td align="left" valign="center" width="14%" style="color:white;">
				<table style="width:100%; height:340px; text-align:center; font-weight: bold; font-size: 20px;" cellspacing="1" cellpadding="1" border="1"">
					<tr><td>Friday</td></tr>
					<tr><td><img width="70%" src="images/cloudy.png"></td></tr>
					<tr><td><span style="font-size: 26px;">17 C / 15 C</span></td></tr>
					<tr><td align="left" ><span style="font-size: 14px;">Wind: </span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Humidity:</span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Precipitation: </span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Air pressure:</span></td></tr>
				</table>
			</td>
			<td align="left" valign="center" width="14%" style="color:white;">
				<table style="width:100%; height:340px; text-align:center; font-weight: bold; font-size: 20px;" cellspacing="1" cellpadding="1" border="1"">
					<tr><td>Saturday</td></tr>
					<tr><td><img width="70%" src="images/storm.png"></td></tr>
					<tr><td><span style="font-size: 26px;">17 C / 15 C</span></td></tr>
					<tr><td align="left" ><span style="font-size: 14px;">Wind: </span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Humidity:</span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Precipitation: </span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Air pressure:</span></td></tr>
				</table>
			</td>
			<td align="left" valign="center" width="14%" style="color:white;">
				<table style="width:100%; height:340px; text-align:center; font-weight: bold; font-size: 20px;" cellspacing="1" cellpadding="1" border="1"">
					<tr><td>Saturday</td></tr>
					<tr><td><img width="70%" src="images/rainy.png"></td></tr>
					<tr><td><span style="font-size: 26px;">17 C / 15 C</span></td></tr>
					<tr><td align="left" ><span style="font-size: 14px;">Wind: </span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Humidity:</span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Precipitation: </span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Air pressure:</span></td></tr>
				</table>
			</td>
			<td align="left" valign="center" width="14%" style="color:white;">
				<table style="width:100%; height:340px; text-align:center; font-weight: bold; font-size: 20px;" cellspacing="1" cellpadding="1" border="1"">
					<tr><td>Monday</td></tr>
					<tr><td><img width="70%" src="images/rainy.png"></td></tr>
					<tr><td><span style="font-size: 26px;">17 C / 15 C</span></td></tr>
					<tr><td align="left" ><span style="font-size: 14px;">Wind: </span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Humidity:</span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Precipitation: </span></td></tr>
					<tr><td align="left"><span style="font-size: 14px;">Air pressure:</span></td></tr>
				</table>
			</td>
		
		</tr>
	</table>
</div>


<div class="hr">
<hr>
</div>


<br/>
<br/>
<br/>
<br/>
</body>
</html>