<?php
/**
 * My.Framworks
 *
 * LICENCE
 *
 * Vous êtes libre de :
 *
 * Partager : reproduire, distribuer et communiquer l'oeuvre
 * Remixer  : adapter l'oeuvre 
 *
 * Selon les conditions suivantes :
 *
 * Attribution : Vous devez attribuer l'oeuvre de la manière indiquée par 
 * l'auteur de l'oeuvre ou le titulaire des droits (mais pas d'une manière
 * qui suggérerait qu'ils vous soutiennent ou approuvent votre utilisation 
 * de l'oeuvre). 
 *
 * Pas d’Utilisation Commerciale : Vous n'avez pas le droit d'utiliser cette
 * oeuvre à des fins commerciales. 
 *
 * Partage à l'Identique : Si vous modifiez, transformez ou adaptez cette
 * oeuvre, vous n'avez le droit de distribuer votre création que sous une
 * licence identique ou similaire à celle-ci.
 *
 * Remarque : A chaque réutilisation ou distribution de cette oeuvre, vous 
 * devez faire apparaître clairement au public la licence selon laquelle elle
 * est mise à disposition. La meilleure manière de l'indiquer est un lien vers
 * cette page web. 
 *
 * @category  My.Framworks
 * @package   Base
 * @copyright Copyright (c) 2005-2011 Inwebo (http://www.inwebo.net)
 * @author    Julien Hannotin
 * @license   http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
 * @version   $Id:$
 * @link      https://github.com/inwebo/My.MVC
 * @since     File available since Beta 28-11-2011
 */
?>
<?php
/**
 * Connection à la base de donnée, envoie une requête, et peut récupere
 * le résultat dans un tableau associatif
 *
 * @copyright  Inwebo
 * @license    http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
 * @version    09-2011
 * @link
 * @since      Juin 2009
 */

class MySql {

	/**
	 * Prends en paramètre un fichier ini à parser
	 *
	 * @arguments 	: STRING 	$iniFile : fichier à parser
	 *
	 * @return 		: STRING 	Message erreur si le fichier n'est pas trouvé
	 *				  BOOL		Sinon retourne 1
	 */

	var $_host, $_user, $_password, $_base, $dbLink,$total, $query, $error;

	public function __construct( $_host, $_user, $_password, $_base ) {
		$this->token    = ':?';
		$this->host     = $_host;
		$this->user     = $_user;
		$this->password = $_password;
		$this->base     = $_base;
		$this->error    = NULL;
		$this->query    = NULL;

		if((@$this->dbLink = mysql_connect($this->server, $this->user, $this->password)) == FALSE) {
			throw new Exception('Failed to connect host');
		}
		else {
			if(!$this->base = mysql_select_db($this->base, $this->dbLink)) {
				throw new Exception('Failed to connect database');
			}
		}
		mysql_query("SET NAMES 'utf8'");
	}

	/**
	 * Execute une requete SQL
	 *
	 * @arguments 	: STRING 	$query : Requete SQL
	 *
	 * @return 		: STRING	Message erreur si le fichier n'est pas trouvé
	 *				  BOOL		Sinon retourne 1
	 */
	function query( $_query, $_arrayArgs = NULL ) {
		if( !is_null( $_arrayArgs ) ) {
			$query = $this->prepare( $_query, $_arrayArgs );
		}
		else {
			$query = $_query;
		}
		$this->query = $query;
		$dbResult    = mysql_query( $query, $this->dbLink );
		$this->error = mysql_error();
		// if( is_resource( $dbResult ) ) {
			// return mysql_fetch_assoc( $dbResult );
		// }
		// elseif( is_bool( $dbResult ) ){
			// return $dbResult;
		// }
		return $dbResult;
	}

	/**
	 * Remplace tous les tokens $this->token présents dans la requêtes
	 * $query.
	 *
	 * @arguments   : STRING 	$query : Requete SQL
	 *
	 * @return      : STRING	Message erreur si le fichier n'est pas trouvé
	 *                BOOL		Sinon retourne 1
	 */
	protected function prepare( $query, $replace ) {
		$totalTokens = substr_count( $query, $this->token );
		$search      = array_fill( 0, $totalTokens, $this->token );
		$compteur    = 0;
		foreach( $search as $value ) {
			if( get_magic_quotes_gpc() ==  1 ) {
				stripslashes( $replace[$compteur] );
			}
			$replace[ $compteur ] = mysql_real_escape_string( $replace[$compteur], $this->dbLink );
			$query                = $this->ustr_replace( $value, $replace[ $compteur ], $query );
			$compteur++;
		}
		return $query;
	}

	// http://mickaelbertrand.imagika.fr/breves/programmation-web/codephp-snippetfonction-php-ustr_replace-remplace-une-seule-occurrence-dans-une-chaine-1956
	function ustr_replace( $search, $replace, $subject, $cur = 0 ) {
		return ( strpos( $subject, $search,$cur ) ) ?
			substr_replace( $subject, $replace,(int)strpos( $subject, $search, $cur ), strlen( $search ) ) :
      $subject ;
	}

}

