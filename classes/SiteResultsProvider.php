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

		$fromLimit = ($page - 1) * $pageSize;

		$query = $this->con->prepare("SELECT * FROM sites_tb 
										WHERE title LIKE :term
										OR url LIKE :term
										OR keywords LIKE :term
										OR description LIKE :term
										OR entity LIKE :term
										ORDER BY clicks DESC
										LIMIT :fromLimit, :pageSize");

		$searchTerm = "%" . $term . "%";
		$query->bindParam(":term", $searchTerm);
		$query->bindParam(":fromLimit", $fromLimit, PDO::PARAM_INT);
		$query->bindParam(":pageSize", $pageSize, PDO::PARAM_INT);
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

			$url = $this->trimField($url, 89);
			$description = $this->trimField($description, 55);

			$resultsHtml .= "<div class='resultsContainer'>

								<h3 class='title'>
									<a class='result' href='$url'>
										$title
									</a>
								</h3>
								<span class='url'>$url</span>
								<span class='description'>$description</span>
								<span class='level'>Level : $level</span>
								<span class='entity'>Entity : $entity</span>
								<span class='source'>Source : $source</span>

							</div>";


		}


		$resultsHtml .= "</div>";

		return $resultsHtml;
	}

	private function trimField($string, $charLimit) {
		$dots = strlen($string) > $charLimit ? "..." : "";
		return substr($string, 0, $charLimit) . $dots;
	}



}




 ?>