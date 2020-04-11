<?php

	if(isset($_GET["term"])) {
		$term = $_GET["term"];
	}
	else {
		exit("you must enter a search term");
	}

	$type = isset($_GET["type"]) ? $_GET["type"] : "sites";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Wandering?</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

	<div class="wrapper">
		
		<div class="header">
			
			<div class="headerContent">
				
				<div class="logoContainer">
					<a href="index.php">
						<img src="assets/images/wandering.png">
					</a>
				</div>

				<div class="searchContainer">
					<form action="search.php" method="GET">
						
						<div class="searchBarContainer">
							<input class="searchBox" type="text" name="term">
							<button class="searchButton">
								<img src="assets/images/icons/search.png">
							</button>
						</div>

					</form>
				</div>

			</div>

			<div class="tabsContainer">
				<ul class="tabsList">
					<li class="<?php echo $type == 'sites' ? 'active' : '' ?>">
						<a href='<?php echo "search.php?term=$term&type=sites"; ?>'>
							Sites
						</a>
					</li>
				</ul>
			</div>

		</div>

	</div>

</body>
</html>