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
    protected $categoriesStorage;
    protected $bookmarksStorage;

    public function  __construct( MyPdo $objectPDO  ) {
        if( is_object( $objectPDO ) ) {
            $this->pdo               = $objectPDO;
            $this->categoriesStorage = new SplObjectStorage();
            $this->bookmarksStorage  = new SplObjectStorage();
        }
        else {
            throw new Exception('No object found !');
        }

        $this->getCategories();

        $this->getBookmarksByCategories();
    }

    protected function getCategories() {
        $buffer = $this->pdo->query('SELECT `id`, `name` FROM `' . DB_TABLE_PREFIX . 'categories` WHERE `id` NOT IN (SELECT `id` FROM  `' . DB_TABLE_PREFIX . 'categories` WHERE `id`=\'1\')');
        foreach ($buffer as $key => $array) {
            $categorie = new Categorie( array( 'id'=>$array['id'], 'name'=> $array['name'] ) );
            $this->categoriesStorage->attach( $categorie );
        }
    }

    protected function getBookmarksByCategories() {

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

    protected function getBookmarksByCategorieId( int $id ) {
        
    }

    public function getCategorieById( $categorieId ) {
        $this->categoriesStorage->rewind();
        while( $this->categoriesStorage->valid() ) {
            if( $this->categoriesStorage->current()->id == $categorieId ) {
                return $this->categoriesStorage->current();
            }
            $this->categoriesStorage->next();
        }
    }

    public function  __toString() {
        
    }

}
