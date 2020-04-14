<?php 

class SiteResultsProvider {

	private $con;

	public function __construct($con){
		$this->con = $con;
	}

	public function getNumResults($term){

		$query = $this->con->prepare("SELECT COUNT(*) as total
										FROM sites_tb WHERE title LIKE :term
										OR url LIKE :term
										OR keywords LIKE :term
										OR description LIKE :term
										OR entity LIKE :term");

		$searchTerm = "%" . $term . "%";
		$query->bindParam(":term", $searchTerm);
		$query->execute();

		$row = $query->fetch(PDO::FETCH_ASSOC);
		return $row["total"];

	}


	public function getResultsHtml($page, $pageSize, $term){

		$query = $this->con->prepare("SELECT * FROM sites_tb 
										WHERE title LIKE :term
										OR url LIKE :term
										OR keywords LIKE :term
										OR description LIKE :term
										OR entity LIKE :term");

		$searchTerm = "%" . $term . "%";
		$query->bindParam(":term", $searchTerm);
		$query->execute();

		$resultsHtml = "<div class='sitesResults'>";


		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			# code...
			$id = $row["id"];
			$url = $row["url"];
			$title = $row["title"];
			$entity = $row["entity"];
			$description = $row["description"];
			$source = $row["source"];
			$level = $row["level"];

			$resultsHtml .= "<div class='resultsContainer'>

								<h3 class='title'>
									<a class='result' href='$url'>
										$title
									</a>
								</h3>
								<span class='url'>$url</span></br>
								<span class='description'>$description</span></br>
								<span class='level'>Level : $level</span></br>
								<span class='entity'>Entity : $entity</span></br>
								<span class='source'>Source : $source</span>

							</div>";


		}


		$resultsHtml .= "</div>";

		return $resultsHtml;
	}



}




 ?>