<?php
/**
  * My Framework : My.Forms
  *
  * LICENCE
  *
  * You are free:
  * to Share ,to copy, distribute and transmit the work to Remix —
  * to adapt the work to make commercial use of the work
  *
  * Under the following conditions:
  * Attribution, You must attribute the work in the manner specified by
  *   the author or licensor (but not in any way that suggests that they
  *   endorse you or your use of the work).
  *
  * Share Alike, If you alter, transform, or build upon
  *     this work, you may distribute the resulting work only under the
  *     same or similar license to this one.
  *
  *
  * @category   My.Forms
  * @package    Base
  * @copyright  Copyright (c) 2005-2011 Inwebo (http://www.inwebo.net)
  * @license    http://http://creativecommons.org/licenses/by-nc-sa/3.0/
  * @version    $Id:$
  * @link       https://github.com/inwebo/My.Forms
  * @since      File available since Beta 01-10-2011
  */

 /**
  * Class abstraite dont tous les objets d'un formulaire HTML vont héri-
  * -tés.
  * L'affichage de l'objet se fait avec la méthode magique __toString()
  * de manière recursive.
  *
  * @todo	Add anchor tag to all elemets
  * @todo	Custom validate $this->validate
  * @category   My.Forms
  * @package    Base
  * @copyright  Copyright (c) 2005-2011 Inwebo (http://www.inwebo.net)
  * @license    http://http://creativecommons.org/licenses/by-nc-sa/3.0/
  * @version    $Id:$
  * @link       https://github.com/inwebo/My.Forms
  * @since      Class available since Beta 01-10-2011
  */

abstract class FormNode {
  /**
   * id unique pour tous les objets
   *
   * @var int
   */
	static $id = 0;

  /**
   * Préfixe commun au nom de tous les objets
   *
   * @var string
   */
	protected $defaultName;

  /**
   * Nom d'un item, sous la form defaultName + id
   *
   * @var string
   */
	protected $itemId ;

  /**
   * La balise HTML est elle autofermante
   *
   * @var bool
   */
	protected $selfClosingTag;

  /**
   * Balisage HTML autorisé
   *
   * @var array
   */
	protected $allowedType;

  /**
   * Ensemble d'attributs HTML à ajouter aux atttributs de base
   *
   * @var array
   */
	protected $addAttributs;

  /**
   * Balise HTML
   *
   * @var string
   */
	protected $htmlTag;

  /**
   * Attributs HTML communs à tous les objets
   *
   * @var array
   */
	protected $baseAttributs ;

  /**
   * Container de tous les attributs d'un objet du formulaire
   *
   * @var array
   */
	protected $attributs;

  /**
   * Si l'objet posséde des enfants il sont contenus ici
   *
   * @var array
   */
	public $childs;

  /**
   * Si l'objet posséde un label HTML, le texte est contenu
	 * dans ce tableau.
	 *
	 * Exemple de label :
	 * <code>
	 * $this->label = array( "before" => "texte avant l\'objet",
	 *											 "after"	=> "texte aprés l\'objet");
	 * </code>
   *
   * @var array
   */
	protected $label;

  /**
   * Initialisation des toutes les variables de classe nécessaire à un
   * objet.
   * A chaque instantation d'un nouvel objet enfant incrémentation de la
   * variable statique self::$id.
   *
   * Tous les enfants possèdent les attributs de base contenu dans,
   * $this->baseAttributs. Les attributs supplémentaires contenus dans
   * $this->addAttributs spécifiques à chaque instance d'objet seront
   * fusionnés avec ceux de base dans $this->attributs.
   *
   * Si l'instance peut contenir des enfants, typiquement les tags HTML
   * n'ayant pas de balise autofermante, seront disponibles dans
   * $this->childs
   *
   * Tous les attributs contenu dans $this->attributs non null seront
   * présent dans la representation HTML de l'objet.
   *
   * @param  array $params
   * @return void
   */
	protected function __construct( $params = array(
                                                        "type" => NULL,
                                                        "id" => NULL,
                                                        "class" => NULL,
                                                        "style" => NULL,
                                                        "title" => NULL,
                                                        "name" => NULL
                                                  )
					) {
		++self::$id;
		$this->defaultName     = "item-";
		$this->itemId          = $this->defaultName.FormNode::$id;
		$this->selfClosingTag  = false;
		$this->allowedType     = array("node");
		$this->addAttributs;
		$this->htmlTag         = NULL;
		$this->baseAttributs = array(
                                            "type"        => "node",
                                            "id"          => $this->itemId,
                                            "class"       => $params['class'],
                                            "style"       => $params['style'],
                                            "title"       => $params['title'],
                                            "name"        => $this->itemId,
                                            "lang"        => NULL,
                                            "dir"         => NULL,
                                            "tabindex"    => NULL,
                                            "accesskey"   => NULL,
                                            "onclick"     => NULL,
                                            "ondblclick"  => NULL,
                                            "onmousedown" => NULL,
                                            "onmouseup"   => NULL,
                                            "onmouseover" => NULL,
                                            "onmousemove" => NULL,
                                            "onmouseout"  => NULL,
                                            "onkeypress"  => NULL,
                                            "onkeydown"   => NULL,
                                            "onkeyup"     => NULL,
                                            "onfocus"     => NULL,
                                            "accesskey"   => NULL,
                                            "onblur"      => NULL
                                        );
		$this->childs	= null;
		$this->label	= null;
	}

