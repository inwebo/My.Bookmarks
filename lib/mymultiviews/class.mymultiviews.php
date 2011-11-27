<?php
// @todo singleton renvoyant une variable static globale $_MULTI['key']
class MyMultiviews {
	var $root;
	var $reservedKeyWords;
	var $actualPath;
	var $args;
	var $total;
	public function __construct( $_root = NULL, $_reservedKeyWords = array() ) {

		$this->root               = $_root;
		$this->reservedKeyWords   = $_reservedKeyWords;
		$this->reservedKeyWords[] = '';
		$this->actualPath         = $_SERVER['REQUEST_URI'];

		if( is_null( $this->root ) ) {
			$temp       = explode('/', $_SERVER['SCRIPT_NAME']);
			$last       = count($temp);
			$this->root = $temp[ $last -1 ];
		}

		if( !is_null($this->root) ) {
			$this->args = explode($this->root, $this->actualPath);
			//var_dump( $this->args );
			if( count($this->args) === 1  ) {
				$this->args = NULL;
			}
			else {
				if( isset( $this->args[1] ) ) {
					$this->args = explode('/', $this->args[1]);
					unset( $this->args[0] );
				}
			}
		}

		$this->cleanArgs();
		$this->setNatural();
		$this->total = count( $this->args );
	}

	protected function cleanArgs() {
		$compteur = 0;
		while( isset( $this->args[ ++$compteur ] )  ) {

			if( is_int( strpos($this->args[$compteur], '?') ) ) {
				$this->args[$compteur] = substr($this->args[$compteur], 0, strpos($this->args[$compteur], "?"));
			}

			if( in_array( $this->args[$compteur], $this->reservedKeyWords )

			 ) {
				unset($this->args[$compteur]);
				$this->args  = array_values($this->args);
				$this->total = count( $this->args );
			}

		}
		$this->setNatural();
	}

	private function setNatural() {
		if( $this->total != 0 ) {
			$compteur 	= 1;
			$temp = array();
			foreach( $this->args as $key => $value ) {
				$temp[ $compteur ] = $value;
				++$compteur;
			}
			$this->args = $temp;
		}
	}

	public function listArgs() {
		return $this->args;
	}

	public function getArgsAsString( $trailingSeparator = FALSE, $separator = '/' ) {
		if( isset( $this->args ) ) {
			$string = implode( $separator, $this->args );
			if( $trailingSeparator === TRUE ) {
				$string .= '/';
			}
			return $string;
		}
		else {
			return FALSE;
		}
	}

	public function getArg( $int ) {
		if( isset( $this->args[ $int ] ) ) {
			return $this->args[ $int ];
		}
	}

	public function last() {
		if( isset($this->args[ $this->total ]) ) {
			return $this->args[ $this->total ];
		}
		else {
			return NULL;
		}
	}

	public function first() {
		if( isset($this->args[ 1 ]) ) {
			return $this->args[ 1 ];
		}
		else {
			return NULL;
		}
	}

}
