<?php
include('class.myinodefree.php');
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

class Scandir {

 /**
  * @var	STRING
  * @desc Path to directory to list
  */
	public $path;

	/**
    * @var	INT
    * @desc Total files in $path
    */
	public $totalFiles;

	/**
    * @var	INT
    * @desc Total dirs in $path
    */
	public $totalDirs;

	/**
    * @var	INT
    * @desc Total size in octects
    */
	public $totalSize;

	/**
    * @var	ARRAY
    * @desc List of all items in $path
    */
	public $ret;

  /**
   * Instanciation de la class, création de l'arborescence du dossier $path COMPATIBLE free.fr
	 *
	 * @arguments	$path			STRING	Chemin d'accés d'un dossier à lister récursivement
	 *
	 * @return    	$ret			ARRAY	Un tableau d'objet MyInode, sous la forme
	 * 										array(	"Dirs" = array ("Objet 1",
	 *																"Objet 2',
	 *																etc),
	 *												"Files" = array ("Objet 1",
	 *																"Objet 2',
	 *																etc)
	 *											)
	 *
	 * @throw		EXCEPTION				Émet une exception UnexpectedValueException si le chemin $path est introuvable.
	 *
   */

	public function __construct( $path, $root = 'public' ) {

		$this->path          = $path ;
		$this->root          = $root ;
		$this->ret		       = array() ;
		$this->totalFiles    = 0 ;
		$this->totalDirs     = 0 ;
		$this->totalSize     = 0 ;

		$j = -1;
		if( is_dir($this->path) ) {
			$files = scandir( $this->path );
		}
		else {
			throw new Exception($this->path . ' is not a dir.');
		}
		while( isset( $files[++$j] ) ) {

			if( $files[$j] !== "." && $files[$j] !== ".." && is_dir( $this->path . $files[$j]) ) {
				$this->ret["Dirs"][$this->totalDirs++] = new MyInodeFree( $this->path , $files[$j] );
			}
			elseif( $files[$j] !== "." && $files[$j] !== ".." && is_file( $this->path . $files[$j]) ) {
				$this->ret["Files"][$this->totalFiles++] = new MyInodeFree( $this->path , $files[$j] );

				$this->totalSize += filesize( $this->path . $files[$j] );
			}

		}
	}

	public function getTree() {
		return $this->ret;
	}

}
