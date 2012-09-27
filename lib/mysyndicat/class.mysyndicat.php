<?php

/**
 * Liste et retourne tous les dossiers et fichiers d'une arborescence
 *
 * Retourne tous les fichiers et dossiers d'une arborescence sous forme de tableau.
 *
 *
 * @author	   Inwebo
 * @copyright  Inwebo
 * @license    http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
 * @version    24.04.11
 * @link       http://inwebo.free.fr
 * @since      Avril 2011
 * @modified   24 04 2011
 */
 
abstract Class MySyndicat extends DOMDocument {
	
	public $_xmlVersion;
	public $_xmlEncoding;
	
	public $shema;
	public $params;
	public $root;
	
	public function __construct( $_xmlVersion  = '1.0', $_xmlEncoding = 'utf-8' ) {

		parent::__construct( $_xmlVersion, $_xmlEncoding );
		$this->formatOutput = TRUE;
		$this->params		= array();
	}

	protected function isRequired($key , $attr = NULL ) {
		if( !is_null( $attr ) && !$this->isNullVal($key)) {
			if( $this->shema[ $key ][$attr] === TRUE) { return TRUE; } else { return FALSE; };
		}
		else {
			if( $this->shema[ $key ] === TRUE) { return TRUE; } else { return FALSE; };
		}
		
	}

	protected function isAttribut( $key ) {
		return is_array($this->shema[ $key ]);
	}

	protected function isNullVal( $key, $attr = NULL ) {
		if( !is_null( $attr ) && !$this->isNullVal($key)) {
			return @is_null($this->params[ $key ][$attr]);
		}
		else {
			return @is_null($this->params[ $key ]);
		}
	}

	protected function newNode( $key, $value = NULL, $attributs = NULL ) {
		
		// Noeud simple
		if( is_null( $attributs ) && !is_null( $value ) ) {
			return $this->createElement( $key, $value ) ;
		}
		elseif(is_null( $attributs )) {
			return $this->createElement( $key ) ;
		}
		// Noeud enfants
		else {
			
			// Autofermant que des attributs
			if( $value === NULL && isset($attributs)) {
				//echo 'Autofermant que des attributs';
				$buffer = $this->createElement( $key );
				foreach($attributs as $keyz => $value) {
					$buffer->setAttribute($keyz, $value);
				}
				$this->root->appendChild($buffer);
			}
			// Pas autofermant avec attributs
			elseif( $value !== NULL && isset($attributs) ) {
				$buffer = $this->createElement( $key,$attributs['#value'] );
				unset($attributs['#value']);
				foreach($attributs as $k => $v) {
					$buffer->setAttribute($k, $v);
				}
				$this->root->appendChild($buffer);
			}	
		}
		
	}
	
	protected function buildParamsNodes() {
		$iterator = new RecursiveArrayIterator($this->params);
		
		while ( $iterator->valid() ) {
			
			// N'as pas d'enfant
			if ( !$iterator->hasChildren() ) {
				$this->root->appendChild( $this->newNode( $iterator->key(), $iterator->current() ) );
			}
			else {
				// Dans le shema il y a t il un clef #value valant NULL
				if( !array_key_exists('#value', $this->shema[$iterator->key()]) ) {
					$t = $iterator->current();
					$buffer = $this->root->appendChild( $this->newNode( $iterator->key()) );
					foreach( $this->params[$iterator->key()] as $key => $value ) {
						$buffer->appendChild( $this->newNode( $key, $value));
					}	
					
				}
				else {
					$t = $iterator->current();
					if( array_key_exists('#value', $this->params[$iterator->key()]) ) {						
						$this->newNode($iterator->key(), $t['#value'], $this->params[$iterator->key()]);
					}
					else {
						$this->newNode($iterator->key(), NULL, $this->params[$iterator->key()]);
					}
					
				}
				
			}
			
			$iterator->next();
		}
		
	}
	
	protected function validateParams() {

		$iterator = new RecursiveArrayIterator($this->shema);
		
		while ( $iterator->valid() ) {
		
		    if ( $iterator->hasChildren() ) {
		        foreach ($iterator->getChildren() as $attrKey => $attrValue) {
					// Attribut non renseigné et obligatoire
					if( $this->isRequired($iterator->key(), $attrKey) && $this->isNullVal( $iterator->key(), $attrKey ) ) {
						throw new DOMException( $iterator->key() . ' atribut ' . $attrKey . ' is not set' );
					}
		        }
		    } else {

		        // Element obligatoire non renseigné
				if( $this->isRequired( $iterator->key() ) &&  $this->isNullVal( $iterator->key() ) ) {
						throw new DOMException( ' param ' . $iterator->key() . ' is not set' );
				}
						        
		    }

		    $iterator->next();
		}
		
	}

};