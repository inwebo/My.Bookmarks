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
 
Class MyDirectory extends DirectoryIterator{
	
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
     * Instanciation de la class, création de l'arborescence du dossier $path
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
	public function __construct( $path ) {
	
		$this->path			= $path;
		$this->totalFiles	= 0;
		$this->totalDirs	= 0;
		$this->totalSize	= 0;
		$this->ret			= array();

		$iterator = new DirectoryIterator($path);
		foreach ( $iterator as $fileinfo ) {
			if ( !$fileinfo->isDot() ) {
				// echo $fileinfo->getFilename() . "\n";
				( $fileinfo->isDir() ) ? $this->totalDirs++ : $this->totalFiles++ ;
				if( $fileinfo->isDir() ) {
					$this->ret["Dirs"][] = new MyInode( $this->path.$fileinfo->getFilename() );
				}
				elseif( $fileinfo->isFile() ) {
					$this->ret["Files"][] = new MyInode($this->path.$fileinfo->getFilename());
					$this->totalSize += $fileinfo->getSize() ;
				}
			}
		}		
		return $this->ret;
	}
	
    /**
     * Affichage de l'arborescence de $path, sous forme de liste ordonnée HTML.
	 *
	 * @arguments	VOID
	 *
	 * @return    	$output		ARRAY	Un tableau d'objet MyInode
	 *				
     */
	public function __toString() {
	
		$output = '<ul>';
		$output .= '<li>' . $this->path . '</li>';
		if( isset( $this->ret["Dirs"] ) ) {
			foreach( $this->ret["Dirs"] as $info ) {
				$output .= '<li>' . $info->__toString() . '</li>' ;
			}
		}
		
		if( isset( $this->ret["Files"] ) ) {
			foreach( $this->ret["Files"] as $info ) {
				$output .= '<li>' . $info->__toString() . '</li>' ;
			}
		}
		
		$output .= '<li>' . $this->totalSize . ' o, file(s) ' . $this->totalFiles . ', dir(s) ' . $this->totalDirs . '</li></ul>' ;
		
		return $output;
	}
	
}

?>