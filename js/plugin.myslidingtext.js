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

    $.mySlidingText = function( options ) {

		// Arguments
		

        var defaults = {
        	// Affiche dans la console de firebug le déroulement du processus
            debug			: true,
            autostart		: false,
            sliding			: false,
            
            parent			: null,
            parentHeight	:-1,
			parentWidth		:-1,
			
            child			:null,
            childHeight		:-1,
            childWidth		:-1,

            motionTime		: 3000,
            motionDistance	: -1,
            motionX			: 0
        }

        var plugin = this;

        plugin.settings = {}


		/*
		 * Constructeur de l'objet
		 */
        var init = function() {
        	
        	// Construction des attributs 
            plugin.settings				= $.extend({}, defaults, options);
            plugin.settings.name		= 'MySliding test';
            plugin.settings.version		= '10-2012';

			if( plugin.settings.parent === null ) {
				debug( 'No parent has been selected' );
				return;
			}

			if( plugin.settings.child  === null ) {
				debug( 'No child has been selected' );
				return;
			}	
		
			plugin.settings.parentWidth    = $(plugin.settings.parent).width();
			plugin.settings.parentHeight   = $(plugin.settings.parent).height();

			plugin.settings.childWidth     = $(plugin.settings.child).width();
			plugin.settings.childHeight    = $(plugin.settings.child).height();
			
			if( plugin.settings.childWidth > plugin.settings.parentWidth ) {
				plugin.settings.motionDistance = plugin.settings.childWidth - plugin.settings.parentWidth;
			}
			else {
				return;
			}

			if( plugin.settings.autostart === true ) {
				animateText();		
			}		

        }

		plugin.startSliding = function () {
			animateText();
		}

		plugin.stopSliding = function () {
			$(plugin.settings.child).stop( true, true).css( 'marginLeft', 0 );
			plugin.settings.sliding = false;
		}

		var animateText = function () {
				$(plugin.settings.child).animate({
					marginLeft: -plugin.settings.motionDistance
				},plugin.settings.motionTime ,'linear').animate({
					marginLeft: 0
				}, plugin.settings.motionTime, 'linear', function(){ animateText() });
				plugin.settings.sliding = true;
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
