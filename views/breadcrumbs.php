<?php

class BreadCrumbs {

	public static function display(){
		global $conf;
		global $multiViews;
		$return = '<ul>';
		$return .= '<li><a href="'.$conf['root'].'index.php">Home</a>&nbsp;' . $conf['separator'].'&nbsp;</li>';
		//$return .= $root;
		$count = count( $multiViews->listArgs() );
		$compteur = 0;
		/*if( !is_array( $multiViews->listArgs() ) ) {
			return false;
		}*/

		$list = '';
		if( is_array( $multiViews->listArgs() ) ) {
		foreach( $multiViews->listArgs() as $value ) {
			if( $compteur == 0 ) {
				NULL;
			}
			elseif( $compteur !== $multiViews->total - 1 ) {
				$list .= $value . '/';
				$return .= '<li>'.urldecode($value).'&nbsp;' . $conf['separator'].'&nbsp;</li>';
			}
			else {
				$list .= $value ;
				$return .= '<li>&nbsp;'.urldecode($value).'</li>';
			}
			$compteur++;
		}

		}
		$return .= '</ul>';
		echo $return;
	}

}
