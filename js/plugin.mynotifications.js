/**
 * My.Notifications
 * 
 * Plugin Jquery de notification visuel d'événements. Simple et configurable
 *
 * LICENCE
 *
 * Vous êtes libre de :
 *
 * Partager : reproduire, distribuer et communiquer l'oeuvre
 * Remixer  : adapter l'oeuvre 
 *
 * Selon les conditions suivantes :
 *
 * Attribution : Vous devez attribuer l'oeuvre de la manière indiquée par 
 * l'auteur de l'oeuvre ou le titulaire des droits (mais pas d'une manière
 * qui suggérerait qu'ils vous soutiennent ou approuvent votre utilisation 
 * de l'oeuvre). 
 *
 * Pas d’Utilisation Commerciale : Vous n'avez pas le droit d'utiliser cette
 * oeuvre à des fins commerciales. 
 *
 * Partage à l'Identique : Si vous modifiez, transformez ou adaptez cette
 * oeuvre, vous n'avez le droit de distribuer votre création que sous une
 * licence identique ou similaire à celle-ci.
 *
 * Remarque : A chaque réutilisation ou distribution de cette oeuvre, vous 
 * devez faire apparaître clairement au public la licence selon laquelle elle
 * est mise à disposition. La meilleure manière de l'indiquer est un lien vers
 * cette page web. 
 *
 * @category  Jquery
 * @package   Plugin
 * @copyright Copyright (c) 2005-2012 Inwebo (http://www.inwebo.net)
 * @author    Julien Hannotin
 * @license   http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
 * @version   05-2012
 * @link      git://github.com/inwebo/MyNotifications-Jquery-plugin.git
 */
