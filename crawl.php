<?php 
include("classes/DomDocumentParser.php");


function followLinks($url){
	
	$parser = new DomDocumentParser($url);

}

$startUrl = "https://go-jek.atlassian.net/wiki/spaces/OBS/pages/1589346430/SOP+-+Mandiri+-+Payment+Channel+Offline+-+Level+4"; 
followLinks($startUrl);

 ?>