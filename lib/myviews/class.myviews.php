<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class MyViews {
// @ todo gestion des erreurs
    public function  __construct( $templatePath ) {
        $this->templatePath = $templatePath;
    }

    public function display( $view ) {
        $display = $this->templatePath . $view . '.php';
        include(  $display );
    }
    
}
