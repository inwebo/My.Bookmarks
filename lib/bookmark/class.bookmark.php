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
	
    public $id;
    public $hash;
    public $url;
    public $title;
    public $tags;
    public $description;
    public $dt;
    public $category;
    public $public;
    public $favicon;
	
    public function  __construct( $arrayArgs = NULL ) {
        if( !is_null( $arrayArgs ) ) {
        	$tags = new MyTags( $arrayArgs['tags'] );
			$this->id          = $arrayArgs['id'];
            $this->hash        = $arrayArgs['hash'];
            $this->url         = $arrayArgs['url'];
            $this->title       = $arrayArgs['title'];
            $this->tags        = $tags->asArray();
			$this->tagsAsString= $tags->asString();
            $this->description = $arrayArgs['description'];
            $this->dt          = $arrayArgs['dt'];
            $this->category    = $arrayArgs['category'];
            $this->public      = $arrayArgs['public'];
			$this->favicon     = $arrayArgs['favicon'];
        }
        else {
            throw new Exception('Empty $arrayArgs');
        }
    }
	
	public function dateHuman() {
		$buffer    = explode( ' ', $this->dt );
		$buffer[0] = implode( '-', array_reverse( explode( '-', $buffer[0] ) ) );
		$buffer    = implode( ' à ', $buffer );
		return $buffer;
	}
	
	public function dateUnix() {
		$date = new DateTime( $this->dt );
		return $date->format('U');
	}
	
	public function faviconEncode() {
		return base64_encode($this->favicon);
	}
	
	public function asNetscapeBookmark() {
		return '<DT><A HREF="'. $this->url .'" ADD_DATE="'. $this->dateUnix() .'" LAST_VISITED="0" ICON="'. $this->faviconEncode() .'">'. $this->title .'</A>' . "\n";
	}

}
