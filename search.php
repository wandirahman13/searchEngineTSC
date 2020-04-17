<?php
include("config.php");
include("classes/SiteResultsProvider.php");

	if(isset($_GET["term"])) {
		$term = $_GET["term"];
	}
	else {
		exit("you must enter a search term");
	}

	$type = isset($_GET["type"]) ? $_GET["type"] : "sites";
	$page = isset($_GET["page"]) ? $_GET["page"] : 1;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Wandering?</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
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
							<input type="hidden" name="type" value="<? echo $type; ?>">
							<input class="searchBox" type="text" name="term" value="<?php echo $term;?>">
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






		<div class="mainResultsSection">
			
			<?php
				$resultsProvider = new SiteResultsProvider($con);
				$pageLimit = 10;

				$numResults = $resultsProvider->getNumResults($term);

				echo "<p class='resultsCount'>$numResults results found</p>";

				echo $resultsProvider->getResultsHtml($page, $pageLimit, $term);
			?>


		</div>


		<div class="paginationContainer">

			<div class="pageButtons">

				<div class="pageNumberContainer">
					<img src="assets/images/begin.png">
				</div>



				<?php
				$pagesToShow = 10;
				$numPages = ceil($numResults / $pageLimit);
				$pagesLeft = min($pagesToShow, $numPages);

				$currentPage = $page - floor($pagesToShow / 2);

				if ($currentPage <1){
					$currentPage = 1;
				}

				if($currentPage + $pagesLeft > $numPages + 1){
					$currentPage = $numPages + 1 - $pagesLeft;
				}

				while($pagesLeft != 0 && $currentPage <= $numPages){

					if($currentPage == $page){
						echo "<div class='pageNumberContainer'>
							<img src='assets/images/selected.png'>
							<span class='pageNumber'>$currentPage</span>
						 </div>";
					}
					else {
						echo "<div class='pageNumberContainer'>
								<a href='search.php?term=$term&type=$type&page=$currentPage'>
									<img src='assets/images/notSelected.png'>
									<span class='pageNumber'>$currentPage</span>
								</a>
						 </div>";
					}

				$currentPage++;
				$pagesLeft--;

				}


				?>



				<div class="pageNumberContainer">
					<img src="assets/images/end.png">
				</div>

			</div>

			
		</div>


	</div>
	<script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>