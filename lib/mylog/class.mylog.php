<?php
/**
 * Manipulation de ligne de fichier texte
 *
 * Manipulation de ligne de fichier texte brut, permet la suppression de ligne, l'ajout au milieu du fichier
 * en début de fichier, à la fin. Par extensions nous nommerons tous les fichiers en texte brut par log.
 *
 * Un objet log est pour cette class tous fichiers texte brut. Un objet log est composé de n lignes avec
 * chaque ligne délimitée par un retour chariot.
 * Un objet log peut être composé de un ou plusieurs fichier texte brut ayant un patron commun, préfixé
 * par un indice numérique.
 * Un objet log a une taille maximum en octet, si le buffer dépasse cette taille plusieurs fichiers se-
 * -ront utilisés lors de la sauvegarde
 *
 * Exemple
 * 		00-fichier.log
 *		01-fichier.log
 *		02-fichier.log
 *		03-Autrefichier.log
 *
 *		Les trois premières lignes désignent le même objet log avec comme patron commun "fichier"
 *		La dernière ligne est un autre objet log son patron est "Autrefichier"
 *
 *
 * Lors de l'instanciation de la classe, créer le fichier contenant le log si il n'existe pas. Si l'objet
 *  existe déjà et est composé de plusieurs fichier alors chargement de celui avec le plus grand indice
 * numérique.
 *
 * Chaque ligne du fichier étant une entrée dans le tableau buffer. Les manipulations se font toujours
 * au niveau du buffer, aucune modification au fichier n'est faite jusqu'à la sauvegarde grâce à
 * la méthode save();.
 *
 *
 *
 * @author	   Inwebo
 * @copyright  Inwebo
 * @license    http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
 * @version    09-2011
 * @link
 * @since      Juin 2010
 */

/**
 * Constantes d'environnement
 */
define( 'UNIX', 'UNIX' );
define( 'WINDOWS', 'WINDOWS' );
define( 'MAC_OS', 'MAC_OS' );

/**
 * Constantes de positionnement
 */
define( 'NEXT', 'NEXT' );
define( 'PREV', 'PREV' );
define( 'FIRST', 'FIRST' );
define( 'LAST', 'LAST') ;

/**
 * Constantes d'erreurs
 */
define( 'ERROR_LINE', 'Choosen line is out of range');


// Envoi par mail du buffer = Alerte par mail
// Compressé le log

class MyLog {

	/**
	 * Manipulation de ligne de fichier texte
	 *
	 *
	 * @arguments  STRING $filePath		 	: Chemin d'acces au ficher texte à parser
	 * 			   CONST  $os	 			: Choix de l'os qui manipulera les fichiers, c'est cette variable
	 *										  qui fixera les caracteres de fin de ligne
	 *			   BOOL	  $truncate			: 1 Si la sauvegarde du fichier est faite, la taille maximum de celui ci
	 * 										  sera de $size octets
	 *			   INT	  $size				: Taille en octets que le fichier sauvegardé fera au maximum si la
	 *										  taile du buffer depace celle de $size alors autant de fichier que
	 *										  nécessaire seront crées.
	 *
	 * @return     VOID
	 */
	public function __construct( $filePath = 'logs.log', $truncate = 1, $size = 1048576 ) {

		if( !file_exists( $filePath ) ) {
				if( fopen( $filePath, "a+" ) === FALSE) {
					throw new exception("<strong>ERROR</strong> : File $filePath doesn't exist");
				}
		}

		$this->end 		= $this->setLineEnd();

		if( $truncate === true || $truncate == "1" ) {
			$this->truncate = $truncate;
		}
		else {
			trigger_error("<strong>$truncate</strong> is not a bool ", E_USER_ERROR);
		}

		if( is_int( $size ) ) {
			$this->size	= $size;
		}
		else {
			trigger_error("<strong>$size</strong> is not a numeric value");
		}

		$this->file		= $filePath;
		$this->Content 	= file( $this->file );
		$this->Buffer	= $this->setNatural( $this->Content );

	}


