<?php 
include("../config.php");


if(isset($_POST["linkId"])){
	$query = $con->prepare("UPDATE sites_tb SET clicks = clicks + 1 WHERE id=:id");
	$query->bindParam(":id", $_POST["linkId"]);

	$query->execute();
} else {
	echo "No lnk passed to page";
}

 ?>