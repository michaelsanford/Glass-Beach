<?php

/**
 * @param null $beach
 * @param null $lat
 * @param null $long
 * @throws Google_Exception
 */

function get_beach_status($beach = null, $lat = null, $long = null) {

//	$lat = "43.585";
//	$long = "-79.540";

	$beaches = Array();

	$beaches[0]['name']=null;
	$beaches[0]['lat']=null;
	$beaches[0]['long']=null;

	$beaches[1]['name']="Marie Curtis Park East Beach";
	$beaches[1]['lat']="43.585";
	$beaches[1]['long']="-79.540";

	$beaches[2]['name']="Sunnyside Beach";
	$beaches[2]['lat']="43.637";
	$beaches[2]['long']="-79.455";

	$beaches[3]['name']="Hanlan's Point Beach";
	$beaches[3]['lat']="43.619";
	$beaches[3]['long']="-79.393";

	$beaches[4]['name']="Gibraltar Point Beach";
	$beaches[4]['lat']="43.612";
	$beaches[4]['long']="-79.382";

	$beaches[5]['name']="Centre Island Beach";
	$beaches[5]['lat']="43.616";
	$beaches[5]['long']="-79.373";

	$beaches[6]['name']="Ward's Island Beach";
	$beaches[6]['lat']="43.630";
	$beaches[6]['long']="-79.352";

	$beaches[7]['name']="Cherry Beach";
	$beaches[7]['lat']="43.636";
	$beaches[7]['long']="-79.344";

	$beaches[8]['name']="Woodbine Beaches";
	$beaches[8]['lat']="43.663";
	$beaches[8]['long']="-79.305";

	$beaches[9]['name']="Kew Balmy Beach";
	$beaches[9]['lat']="43.668";
	$beaches[9]['long']="-79.290";

	$beaches[10]['name']="Bluffer's Beach Park";
	$beaches[10]['lat']="43.713";
	$beaches[10]['long']="-79.225";

	$beaches[11]['name']="Rouge Beach";
	$beaches[11]['lat']="43.793";
	$beaches[11]['long']="-79.118";

	if ($beach !== null && $beach >= 0 && $beach <= 11) {
		$path = "http://app.toronto.ca/tpha/ws/beach/" . $beach . ".xml?v=1.0";
		$oXML = get_xml($path);
	}
	else if ($beach == null && $lat !== null && $long !== null) {

		$lat = round($lat, 3);
		$long = round($long, 3);

		$oXML = null;
		for ($i = 1; $i <= count($beaches); $i++) {
			if ($beaches[$i]['lat'] == $lat && $beaches[$i]['long'] == $long) {
				$beach = $i;
				$path = "http://app.toronto.ca/tpha/ws/beach/" . $i . ".xml?v=1.0";
				$oXML = get_xml($path);
			}
		}

		if ($oXML === null) {
			return null;
		}

	}
	else {
		throw new Google_Exception("No beach location provided");
	}

	$status = $oXML->xpath("//beachStatus");
	$status = $status[0];

	$advisory = $oXML->xpath("//beachAdvisory");
	$advisory = $advisory[0];

	switch ($status) {
		case "Safe":
			$icon = "https://raw.githubusercontent.com/michaelsanford/Glass-Beach/master/mirror-api-php/assets/safe-icon.png";
			break;

		case "Unsafe":
			$icon = "https://raw.githubusercontent.com/michaelsanford/Glass-Beach/master/mirror-api-php/assets/unsafe-icon.png";
			break;

		default:
			$icon = "http://app.toronto.ca/tpha/images/beaches_unsafe_large.gif";
			break;
	}

	return array(
		$beaches[$beach]['name'],
		$status,
		$icon,
		$advisory
	);
}

function get_xml($path) {

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $path);
	curl_setopt($ch, CURLOPT_FAILONERROR,1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	$sXML = curl_exec($ch);
	curl_close($ch);

	return new SimpleXMLElement($sXML);

}

if (isset($_POST['lat']) && isset($_POST['long'])) {



}

//$ret = get_beach_status(1);
//echo "<br />";
//echo $ret[0] . "<br />";
//echo $ret[1] . "<br />";
//echo $ret[2] . "<br />";
//echo $ret[3] . "<br />";