<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class MyTags {

    public function __construct( $_data ) {
        $this->data = $_data;
        $this->buffer = explode( ' ', trim( $this->data ) );
        $this->count = count( $this->buffer );
    }

	// TO del
    public function asArray() {
		return $this->buffer;
    }
	
	public function asString(){
		return implode(' ', $this->buffer);
	}

}

?>
