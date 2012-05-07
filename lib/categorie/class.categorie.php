<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class
 *
 * @author inwebo
 */
class Categorie {

    public $id;
    public $name;
    public $splObjectStorage;

    public function  __construct( $arrayArgs = NULL ) {
        if( !is_null( $arrayArgs ) ) {
            $this->id               = $arrayArgs['id'];
            $this->name             = $arrayArgs['name'];
            $this->splObjectStorage = new SplObjectStorage();
        }
        else {
            throw new Exception('Empty $arrayArgs');
        }
    }

    public function  __toString() {
        
    }

}
