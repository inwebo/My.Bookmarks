<?php
/**
 * Retourne toutes les propri�t�s d'un fichier.
 *
 * Retourne tous les fichiers et dossiers d'une arborescence sous forme de tableau,
 * de mani�re r�cursive.
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
Class MyInode extends SplFileInfo {

	/**
    * @var	STRING
    * @desc Path to a file
    */
	public $path;

	/**
    * @var	ARRAY
    * @desc File's propreties stored in indexed array
    */
	//public $propreties;

	//private $arrayInfos ;

	public function __construct( $path ) {
                parent::__construct( $path );
		$this->path = $path;
		//$this->file = new SplFileInfo( $this->path );
		/*$this->arrayInfos = array(
							"Name"=> "base name's file, directory, or link without path info. ",
							"Extension"=> "Retrieves the file extension. ",
							"Real path"=> "This method expands all symbolic links, resolves relative references and returns the real path to the file. ",
							"Path info"=> "Gets an SplFileInfo object for the path. ",
							"Path"=> "Returns the path to the file, omitting the filename and any trailing slash. ",
							"Path name"=> "Returns the path to the file. ",
							"File name"=> "Gets the filename without any path information. ",
							"Last access"=> "Last access. ",
							"Last changed file"=> "Last changed file. ",
							"Last changed content"=> "Last changed content. ",
							"Permission"=> "Gets permissions. ",
							"Type"=> "Returns the type of the file referenced. file || dir ",
							"Writable"=> "1 true || 0 false. ",
							"Readable"=> "1 true || 0 false. ",
							"Size"=> "octets. ",
						);*/

		/*$this->propreties = array(
									"Name"					=> $this->file->getBaseName(),
									"Extension"             => pathinfo($this->file->getFilename(), PATHINFO_EXTENSION),
									"Real path"				=> $this->file->getRealPath(),
									"Path"					=> $this->file->getPath(),
									"Path info"				=> $this->file->getPathInfo(),
									"Path name"				=> $this->file->getPathName(),
									"File name"				=> $this->file->getFilename(),
									"Last access"			=> strftime( "%d/%m/%y", $this->file->getATime() ),
									"Last changed file"		=> strftime( "%d/%m/%y", $this->file->getCTime() ),
									"Last changed content"	=> strftime( "%d/%m/%y", $this->file->getMTime() ),
									"Permission"			=> substr( sprintf( '%o', $this->file->getPerms() ), -4),
									"Type"					=> $this->file->getType(),
									"Writable"				=> $this->file->isWritable(),
									"Readable"				=> $this->file->isReadable(),
								//	"Size"					=> $this->file->getSize()
								  );*/

                $this->name = $this->getBaseName();
                $this->extension = pathinfo($this->getFilename(), PATHINFO_EXTENSION);
                $this->nameLessExtension = $this->getBaseName('.'.$this->extension);
                $this->realPath =$this->getRealPath();
                $this->path =$this->getPath();
                $this->pathInfo =$this->getPathInfo();
                $this->pathName =$this->getPathName();
                $this->fileName =$this->getFilename();
                //@todo : commenter pour windows
                //$this->lastAccess =strftime( "%d/%m/%y", $this->getATime() );
                //$this->lastChangedTime =strftime( "%d/%m/%y", $this->getCTime() );
                //$this->lastChangedContent =strftime( "%d/%m/%y", $this->getMTime() );
                //$this->permission =substr( sprintf( '%o', $this->getPerms() ), -4);
                //$this->type =$this->getType();
                //$this->writable =$this->isWritable();
                //$this->readable =$this->isReadable();


		/*if( $this->type == "dir") {*/
			$this->size = NULL;
		/*
		}
		else {
                        //$this->size =$this->getSize();
		}*/

		//return $this->propreties;
	}

	public function __toString() {
/*
		$stringReturn = '<ul>';

*/
		/*$stringReturn = '';
		$j = -1;
		foreach( $this->propreties as $key => $value ) {
			$stringReturn .= '<li><u title="'.$this->arrayInfos[$key].'">'. $key . '</u> : ' . $value .'</li>';
		}*/
/*
		$stringReturn .= '</ul>';
*/
                var_dump($this);
		//return $stringReturn;
	}

}

?>
