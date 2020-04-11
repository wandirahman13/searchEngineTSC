<?php 
class DomDocumentParser {

	private $doc;

	public function __construct($url){

		$option = array(
			'http' => array('method'=>"GET", 'header'=>"User-Agent: wanderingBot/0.1\n") 
			);
		$context = stream_context_create($option);

		$this->doc = new DomDocument();
		$this->doc -> loadHTML(file_get_contents($url, false, $context));

	}
}
 ?>