	/**
	 * Choisis le retour à la ligne selon l'os.
	 * Par defaut renvois le retour chariot WINDOWS
	 *
	 * @arguments  VOID
	 *
	 *
	 * @return     	STRING 	$endLine 	"\n"   : Pour Les systemes Unix, Linux
	 *									"\r\n" : Pour les systems Windows  ( DEFAULT )
	 *					 				"\r"   : Pour MacOS
	 */
	private function setLineEnd() {
		$endLine = "";
		switch ( strtolower(PHP_OS) ) {

			default:
			case 'linux':
			case 'unix':
				$endLine = "\n";
				break;

			case 'windows':
				$endLine = "\r\n";
				break;

			case 'mac':
				$endLine = "\r";
				break;
		}
		return $endLine;
	}

	/**
	 * Pour une manipulation plus naturelle des lignes, nous commencons à les comptées à 1
	 * dans le tableau $array
	 *
	 * @arguments   VOID
	 *
	 *
	 * @return     	ARRAY 		$temp	: Tableau numérique commencant à l'index 1
	 *				EXCEPTION			: Si $array n'est pas un tableau
	 */
	private static function setNatural( $array ) {
		if( !is_array( $array ) ) {
			throw new Excepetion ("Arg : $array is not an array !");
		}
		$temp 		= array();
		$compteur 	= 1;
		foreach( $array as $key => $value ) {
			$temp[ $compteur ] = trim($value);
			++$compteur;
		}
		return $temp;
	}

	/**
	 * Retourne le contenu du fichier log courant.
	 * voir la fonction file ( http://php.net/manual/fr/function.file.php )

	 * @arguments   VOID
	 *
	 *
	 * @return     	ARRAY 	$this->Content
	 */
	public function getLogs() {
      return $this->Content;
	}

	/**
	 * Retourne le contenu de la ligne $lineNumber contenue dans le tableau numerique Buffer
	 *
	 * @arguments  INT $lineNumber : Le numéro de ligne voulue
	 *
	 *
	 * @return     STRING 		$content : La ligne de texte $linenumber
	 *			   EXCEPTION		     : Si $lineNimber n'est pas contenue dans le tableau
	 */
	public function getLine( $lineNumber ) {
		if( !$this->isLine( $lineNumber ) ) {
			throw new Exception( ERROR_LINE );
		}
		$content = $this->Buffer[ $lineNumber ];
		return $content;
	}

	/**
	 * Remplace la ligne $ligneNumber avec le texte $text
	 *
	 * @arguments  INT		$lineNumber : Le numéro de ligne voulue
	 *			   STRING	$text 		: Le texte de remplacement
	 *
	 *
	 * @return     STRING 	$content 	: La ligne de texte $linenumber
	 */
	public function setLine( $lineNumber, $text ) {
		return  $this->Buffer[ $lineNumber ] = utf8_encode( $text );
	}

	/**
	 * Ajoute une ligne à l'emplacement $at, ayant pour texte la valeure $text, $flag indique
	 * la methode d'insertion à utiliser
	 *
	 * @arguments  INT 	  $at 	: Le numéro de ligne voulue
	 *			   STRING $text : Le texte de remplacement
	 *			   CONST  $flag : PREV avant la ligne $at
	 * 							  NEXT apres la ligne $at
	 *							  FIRST au debut du fichier
	 *							  LAST	a la fin du fichie
	 *
	 *
	 * @return     STRING $content La ligne de texte $linenumber
	 */
	//public function addLine( $at, $text, $flag = LAST ) {
	public function addLine( $text, $at = NULL, $flag = LAST ) {
		if(abs($at) > $this->getTotalLines( $this->Buffer )) {
			throw new Exception (ERROR_LINE);
		}
		switch ( $flag ) {
			default:
			case LAST:
				array_push( $this->Buffer, $text );
				break;

			case FIRST:
				array_unshift( $this->Buffer, $text );
				break;

			case PREV:
				$left  = array_slice( $this->Buffer, 0, $at - 1 );
				$right = array_slice( $this->Buffer, $at - 1 );
				array_push( $left, $text );
				$this->Buffer = array_merge( $left,$right );
				break;

			case NEXT:
				$left = array_slice( $this->Buffer,0, $at );
				$right = array_slice( $this->Buffer, $at );
				array_push( $left, $text );
				$this->Buffer = array_merge( $left,$right );
				break;
		}
		$this->Buffer = $this->setNatural( $this->Buffer );
	}

