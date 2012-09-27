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
 
Class MyRSS extends MySyndicat {
	
	public $root;
	
	public $rssVersion;


	// Obligatoire	
	public $title;
	public $description;
	public $link;

	// 
	public $pubDate;
	public $lastBuildDate;
	public $language;
	public $enclosure;

	public $shema = array(
										"title"			=> TRUE,
										"link"			=> TRUE,
										"description"	=> TRUE,
										"language"		=> NULL,
										"copyright"		=> NULL,
										"managingEditor"=> NULL,
										"webMaster"		=> NULL,
										"pubDate"		=> NULL,
										"lastBuildDate" => NULL,
										"category"		=> NULL,
										"generator"		=> NULL,
										"docs"			=> NULL,
										"cloud"			=> NULL,
										"ttl"			=> NULL,
										"image"			=> array(
																"url"			=> TRUE,
																"title"			=> TRUE,
																"link"			=> TRUE,
																"width"			=> NULL,
																"height"		=> NULL,
																"description"	=> NULL
										),
										"rating"		=> NULL,
										"skipHours"		=> NULL,		
										"skipDays"		=> NULL
										/* Useless */
										/* "textInput" => NULL, */
									);

	public function __construct( $params = array(	"title"			=> NULL,
													"description"	=> NULL,
													"link"			=> NULL
												) ) {
		

		parent::__construct();
		$this->formatOutput = true;
		
		$this->params = $params;
		
		$this->rssVersion = "2.0";
		$this->root       = $this->createElement( 'rss');
		$this->root->setAttribute( 'version', $this->rssVersion );
		$this->appendChild( $this->root );
		$this->root       = $this->root->appendChild( $this->createElement( 'channel' ) );
		
		$this->validateParams();
		$this->buildParamsNodes();
	}

	public function appendItem( $_params = array() ) {
		$item = new MyRssItem( $_params );
		$this->root->appendChild( $this->importNode( $item->root, true ) );
	}
	
	public function __autoload() {
		require_once( dirname(__FILE__) . 'class.myrssitem.php' ) ;
	}
	
	public function __toString() {
		return $this->saveXML();
	}

}