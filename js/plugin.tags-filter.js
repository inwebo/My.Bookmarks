;(function($) {

    $.myTagsFilter = function( options ) {
    	
        var defaults = {
            // Affiche dans la console de firebug le déroulement du processus
            debug: true,
            // Input selector
            inputSelector:'#tagsFilter',
            // Tags selector
            tagsSelector:'.tags',
            // Tags attributs to search from
            dataTags:'data-tags'
        }
    	
        var plugin = this;

        plugin.settings = {}
        
        var init = function() {

            plugin.settings                = $.extend({}, defaults, options);
            plugin.settings.pluginName     = "MyTagsFilter";
            plugin.settings.pluginVersion  = "05-2012";
            plugin.settings.tagsList       = $( plugin.settings.tagsSelector );
            plugin.settings.tagsCount      = plugin.settings.tagsList.length;
            debug( 'Construct ' + plugin.settings.pluginName + ' v' + plugin.settings.pluginVersion );
			debug( 'Attributs' + "\n" +
        		   'inputSelector : ' + plugin.settings.inputSelector + "\n" +
        		   'tagsSelector : ' + plugin.settings.tagsSelector + "\n" +
        		   'dataTags : ' + plugin.settings.dataTags );
        	debug( 'Total tags : ' + plugin.settings.tagsCount );       
            
            $( plugin.settings.inputSelector ).keyup( function(){
            	plugin.settings.inputVal       = $( plugin.settings.inputSelector ).val();
            	debug( 'Search tags like : ' + plugin.settings.inputVal );   	
            	plugin.settings.hasNotTagsList = $( plugin.settings.tagsSelector + ':not([' + plugin.settings.dataTags + '^="' + plugin.settings.inputVal + '"])');
            	plugin.settings.hasTagsList    = $( plugin.settings.tagsSelector + ':[' + plugin.settings.dataTags + '^="' + plugin.settings.inputVal + '"]');

            	debug( 'Tags non conforme : ' + plugin.settings.hasNotTagsList.length );
            	debug( 'Tags conforme : ' + plugin.settings.hasTagsList.length );

            	if(  plugin.settings.inputVal == '' ) {
            		resetDisplay();
            	}
            	else {
            		displayHasTagsList();
            		displayHasNotTagsList();	
            	}

            });
        }
    	
    	var debug = function( text ) {
    		( plugin.settings.debug == true ) ? console.info( text ) : null ;
    	}
    	
    	var resetDisplay = function() {
			debug('Display all tags');
    		plugin.settings.tagsList.show();
    	}
    	
    	var displayHasTagsList = function() {
        	$.each( plugin.settings.hasTagsList,function() {
            	plugin.settings.hasTagsList.show();
            });
    	}
    	
    	var displayHasNotTagsList = function() {
        	$.each( plugin.settings.hasNotTagsList,function() {
            	plugin.settings.hasNotTagsList.hide();
            });
    	}

		/*
		 * Debug
		 */
    	var debug = function( text ) {
    		// Verifie que ce n'est pas internet explorer
    		if( (window['console'] !== undefined) ){
    			( plugin.settings.debug == true ) ? console.info( text ) : null ;
    		}
    	}

        init();
    	
    }

})(jQuery);