  /**
   * Fusionne les attributs html de bases avec les attributs supplé-
   * -mentaires spécifique à l'objet enfant.
   *
   * @param  array $array
   * @return void
   */
    protected function buildAttributs( $array = array() ) {
        $this->attributs = array_merge( $this->baseAttributs, $array );
    }

  /**
   * L'attribut HTML est il authorisé dans l'objet enfants. C'est à dire
   * si la clef à ajouter/modifer est déjà présente dans $this->attributs
   *
   * @param  array $array
   * @return void
   */
	protected function isAllowedAttributs( $key ) {
		return array_key_exists( $key, $this->attributs );
	}

  /**
   * Supprimre les attributs inutiles pour les enfants.
   *
   * @param  void
   * @return void
   */
	protected function cleanObject() {
		unset($this->baseAttributs);
		unset($this->addAttributs);
	}

  /**
   * Pour tous les enfants autorisant le tag HTML <label>, modification
   * du texte précédent ou suivant l'enfant. A noter que le HTML est
   * autorisé.
   *
   * @todo	security
   * @param  string $before texte précédent
   * @param  string $after texte suivant
   * @return void
   */
	public function setLabel( $before = NULL, $after = NULL ) {
		if( !is_null( $before ) ) {
			$this->label['before'] = $before;
		}
		if( !is_null( $after ) ) {
			$this->label['after'] = $after;
		}
	}

  /**
   * Vide un label
   *
   * @return void
   */
	public function clearLabel() {
		$this->label = NULL;
	}

  /**
   * Ajoute un enfant $newChild ayant comme identifiant $key.
   *
   * @param mixed $newChild
   * @param string $key voir le fonctionnement des tableaux en PHP
   * @return void
   */
	public function addChilds( $newChild , $key = NULL ) {
		if( $key !== NULL ) {
			$this->childs[$key] = $newChild;
		}
		else {
			$this->childs[] = $newChild;
		}
	}

  /**
   * Ajoute un enfant $newChild ayant comme identifiant $key.
   *
   * @param array $newAttributs Attributs disponible dans $this->attributs
   * @return void
   */
	public function setAttributs( $newAttributs = array() ) {
		foreach( $newAttributs as $key => $value ) {
			if( $this->isAllowedAttributs($key) ) {
				$this->attributs[$key] = $value;
			}
		}
	}

  /**
   * Affiche l'objet sous forme de chaine HTML valide w3c, de manière
   * recursive.
   *
   * @param void
   * @return string $output
   */
	public function __toString() {
		$output = '';

		if( isset( $this->label['before'] )  ) {
			$output .= '<label>'.$this->label['before'];
		}
		elseif(isset( $this->label['after'])) {
		$output .= '<label>';
		}

		if ( isset($this->htmlTag) && $this->htmlTag !== NULL) {
			$output .= "<" . strtolower($this->htmlTag);

			foreach( $this->attributs as $key => $value ) {
				if( $value !== NULL ) {
					$output .= ' ' .strtolower($key). '="' . strtolower($value) .'"';
				}
			}

			if( $this->selfClosingTag ) {
				$output .= ' />';
			}
			else {
				$output .= ' >';
						$output .= "\n";
				if( !is_null($this->childs) ) {
					foreach($this->childs as $display ) {
						if( is_object( $display ) ) {
							$output .= $display->__tostring();
						}
						elseif(is_string($display) ) {
							$output .= $display;
						}
						else {
							NULL;
						}
					}
				}
				$output .= '</'.strtolower($this->htmlTag).'>';
			}
		}

		if( isset($this->label['after'] )  ) {
			$output .= $this->label['after'] .'</label>';
		}
		elseif(isset($this->label['before'] )) {
			$output .= '</label>';
		}

		$output .= "\n";
		return $output;
	}

}
