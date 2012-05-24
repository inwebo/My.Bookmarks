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
class FactoryCategories {

    protected $pdo;

    public function  __construct( MyPdo $objectPDO  ) {
        if( is_object( $objectPDO ) ) {
            $this->pdo = $objectPDO;
        }
        else {
            throw new Exception('No object found !');
        }
    }

    public function getCategories() {
		$buffer = new SplObjectStorage();
        $results = $this->pdo->query('SELECT `id`, `name` FROM `' . DB_TABLE_PREFIX . 'categories`');
		
        foreach ($results as $key => $array) {
            $categorie = new Categorie( array( 'id'=>$array['id'], 'name'=> $array['name'] ) );
            $buffer->attach( $categorie );
        }
		return $buffer;
    }

	// @ todo ajouter visibilité categorie
	public function getCategorie( $idCat ) {
		$results = $this->pdo->query('SELECT `id`, `name` FROM `' . DB_TABLE_PREFIX . 'categories` WHERE `id`=?', array($idCat));
		if( count( $results ) !== 0 ) {
			return new Categorie(array( 'id'=>$results[0]['id'], 'name'=> $results[0]['name'] ));
		}
		else {
			return null;
		}
	}

	public function getBookmarksByCategorie( $idCat, $visibility = '1' ) {
		$cat            = $this->getCategorie($idCat);
		$arrayBookmarks = $this->pdo->query('SELECT * FROM ' . DB_TABLE_PREFIX . 'bookmarks where category=? ORDER BY `dt` DESC', array($cat->id));
            foreach($arrayBookmarks as $key => $bookmarks) {
                ( is_file( PATH_ROOT . 'images/favicon/'.$bookmarks['hash'] ) ) ?
              		$favicon = PATH_ROOT . 'images/favicon/'.$bookmarks['hash'] :
                		$favicon = PATH_DEFAULT_FAVICON ;
                $bookmark = new Bookmark( array(
                		'id'          => $bookmarks['id'],
                        'hash'        => $bookmarks['hash'],
                        'url'         => $bookmarks['url'],
                        'title'       => $bookmarks['title'],
                        'tags'        => $bookmarks['tags'],
                        'description' => $bookmarks['description'],
                        'dt'          => $bookmarks['dt'],
                        'category'    => $bookmarks['category'],
                        'public'      => $bookmarks['public'],
                        'favicon'     => $favicon
                ));
                $cat->splObjectStorage->attach( $bookmark );
            }
		return $cat;
	}

    public function getBookmarksByCategories() {

        $this->categoriesStorage->rewind();
        while( $this->categoriesStorage->valid() ) {
            $arrayBookmarks = $this->pdo->query('SELECT * FROM ' . DB_TABLE_PREFIX . 'bookmarks where category=? ORDER BY `dt` DESC', array($this->categoriesStorage->current()->id));

            foreach($arrayBookmarks as $key => $bookmarks) {
                ( is_file( PATH_ROOT . 'images/favicon/'.$bookmarks['hash'] ) ) ?
              		$favicon = PATH_ROOT . 'images/favicon/'.$bookmarks['hash'] :
                		$favicon = PATH_DEFAULT_FAVICON ;
                $bookmark = new Bookmark( array(
                		'id'          => $bookmarks['id'],
                        'hash'        => $bookmarks['hash'],
                        'url'         => $bookmarks['url'],
                        'title'       => $bookmarks['title'],
                        'tags'        => $bookmarks['tags'],
                        'description' => $bookmarks['description'],
                        'dt'          => $bookmarks['dt'],
                        'category'    => $bookmarks['category'],
                        'public'      => $bookmarks['public'],
                        'favicon'     => $favicon
                ));
                $this->categoriesStorage->current()->splObjectStorage->attach( $bookmark );
            }

            $this->categoriesStorage->next();
        }

    }


    public function getBookmarksFront( $categoriesSplStorage ) {
		$categoriesSplStorage->rewind();
		$iterator = 1;
		while( $categoriesSplStorage->valid() ) {
			$temp = $this->getBookmarksByCategorie( $categoriesSplStorage->current()->id );
			$categoriesSplStorage->current()->splObjectStorage->attach($temp);
		    $iterator++;
		    $categoriesSplStorage->next();
		}
		
		return $categoriesSplStorage;
    }

	public function getBookmarksByTag( $tagToSearch ) {
		$buffer = new SplObjectStorage();
		$arrayBookmarks = $this->pdo->query('SELECT * FROM ' . DB_TABLE_PREFIX . 'bookmarks where tags LIKE \'%' . $tagToSearch . '%\' ORDER BY `dt` DESC' );
			foreach($arrayBookmarks as $key => $bookmarks) {
                ( is_file( PATH_ROOT . 'images/favicon/'.$bookmarks['hash'] ) ) ?
              		$favicon = PATH_ROOT . 'images/favicon/'.$bookmarks['hash'] :
                		$favicon = PATH_DEFAULT_FAVICON ;
				$bookmark = new Bookmark( array(
					'id'          => $bookmarks['id'],
					'hash'        => $bookmarks['hash'],
					'url'         => $bookmarks['url'],
					'title'       => $bookmarks['title'],
					'tags'        => $bookmarks['tags'],
					'description' => $bookmarks['description'],
					'dt'          => $bookmarks['dt'],
					'category'    => $bookmarks['category'],
					'public'      => $bookmarks['public'],
					'favicon'     => $favicon
				));
				
				$buffer->attach( $bookmark );
			}
			return $buffer;
	}
}
	