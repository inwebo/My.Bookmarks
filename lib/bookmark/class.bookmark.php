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
class Bookmark {

    public $hash;
    public $url;
    public $title;
    public $tags;
    public $description;
    public $dt;
    public $category;
    public $public;

    public function  __construct( $arrayArgs = NULL ) {
        if( !is_null( $arrayArgs ) ) {
            $this->hash        = $arrayArgs['hash'];
            $this->url         = $arrayArgs['url'];
            $this->title       = $arrayArgs['title'];
            $this->tags        = $arrayArgs['tags'];
            $this->description = $arrayArgs['description'];
            $this->dt          = $arrayArgs['dt'];
            $this->category    = $arrayArgs['category'];
            $this->public      = $arrayArgs['public'];
        }
        else {
            throw new Exception('Empty $arrayArgs');
        }
    }

    public function  __toString() {
        
    }

}
