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

        public static function save( $_from, $_to ) {
            if(is_array($_from)) {
                $assoc_arr = $_from;
            }
            else {
                $assoc_arr = parse_ini_file($_from, FALSE);
            }
            
                    $content='';
                    foreach ($assoc_arr as $key=>$elem) {
                        if(is_array($elem))
                        {
                            for($i=0;$i<count($elem);$i++)
                            {
                                $content .= $key."[] = \"".$elem[$i]."\"\n";
                            }
                        }
                        else if($elem=="") $content .= $key." = \n";
                        else $content .= $key." = \"".$elem."\"\n";
                    }

                  if (!$handle = fopen($_to, 'w+')) {
                        return false;
                    }
                    if (!fwrite($handle, $content)) {
                        return false;
                    }
                    fclose($handle);
   }
}

// print_r( config::get('config.ini') );
//config::save(array('test'=>'test'),'config.ini.bak.a');
?>