	public function firstLine($text) {
		array_unshift( $this->Buffer, $text );
	}

	public function line( $text ) {
		array_push( $this->Buffer, $text );
	}

	/**
	 * Supprime la ligne $lineNumber
	 *
	 * @arguments  INT 	  	$lineNumber 	: Le numéro de ligne à effacer
	 *
	 *
	 * @return     STRING 	$content		: La ligne de texte $linenumber
	 */
	public function delLine( $lineNumber ) {
		if( !self::isLine( $lineNumber ) ) {
			throw new Exception(ERROR_LINE);
		}
		unset( $this->Buffer[ $lineNumber ] );
		$this->Buffer = $this->setNatural( $this->Buffer );
		return 1;
	}

	/**
	 * Enregistre le buffer courant dans une fichier $file
	 *
	 * @arguments  STRING $file 	: Chemin d'accés à un fichier
	 *
	 *
	 * @return     STRING $content 	: La ligne de texte $linenumber
	 */
	public function save() {
		if ( !is_writable( $this->file ) && !fopen( $this->file , "w" ) ) {
			throw new Exception("$this->file is not writable");
		}
		$string   = "";
		$compteur = 1;
		foreach( $this->Buffer as $value ) {
			if( $compteur === $this->getTotalLines() ) {
				$string.= trim( $value ) ;
			}
			else {
				$string.= trim( $value ) . $this->end;
			}
			++$compteur;
		}
		$fp = fopen( $this->file, 'w+' );
		fwrite( $fp, utf8_encode ( $string ) );
		fclose( $fp );
	}

	/**
	 * Reset du buffer
	 *
	 * @arguments  VOID
	 *
	 *
	 * @return     VOID
	 */
	public function reset() {
		$this->Buffer = array();
	}


	/**
	 * Retourne le nombre de ligne contenues dans le buffer courant
	 *
	 * @arguments  VOID
	 *
	 *
	 * @return     INT nombre de ligne
	 */
	public function getTotalLines() {
		return count( $this->Buffer );
	}


	/**
	 * Retourne le buffer courant sous forme de tableau
	 *
	 * @arguments  VOID
	 *
	 *
	 * @return     ARRAY $this->Buffer	: voir la fonction file ( http://php.net/manual/fr/function.file.php )
	 */
	public function getBuffer() {
		return $this->Buffer;
	}

	/**
	 * Retourne le buffer courant sous forme de chaine de caracteres
	 *
	 * @arguments  VOID
	 *
	 *
	 * @return     STRING $temp		: Tous les elements du tableau concaténé dans une chaine de caractere
	 */
	public function __toString() {
		$temp ="";
		foreach($this->Buffer as $value) {
			$temp .= $value . $this->end;
		}
		return $temp;
	}

	/**
	 * Renvois la taille en octet du buffer.
	 *
	 * @arguments  VOID
	 *
	 *
	 * @return     INT Taille totale en octet du buffer
	 */
	public function getBufferSize() {
		$size =$this->getBufferAsString();
		return mb_strwidth($size);
	}

	/**
	 * Retourne la taille en octets du fichier log
	 *
	 * @arguments  VOID
	 *
	 *
	 * @return     INT	: Taille en octet du fichier log
	 */
	public function getFileSize($file = 'copy.log') {
		return filesize($file);
	}

	/**
	 * Test si le numero de ligne $int est une ligne disponible du tableau Buffer
	 *
	 * @arguments  VOID
	 *
	 *
	 * @return     BOOL 0 si la ligne n'est pas contenue dans le tableau
	 *			   BOOL 1 si la ligne est contenu dans le tableau
	 */
	private function isLine( $int ) {
		if( !is_int( $int ) ) {
			trigger_error("<strong>$int</strong> is not a numeric value");
		}

		if( $int > $this->getTotalLines() ) {
			return 0;
		}
		else{
			return 1;
		}
	}

}
?>
