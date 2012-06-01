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

	$.myCategorie = function(options) {

		// Arguments
		var defaults = {
			// Affiche dans la console de firebug le déroulement du processus
			debug : true,
			currentNode:null
		}

		var plugin = this;

		plugin.settings = {}

		/*
		 * Constructeur de l'objet
		 */
		var init = function() {
			// Construction des attributs
			plugin.settings               = $.extend({}, defaults, options);
            plugin.settings.pluginName    = 'MyCategorie';
            plugin.settings.pluginVersion = '05-2012';
            plugin.settings.id            = $(plugin.settings.currentNode).attr('data-id');
			plugin.settings.name          = $(plugin.settings.currentNode).attr('data-name');
		}
		
		plugin.deleteCat = function() {
			
            var i = confirm('Delete categorie : ['+plugin.settings.id+']' + plugin.settings.name + '?'+"\n");
            if(i==true) {
                $.ajax({
                    type: "POST",
                    url: JS_PATH_AJAX_CATEGORIE_DEL,
                    data: {
                        delCat: plugin.settings.id
                    },
                    dataType: "text",
                    beforeSend:function() {
                    },
                    success:function(data) {
                    	$(plugin.settings.currentNode).effect('blind',function(){
                    		$(this).remove();
                    	});
                    	//
                    },
                    error:function() {

                    }
                })
            }
            
		}
		

		plugin.createCat = function() {
			var newCatVal = $('#newCat').val();
			console.log('###');
			// #1 : Requet ajax SQL
			$.ajax({
				type : "POST",
				url : JS_PATH_AJAX_CATEGORIE_ADD,
				data : "inputCat=" + newCatVal,
				dataType : "text",
				success : function(data) {
					if (data != "FALSE") {
						console.log('2');
						newCatId = data;
						pluginNotifications.msg('Addefd', newCatVal);

						$.ajax({
							type : "POST",
							url : JS_PATH_AJAX_CATEGORIE_SORTABLE_EMPTY_PATTERN,
							dataType : "text",
							success : function(data) {
								var $pattern = $(data);
								$pattern.attr('data-id', newCatId);
								$pattern.attr('data-name', newCatVal);
								$pattern.children('.oneCatName').html(newCatVal);
								$('#sortable').append($pattern);
								window.pluginCategoriesHandler.upDateGrid();
								console.log('3');
								
							},
							error : function() {
							}
						});

					} else {
						console.log('elsez');
						// Exists déjà
						//pluginNotifications.msg('warning','Categorie already exists');
					}
					$('#inputCat').val('');
				},
				error : function() {
				}
			});
		}
		
		plugin.editCat = function() {
                $.ajax({
                    type: "POST",
                    url: JS_PATH_AJAX_CATEGORIE_EDIT_FORM,
                    data: {
                        editId: plugin.settings.id,
                        publicKey: JS_PUBLIC_KEY,
                        editName: plugin.settings.name
                    },
                    dataType: "text",
                    beforeSend:function() {
                    },
                    success:function(data) {
                    	$('.gui-display-shaddy').before(data).show();
                    	$('#categorieContainer').show();
                    	$('#categorie-edit-save').die( 'click' ).live( 'click', function(){
							$.ajax({
			                    type: "POST",
			                    url: JS_PATH_AJAX_CATEGORIE_EDIT,
			                    data: {
			                        editId: plugin.settings.id,
									publicKey: JS_PUBLIC_KEY,
			                        editName: $('#title').val()
			                    },
			                    dataType: "text",
			                    beforeSend:function() {
			                    },
			                    success:function(data) {
									$('#categorieContainer').hide();
									$('.gui-display-shaddy').hide();									
									$(plugin.settings.currentNode).find( 'span.oneCatName' ).html( $('#title').val() );
									console.log('nom changé');
									$( '#categorieContainer' ).remove();
			                    },
			                    error:function() {
			
			                    }
			                })      
                    	});
                    	
                    },
                    error:function() {

                    }
                })        
		}
		
		/*
		 * Modifie les attributs de l objet
		 */
		plugin.setters = function ( options ) {
			plugin.settings = $.extend( plugin.settings, options );
			
		}
		
		/*
		 * Debug nécessite le support de console.info()
		 */
		var debug = function( text ) {
			// Verifie que ce n'est pas internet explorer
			if( ( window['console'] !== undefined ) ) {
				( plugin.settings.debug == true ) ? console.info( text ) : null;
			}
		}
		
		// Construteur
		init();
		
	}
})(jQuery);
