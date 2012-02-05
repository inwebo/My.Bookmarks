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
		if( ( self::$get = parse_ini_file( $configFile, $process_sections ) ) == false ) {
			throw new Exception('File not found.');
		}
		return self::$get;
	}

        public static function save( $_from, $_to, $_align = 20 ) {

            $content = self::format( $_from );

                  if (!$handle = fopen($_to, 'w+')) {
                        return false;
                    }
                    if (!fwrite($handle, $content)) {
                        return false;
                    }
                    fclose($handle);
        }

        public function format( $ini_file ) {
            
            $format = self::get( $ini_file, TRUE );
            $return = '';

            foreach( $format as $key => $value ) {

                if(is_array($value) ) {
                    $return .= "\n" . '[ ' . $key . ' ]' . "\n";
                    foreach( $value as $_key => $_value ) {
                        ob_start();
                        $return .= sprintf("%-20s", $_key);
                        $return .= '= ';
                        $return .= ' ' . $_value . "\n";
                        ob_end_flush();
                    }
                }
                else {
                    $return .= $key . '=' . $value . "\n";
                }

            }
            
            return $return;
        }


}

