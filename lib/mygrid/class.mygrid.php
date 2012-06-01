<?php

Class MyGrid {
	
	public function __construct( $splObjectStorage, $gridPattern = NULL ) {
		$this->layout  = $splObjectStorage;
		$this->items   = $splObjectStorage->count();
		$this->colSize = 3;
		$this->rest    = -1;
		$this->gridPattern = $gridPattern;
		$this->grid    = array_fill(1, $this->items, 'grid_4');

		switch( $this->items%3 ) {
			case 2:
				$this->grid[$this->items-1] = "grid_6";
				$this->grid[$this->items]   = "grid_6";

				break;
				
			case 1:
				$this->grid[$this->items] = "grid_12";
				break;
	
		}
		
	}
	
	function smartGrid() {
		$buffer = new SplObjectStorage();
		$iterator = 0;
		foreach( $this->gridPattern as $value ) {
			$this->layout->rewind();
			while( $this->layout->valid() ) {
				if( $this->layout->current()->id == $value ) {
					$buffer->attach( $this->layout->current() );
				}
				$this->layout->next();
			}
		}
			
		return $buffer;
	}
	
	public function getGrid() {
		return $this->grid;
	}
	
}