;(function($) {

    $.myNotifications = function( options ) {

		// Arguments
		

        var defaults = {
        	// Affiche dans la console de firebug le déroulement du processus
            debug: true,
            // Nom du container principal
            containerName: 'my-notifications',
            // Selecteur type 
            containerSelectorType: '#',
            // Selecteur CSS
            containerSelector:'',
            // Nom de la liste 
            listName: 'notifications',
            // Selecteur type 
            listSelectorType: '#',
            // Selecteur CSS
            listSelector:'',
            // Durée d'affichage des notifications en ms
            // Un entier négatif donne un affichage perpetuel
            itemDisplayDelay : 3000,
            // Nombre ajouts de notifications total dans la liste
            itemNumber: -1,
            // Préfixe des notifications
            itemName: 'notifications-',
            // Selecteur type 
            itemSelectorType: '#',
            // Selecteur CSS
            itemSelector:'',
            // Nombre de notifications présentes dans le DOM
            itemCount:0,
            // Les notifications se ferment elles lors d'un clic ?
            itemCloseByClick: true,
            // Les notifications se ferment elles avec un boutton ?
            itemCloseByButton: true,
            // Class CSS des notifications d erreurs
            itemClassError:'my-notifications-error',
			// Class CSS des notifications avertissement
            itemClassWarning:'my-notifications-warning',
			// Class CSS des notifications d information
			itemClassInfo:'my-notifications-info',
			// Class CSS des notifications validation
			itemClassOkay:'my-notifications-okay',
			// Class CSS du bouton fermeture de notification
			itemClassClose:'my-notifications-close'
            
        }

        var plugin = this;

        plugin.settings = {}


		/*
		 * Constructeur de l'objet
		 */
        var init = function() {
        	
        	// Construction des attributs 
            plugin.settings                   = $.extend({}, defaults, options);
            plugin.settings.name              = 'MyNotifications';
            plugin.settings.version           = '05-2012';
            plugin.settings.containerSelector = plugin.settings.containerSelectorType + plugin.settings.containerName;
            plugin.settings.listSelector      = plugin.settings.listSelectorType + plugin.settings.listName;
            plugin.settings.listItemSelector  = plugin.settings.listSelectorType + plugin.settings.listName + ' li';
            
            // #1 : On s'assure de la présence du container dans le DOM, si il n'est pas présent on l'ajoute            
            ( !containerIsSet() ) ? buildContainer() : null;
            
            // #2 : Ajout eventuel d'un listener sur le click des items
            if( plugin.settings.itemCloseByClick == true ) {
	            $( plugin.settings.listItemSelector ).live( 'click', function(){
	            	removeDom( $( this ) );
	            });
            }
            
            // #3 : Ajout eventuel d'un listener sur le click d'un bouton fermer
            if( plugin.settings.itemCloseByButton == true ) {
	            var buttonCloseSelector = '.' + plugin.settings.itemClassClose;
	            
	            $( buttonCloseSelector ).live('click', function(){
	            	removeDom( $( this ).parent().parent() );
	            });
            }
        }
	
	   /*
	    * Le container principal est il présent dans le DOM
	    * 
	    * @return true si il est déjà présent sinon false
	    * 
	    */
		var containerIsSet = function() {
			var containerId = $( plugin.settings.containerSelector );
			if( containerId.length == 0 )   {
				debug( 'Container ' + plugin.settings.containerSelector + ' doesn\'t exist' );
				return false;
			}
			else {
				debug( 'Container ' + plugin.settings.containerSelector + ' found' );
				return true;
			}
		}
	
	   /*
	    * Le container principal n'est pas présent, on l'ajoute au DOM
	    * Cela sera le dernier noeud enfant du noeud body
	    * 
	    * @return void
	    * 
	    */
		var buildContainer = function() {
			var container = $( '<div></div>' ).attr( 'id' , plugin.settings.containerName );
			$( 'body' ).append( container );
			var list = $( '<ul></ul>' ).attr( 'id', plugin.settings.listName );
			$( plugin.settings.containerSelector ).append( list );
			debug( 'Container ' + plugin.settings.containerSelector + ' ready' );
			debug( 'List ' + plugin.settings.listSelector + ' ready' );
		}
	
	   /*
	    * Construction des attributs indispensable pour chaques notifications
	    * 
	    * @return void
	    * 
	    */
		var buildItemAttributs = function() {
			plugin.settings.itemNumber++;
			plugin.settings.itemCount++;
			plugin.settings.itemSelector = '#' + plugin.settings.itemName + plugin.settings.itemNumber;
			debug( 'Item current selector ' + plugin.settings.itemSelector );
			debug( 'Item count ' + plugin.settings.itemCount );
		}
	
	   /*
	    * Affiche une notification ayant comme titre title et avec comme
	    * text text
	    * 
	    * @param STRING title Un type prédéfini parmi okay | warning | error | info
	    *               peut être défini par l'utilisateur, la notifications
	    *               sera un message
	    * 
	    * @param STRING text  Le text à afficher
	    * 
	    * @return void
	    * 
	    */
		plugin.msg = function ( title, text ) {
			buildItemAttributs();
			
			notification = $( '<li></li>' );
			
			debug( 'Item added to dom' + "\n" + 'id : ' + 
					plugin.settings.itemSelector + "\n" + 
					'type:' + title + "\n" + 
					'duration:' + plugin.settings.itemDisplayDelay + ' ms' );
			
			var itemTempName = plugin.settings.itemName + plugin.settings.itemNumber;
			var itemHeading  = '';
			
			notification.attr( 'id' , itemTempName ).hide();
			
		    switch( title ) {
		        case 'error' :
					itemHeading = 'Error';
					notification.addClass( plugin.settings.itemClassError );
		            break;
		        case 'warning' :
					itemHeading = 'Warning';
					notification.addClass( plugin.settings.itemClassWarning );
		            break;
		        case 'info' :
					itemHeading = 'Information';
					notification.addClass( plugin.settings.itemClassInfo );
		            break;
		        case 'okay' :
					itemHeading = 'Okay';
					notification.addClass( plugin.settings.itemClassOkay );
		            break;
		        default :
		        	itemHeading = title;
		        	break;
		    }
		    
			var headingObject = $( $( '<h6></h6>' ) );
			notification.append( headingObject.html( itemHeading ) );
			
			
			notification.append( $( '<p></p>' ).html( text ) );
			$( plugin.settings.listSelector ).append( notification );
			
		    // #1 : Doit on ajouter un bouton fermer la notification ?
			if( plugin.settings.itemCloseByButton == true ) {
				var closeButton = $( '<a></a>' ).attr( 'class', plugin.settings.itemClassClose ).attr('href', '#').attr('onClick', 'return false;').html('x');
				headingObject.append( closeButton );
			}
			
		    // #2 : La notification doit elle être affichée indefiniment ?
			if(plugin.settings.itemDisplayDelay > 0) {
				$( notification ).fadeIn( 'fast' ).delay( plugin.settings.itemDisplayDelay ).fadeOut( 'fast',function(){
					removeDom( notification );
					debug( 'Item removed from dom' + "\n" + 
					       'id : ' + plugin.settings.itemSelector + "\n" + 
					       'type:' + title );
				});				
			}
			else {
				$( notification ).fadeIn( 'fast' );
			}

		}
	
	   /*
	    * Supprime item du DOM, et mets à jour le nombre total de notifications encore
	    * présentes dans le DOM
	    * 
	    * @param STRING item le selecteur d'un item à supprimer du DOM
	    * 
	    * @return void
	    * 
	    */
		var removeDom = function( item ) {
			plugin.settings.itemCount--;
			$( item ).remove();
			debug( 'Still : ' + plugin.settings.itemCount + ' items into DOM.' );
		}
		
	   /*
	    * Alias de msg('error', text)
	    */
		plugin.msgError = function( text ) {
			plugin.msg( 'error' , text);
		}

	   /*
	    * Alias de msg('warning', text)
	    */
		plugin.msgWarning = function( text ) {
			plugin.msg('warning' , text);
		}

	   /*
	    * Alias de msg('info', text)
	    */
		plugin.msgInfo = function( text ) {
			plugin.msg( 'info' , text);
		}
	
	   /*
	    * Alias de msg('okay', text)
	    */
		plugin.msgOkay = function( text ) {
			plugin.msg( 'okay' , text);
		}
	
		/*
		 * Debug nécessite le support de console.info()
		 */
    	var debug = function( text ) {
    		// Verifie que ce n'est pas internet explorer
    		if( (window['console'] !== undefined) ){
    			( plugin.settings.debug == true ) ? console.info( text ) : null ;
    		}
    	}

		// Construteur
        init();

    }

})(jQuery);
