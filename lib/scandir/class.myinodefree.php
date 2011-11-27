<?
/**
 * Objet représentant toutes les propriétés d'un dossier ou fichier.
 *
 * @category  My.Files
 * @package   Base
 * @copyright Copyright (c) 2005-2011 Inwebo (http://www.inwebo.net)
 * @license   http://http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @version   $Id:$
 * @link      https://github.com/inwebo/My.Forms
 * @since     01-04-2011
 * @modifier  01-10-2011
 */

class MyInodeFree {

 /**
  * Si le noeud fournit est un fichier, contient le nom du fichier
  *
  * @var string
  */
	var $file;

 /**
  * Chemin d'accès au noeud
  *
  * @var string
  */
	var $path;

 /**
  * Voir realpath()
  *
  * @var string
  */
	var $realPath;

 /**
  * Dernier acces au fichier
  *
  * @var string
  */
	var $lastAccess;

 /**
  * Dernière modification du fichier
  *
  * @var string
  */
	var $lastChangedFile;

 /**
  * Dernière modification du contenu du fichier
  *
  * @var string
  */
	var $lastChangedContent;

 /**
  * Représentation octale des permissions associées au noeud
  *
  * @var string
  */
	var $permission;

 /**
  * Ecriture possible ?
  *
  * @var bool
  */
	var $writable;

 /**
  * Lecture possible ?
  *
  * @var bool
  */
	var $readable;

 /**
  * Si le noeud est un fichier son poids en octets
  *
  * @var int
  */
	var $size;

 /**
  * file | dir
  *
  * @var string
  */
	var $type;

	public function __construct( $_path, $_name ) {

		$this->path = $_path . $_name;
		$this->name = $_name ;
		if( is_file( $_path ) ) {
			$this->file               = basename( $_path ) ;
			$this->size               = filesize( $this->path );
			$this->type               = 'file';
		}
		elseif( is_dir( $_path ) ) {
			$this->type               = 'dir';
		}
		else {
			throw new Exception($_path . ' is nor a file or dir.' . "\n");
		}

		$this->realPath           = realpath( $this->path ) ;
		$this->lastAccess         = strftime( "%d/%m/%y", fileatime( $this->path ) ) ;
		$this->lastChangedFile    = strftime( "%d/%m/%y", filectime( $this->path ) ) ;
		$this->lastChangedContent = strftime( "%d/%m/%y", filemtime( $this->path ) ) ;
		$this->permission         = substr(sprintf( '%o', fileperms( $this->path ) ), -4) ;
		$this->writable           = is_writable($this->path );
		$this->readable           = is_readable($this->path );

	}

	public function __get( $_attributs ) {
		if( isset( $this->$_attributs ) ) {
			return $this->$_attributs;
		}
		else {
			return FALSE;
		}
	}

}
