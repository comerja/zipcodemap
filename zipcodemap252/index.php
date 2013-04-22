<!DOCTYPE html>
<html>
<head>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAZi4epp-NctvuWW-dyvGUlhlX-_GZrXlE&sensor=false">
</script>
 
<script>
<!-- Creates global variable and arrays so that they can be used throughout entire script and throughout functions -->
var map;
var mlat = [];
var mlng = [];
 
function initialize()
{
	<!-- Sets up all the map properties. Center of map, zoom, and type of map  -->
	var mapProp = {
		center:new google.maps.LatLng(38,-77),
		zoom:5,
		mapTypeId:google.maps.MapTypeId.TERRAIN
		};
		
		<!-- Creates the map with the map properties set above and places in variable map -->
		map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
		
		<!-- Traverses the arrays until they are empty -->
		while(mlat.length && mlng.length){
			<!-- Takes a set of latitudes and longitudes and puts them into temporary variables to use -->
			var templat = mlat.pop();
			var templng = mlng.pop();
			
			<!-- Takes the set of latitudes and longitudes and calls the function that creates the markers -->
			mapzip(templat,templng);
		}
		
}
function mapzip(lat,lng){
	<!-- Creates a marker on the globally defined map -->
	var marker = new google.maps.Marker({
		map: map,
		position: new google.maps.LatLng(lat,lng)
		});
}               
                                                                
                                                                 
</script>
</head>

<body>  
		<?php 
		#Opens the file that has all latitude and longitude. File has to be on hosting server.
		$file = fopen("zipcodes.csv", "r");

		#Goes through the file until it is at the end of file. 
		while(!feof($file)){
			#Gets a line from the file and puts in variable line
			$line = fgets($file);
			#Makes sure that variable line is not a blank line
			if($line){
				#Splits the line based upon comma into the array info
				$info = explode(",",$line);
				#Prints javascript that loads the globally defined arrays with latitude and longitudes
				echo "<script> mlat.push($info[0]); mlng.push($info[1]);</script>";
			}
		}
		?>		
	<script>
		<!-- Loads the google maps in the windows and calls the initialize function -->
		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
	
	<!-- Places the map within the page -->
	<center><div id="googleMap" style="width:1000px;height:760px;"></div></center> 
 	  
</body>
 </html>
                                                                
