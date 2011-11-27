<?php
/**
 * My Framework : My.Sessions
 *
 * LICENCE
 *
 * You are free:
 * to Share ,to copy, distribute and transmit the work to Remix —
 * to adapt the work to make commercial use of the work
 *
 * Under the following conditions:
 * Attribution, You must attribute the work in the manner specified by
 * the author or licensor (but not in any way that suggests that they
 * endorse you or your use of the work).
 *
 * Share Alike, If you alter, transform, or build upon
 * this work, you may distribute the resulting work only under the
 * same or similar license to this one.
 *
 *
 * @category  My.Sessions
 * @package   Extra
 * @copyright Copyright (c) 2005-2011 Inwebo (http://www.inwebo.net)
 * @license   http://http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @version   $Id:$
 * @link      https://inwebo@github.com/inwebo/My.Sessions.git
 * @since     File available since Beta 01-10-2011
 */

/**
 * Class d'initilisation de sessions.
 *
 * Initialise proprement une session sur le serveur. Quelques mécanismes
 * de sécurité basiques sont mis en place. L'identification est basée sur un
 * token. Si ce token n'est pas présent en session on génére une nouvelle session
 * afin de se prémunir du vol de session.
 *
 * @category  My.Forms
 * @package   Base
 * @copyright Copyright (c) 2005-2011 Inwebo (http://www.inwebo.net)
 * @license   http://http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @version   $Id:$
 * @link      https://inwebo@github.com/inwebo/My.Sessions.git
 * @since     Class available since Beta 01-10-2011
 * @see       http://phpsec.org/projects/guide/4.html
 * @see       http://www.php.net/manual/fr/session.security.php
 */

class MySessions {

 /**
  * Grain de sel pour générer un identifiant unique de session.
  *
  * @var string
  */
	var $salt;

 /**
  * Tableau associatif de variables pour configurer
  * et initiliser une session. Peut contenir :
  *
  * init     string La clef du token de session.
  * salt     string Grain de sel pour compléxifier l'id session.
  * id       string Unique au visiteur par défaut $_SERVER['HTTP_USER_AGENT'].
  *
  * @var array
  */
	var $args;

  /**
   * Tableau associatif de variables de session
   * à initialisées lors du lancement de la session. Préserve le type !
   *
   * @var array
   */
	var $params;


   /**
    * Initialise une session si session.auto_start est désactivé sur
    * le serveur. Régénére un nouvel id de session. Initialise
    * les différentes variables de session définies.
    * Et test si c'est une session autorisée.
    *
    * @param  array $_args cf var $args
    * @return array $params
    * @throws exception si ce n'est pas une session autorisée
    */
	public function __construct( $_args = array(), $_params = NULL ) {

		$this->params = $_params;

		if( intval( ini_get( 'session.auto_start' ) ) === 0 ) {
			session_start();
		}
		$this->args = array_merge(
			array(
				'init'     => 'token',
				'salt'     => NULL ,
				'id'       => $_SERVER['HTTP_USER_AGENT'],
				'ip'       => $_SERVER['REMOTE_ADDR'],
			), $_args );

		if ( !isset( $_SESSION[ $this->args['init'] ] ) ) {
			session_regenerate_id();
			$_SESSION[ $this->args['init'] ] = $this->fingerprint();
			$this->initParams();
		}

		if( !$this->isValid() ) {
			throw new Exception('invalid session');
		}

	}

  /**
   * Retourne l'identifiant unique de session. Chaine hachée de type md5.
   *
   * @todo   sha1 au lieu de md5
   * @param  void
   * @return string
   */
	private function fingerprint() {
		return md5( $this->args['ip'] . $this->args['id'] . $this->args['salt'] );
	}

 /**
  * Initialisation de toutes les variables de sessions passées au
  * constructeur. Et leur attribut une valeure.
  *
  * @param  void
  * @return true en cas de succès sinon false
  */
	private function initParams() {
		if( is_array( $this->params ) ) {
			foreach( $this->params as $key => $value ) {
					( !isset( $_SESSION[ $key ] ) ) ? $_SESSION[ $key ] = $value : NULL;
			}
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

 /**
  * La session est-elle légitime, c'est à dire est ce que l'empreinte
  * contenu en session est égale à l'empreinte attendue.
  *
  * @param  void
  * @return true si la session est valide sinon false
  */
	private function isValid() {
		if( $_SESSION[ $this->args[ 'init' ] ] === $this->fingerprint() ) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

 /**
  * Ajoute une variable de session $_key ayant comme valeur $_value
  * si elle n'existe pas déjà.
  *
  * @param  string $_key
  * @param  mixed  $_value conserve le type
  * @return bool   true si la variable est ajoutée sinon false
  */
	function addParams( $_key, $_value ) {
		if( !isset( $_SESSION[ $_key ] ) ) {
			if( is_array($_value) ) {
				(array)$_SESSION[ $_key ] = $_value;
			}
			elseif( is_string( $_value ) ) {
				(string)$_SESSION[ $_key ] = $_value;
			}
			elseif( is_object( $_value ) ) {
				(object)$_SESSION[ $_key ] = $_value;
			}
			elseif( is_int( $_value ) ) {
				(int)$_SESSION[ $_key ] = $_value;
			}
			elseif( is_float( $_value ) ) {
				(float)$_SESSION[ $_key ] = $_value;
			}
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

 /**
  * Supprime une variable de session $_key existant en session.
  *
  * @param  string $_key variable à supprimer
  * @return bool   true si la variable est supprimée sinon false
  */
	function delParams( $_key ) {
		if( isset( $_SESSION[$_key] ) ) {
			unset( $_SESSION[$_key] );
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

 /**
  * Modifie la valeur $_value d'une variable $key existante
  * en session.
  *
  * @param  string $_key
  * @param  string $_value
  * @return bool   true si la variable est supprimée sinon false
  */
	public function setParams( $_key, $_value ) {
		if( isset( $_SESSION[$_key] ) ) {
			$_SESSION[$_key] = $_value ;
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

 /**
  * retourne la valeur d'une variable de session $_key
  *
  * @param  string $_key
  * @return mixed
  */
	public function getParams( $_key ) {
		if( isset( $_SESSION[$_key] ) ) { return $_SESSION[$_key]; }
	}

	public function destroy() {
		$_SESSION = array();
		session_destroy();
	}


 /**
  * Affiche le contenu d'une session
  *
  * @param  void
  * @return string Le contenu de la session
  */
	public function __toString() {

		$string ='<pre>';
		foreach( $_SESSION as $key => $value ) {
			ob_start();
			printf( "%-5s : %s\n", $key, $value );
			$string .= ob_get_contents();
			ob_end_clean();
		}
		$string .= '</pre>';
		return $string;
	}

}
