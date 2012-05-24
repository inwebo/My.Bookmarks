<?php

Class MyGrid {
	
	public function __construct( $splObjectStorage, $gridPattern = NULL ) {
		$this->layout  = $splObjectStorage;
		$this->items   = $splObjectStorage->count();
		$this->colSize = 3;
		$this->rest    = -1;
		$this->gridPattern = $gridPattern;
		$this->grid    = array_fill(1, $this->items, 'grid_4');
		
		// #1 : Trouve l'entier multiple de colSize le plus proche
		$this->rest = $this->multipleNombre( $this->items, $this->colSize ) - $this->items;
		// #2 Sil il reste 2 places sur la dernière ligne, l'element est seul
		if($this->rest == 2) {
			$this->grid[$this->items] = "grid_12";
		}
		// #2-1 : Si il reste une place sur la derniere ligne, deux elements
		else {
			$this->grid[$this->items-1] = "grid_6";
			$this->grid[$this->items]   = "grid_6";
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
	
	function multipleNombre ($val,$mul) {
		$a = ( (float) $val) / ( (float) $mul );
		$b = intval($a);
		if(($a-$b)<=0.5){
			$r = $b*$mul;
		}else{
			$r = ($b+1)*$mul;
		}
		$r = max($r,$mul);
		return $r;
	}
	
	public function getGrid() {
		return $this->grid;
	}
	
}
