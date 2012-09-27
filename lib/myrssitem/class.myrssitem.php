<?php

/**
 * Liste et retourne tous les dossiers et fichiers d'une arborescence
 *
 * Retourne tous les fichiers et dossiers d'une arborescence sous forme de tableau.
 *
 *
 * @author	   Inwebo
 * @copyright  Inwebo
 * @license    http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
 * @version    24.04.11
 * @link       http://inwebo.free.fr
 * @since      Avril 2011
 * @modified   24 04 2011
 */
 
Class MyRssItem extends MySyndicat {
	
	public $title;
	public $description;
	public $link;
	
	public $pubDate;
	public $uid;
	public $author;
	public $category;
	public $comments;
	
	public $shema = array(
								"title"			=> TRUE,
								"link"			=> TRUE,
								"description"	=> TRUE,	
								"author"		=> NULL,
								"category"		=> array(
																			"#value" => TRUE,
																			"domain" => NULL

								),
								"comments"		=> NULL,
								"enclosure"		=> array(
																				"#value"    => NULL,
																				"url"		=> TRUE,
																				"length"	=> TRUE,
																				"type"		=> TRUE

								),
								"guid"			=> array(
																			"#value"=> TRUE,
																			"isPermalink" => NULL

								),
								"pubDate"		=> NULL,
								"source"		=> array(
																			"#value" => TRUE,
																			"url" => TRUE

								)
								
							);
	
	public function __construct( $params = array(	
													"title"			=> NULL,
													"description"	=> NULL,
													"link"			=> NULL
												) ) {
														  	
						  	
		parent::__construct();
		$this->params	= $params;
		$this->root		= $this->appendChild( $this->createElement('item') );
		
		$this->validateParams();
		$this->buildParamsNodes();
				
	}
	
 	
	
}