<?php 
include("classes/DomDocumentParser.php");


function followLinks($url){
	
	$parser = new DomDocumentParser($url);

	$linkList = $parser->getLinks();

	foreach ($linkList as $link) {
		# code...
		$href = $link->getAttribute("href");
		echo $href . "<br>";
	}

}

$startUrl = "https://docs.google.com/document/d/1TzQU6vxeQJt3UHB7UuYbyTZdxhMMwPxpR-Y7BFXXm8s/edit"; 
followLinks($startUrl);

 ?>