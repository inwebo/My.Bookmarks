<?php

Class Ahref extends FormNode {

	public function __construct( $params =array() ) {
		parent::__construct();

                $defaultParams = array(
                                                    'id'       => NULL,
                                                    'text'     => NULL,
                                                    'href'     => NULL,
                                                    'target'   => NULL,
                                                    'title'    => NULL,
                                                    'hreflang' => NULL,
                                                    'rev'      => NULL,
                                                    'shape'    => NULL,
                                                    'rel'      => NULL
                                                );

                $params = array_merge( $defaultParams, $params );

		$this->addAttributs = array(
                        "id"       => $params['id'],
                        "text"     => $params['text'],
			"href"     => $params['href'],
			"target"   => $params['target'],
			"title"    => $params['title'],
			"hreflang" => $params['hreflang'],
			"rev"      => $params['rev'],
			"shape"    => $params['shape'],
			"rel"      => $params['rel']
		);
                
		$this->htmlTag        = 'a';
		$this->selfClosingTag = FALSE;
		$this->buildAttributs( $this->addAttributs );

		( is_null( $this->attributs['text'] ) )  ? $this->addChilds( $this->attributs['id'] )            : $this->addChilds( $this->attributs['text'] ) ;
		( is_null( $this->attributs['href'] ) )  ? $this->attributs['href']   = '#'                      : NULL;
		( is_null( $this->attributs['title'] ) ) ? $this->attributs['title']  = $this->attributs['name'] : NULL;
		( $this->attributs['rel'] )              ? $this->attributs['rel']    = 'nofollow'               : NULL;
		unset( $this->attributs["type"] );
		unset( $this->allowedType );
		$this->cleanObject();
	}

        public function asString() {
            ob_start();
            $buffer = $this->__toString();
            ob_get_flush();
            return $buffer;
        }

	public function __toString(){
		return parent::__toString();
	}
}
