<?php
/**
 * My Framework : My.Pdo
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
 * @copyright Copyright (c) 2005-2012 Inwebo (http://www.inwebo.net)
 * @license   http://http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @version   $Id:$
 * @link      https://inwebo@github.com/inwebo/My.Sessions.git
 * @since     File available since Beta 01-01-2012
 */

/**
 * Requête préparées
 *
 * @copyright  Inwebo
 * @license    http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
 * @version    01-2012
 * @link
 * @since      Juin 2009
 */
class MyPdo extends PDO {

    public $host;
    public $dbName;
    public $user;
    public $password;

    public $lastQuery;
    public $countRows;

    private $connect;

    public function __construct( $_host, $_dbName, $_user, $_password ) {
		$this->connect = new PDO( 'mysql:host='.$_host.';dbname='.$_dbName, $_user, $_password, array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" )  );
    }

    public function query( $_query, $_params = NULL, $_options = PDO::FETCH_ASSOC ) {
        $this->countRows = 0;
        $this->lastQuery = $_query;
        $query = $this->connect->prepare($_query);

        if( !is_null( $_params ) && is_array( $_params ) ) {
            $query->execute( $_params );
        }
        else {
            $query->execute();
        }

        $this->countRows = $query->rowCount();
        $query = $query->fetchAll( $_options );
	return $query ;

    }

    // Debug
    public function debug() {}

}
