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
