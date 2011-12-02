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
 * Parse le fichier config.ini et renvoie les valeurs.
 *
 * @license    http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
 * @version    09-2011
 */

class Config
{
	static $get;
	
	private function __construct() {}
	
	/**
	 * Parse le fichier config.ini et les rends disponible.
	 *
	 * Long description for class (if any)...
	 *
	 * @param 	: VOID
	 * @return  : ARRAY avec toutes les variables contenues dans config
	 * 			  Voir la fonction php parse_ini_file();
	 */
	public static function get( $configFile, $process_sections = FALSE ) {
		if( (self::$get = parse_ini_file($configFile, $process_sections)) == false ) {
			throw new Exception('ini file not founds.');
		}
		return self::$get;
	}
}

// print_r( config::get('config.ini') );

?>
