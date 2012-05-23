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

	public function getCategorie( $idCat ) {
		$results = $this->pdo->query('SELECT `id`, `name` FROM `' . DB_TABLE_PREFIX . 'categories` WHERE `id`=?', array($idCat));
		if( count( $results ) !== 0 ) {
			return new Categorie(array( 'id'=>$results[0]['id'], 'name'=> $results[0]['name'] ));
		}
		else {
			return null;
		}
	}

	public function getBookmarksByCategorie( int $idCat ) {
		$cat            = $this->getCategorie($idCat);
		$arrayBookmarks = $this->pdo->query('SELECT * FROM ' . DB_TABLE_PREFIX . 'bookmarks where category=? ORDER BY `dt` DESC', array($cat->id));
            foreach($arrayBookmarks as $key => $bookmarks) {
                
                $bookmark = new Bookmark( array(
                        'hash'        => $bookmarks['hash'],
                        'url'         => $bookmarks['url'],
                        'title'       => $bookmarks['title'],
                        'tags'        => $bookmarks['tags'],
                        'description' => $bookmarks['description'],
                        'dt'          => $bookmarks['dt'],
                        'category'    => $bookmarks['category'],
                        'public'      => $bookmarks['public']
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
                
                $bookmark = new Bookmark( array(
                        'hash'        => $bookmarks['hash'],
                        'url'         => $bookmarks['url'],
                        'title'       => $bookmarks['title'],
                        'tags'        => $bookmarks['tags'],
                        'description' => $bookmarks['description'],
                        'dt'          => $bookmarks['dt'],
                        'category'    => $bookmarks['category'],
                        'public'      => $bookmarks['public']
                ));
                $this->categoriesStorage->current()->splObjectStorage->attach( $bookmark );
            }

            $this->categoriesStorage->next();
        }

    }

}
