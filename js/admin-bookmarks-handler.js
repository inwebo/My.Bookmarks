;(function($) {

	/*
	* Variables
	*/
	// Draggable selector
	var draggableSelector = '.bookmark-draggable';
	// Droppable selector
	var droppableSelector = '.categorie-droppable';
	// Container droppable
	var droppableContainer = '#categories-landing';
	// Delai pour cacher le container droppable
	var delayDroppableContainer = 1000;

	/* 
	 * Affiche/cache le container contenant tous les éléments droppable
	 */
	var displayDroppableContainer = function() {
		$(droppableContainer).animate({
			'top' : 50
		}, 800, 'easeOutQuint');
		
		$('h1 span').animate({
			'margin-top' : -10
		}, 800, 'easeOutQuint');
	}
	var hideDroppableContainer = function() {
		$(droppableContainer).delay(delayDroppableContainer).animate({
			'top' : -140
		}, 800, 'easeOutQuint');
		
		$('h1 span').delay(delayDroppableContainer).animate({
			'margin-top' : 0
		}, 800, 'easeOutQuint');
	}
	/*
	 * Collecte tous les attributs-data d'un bookmark
	 */
	var getAttrData = function(el) {
		
		objBookmark = new $.myBookmark({
			'debug'       : JS_APP_DEBUG,
			'id'          : $(el).closest('.oneBookmark').attr('data-id'),
			'hash'        : $(el).closest('.oneBookmark').attr('data-hash'),
			'url'         : $(el).closest('.oneBookmark').attr('data-url'),
			'title'       : $(el).closest('.oneBookmark').find('.data-title').html(),
			'tags'        : $(el).closest('.oneBookmark').attr('data-tags'),
			'description' : $(el).closest('.oneBookmark').find('.data-desc').html(),
			'dt'          : $(el).closest('.oneBookmark').attr('data-dt'),
			'category'    : $(el).closest('.oneBookmark').attr('data-category'),
			'visibility'  : $(el).closest('.oneBookmark').attr('data-visibility')
			
		});
		return objBookmark;
	}
	/* ============= Bookmark switch categorie =============== */

	/*
	 * Draggable
	 */
	$(draggableSelector).draggable({
		opacity : 1,
		helper : function(event) {
			return $("<div class='bookmark-draggable-helper'><span class='iconic move'></span></div>");
		},
		start : function(event, ui) {
			displayDroppableContainer();
			actualBookmark = getAttrData($(this));
		},
		stop : function(event, ui) {
			hideDroppableContainer();
			actualBookmark = null;
		},
		revert : 'invalid'
	});

	/*
	 * Droppable
	 */
	$(droppableSelector).droppable({
		over : function(event, ui) {
			// A voir
		},
		out : function(event, ui) {
			// A voir
		},
		drop : function(event, ui) {
			var tempNewId = $(this).attr('data-id');
			var hash = actualBookmark.settings.hash
			// Requete ajax
			$.ajax({
				type : "POST",
				url : JS_PATH_AJAX_BOOKMARK_SWITCH,
				data : {
					itemHash : actualBookmark.settings.hash,
					itemId : tempNewId
				},
				dataType : "text",
				success : function(data) {
					window.pluginBookmarksHandler.switchBookmark(hash, tempNewId);
				},
				error : function() {
				}
			});
		},
		accept : draggableSelector,
		greedy : false
	});

	/* ============= Bookmark switch categorie =============== */

	/* ============= Bookmark delete =============== */
	// Bouton supprimer
	var buttonDel = '.bookmark-delete';
	
	// @todo To refactor without unbind
	$(buttonDel).unbind('click').click(function() {
		var actualBookmark = getAttrData( $(this) );
		var r = confirm('Delete url (id=' + actualBookmark.settings.id + ') : ' + "\n" + '✗' + actualBookmark.settings.title + ' ?' + "\n");
		if(r == true) {
			$.ajax({
				type : "POST",
				url : JS_PATH_AJAX_BOOKMARK_DEL,
				data : {
					delUrl : actualBookmark.settings.id
				},
				success : function(data) {
					window.pluginBookmarksHandler.remove(actualBookmark.settings.id);
				},
				error : function() {

				}
			});
		}
		return false;
	});

	/* ============= /Bookmark delete =============== */

	/* =================== Bookmark Edit ============= */
	// Selecteur du formulaire
	var buttonEdit = '.bookmark-edit';
	$( buttonEdit ).unbind('click').click(function() {
		// #1 : Créer un bookmark valeur actuel
		var actualBookmark = getAttrData($(this));
		actualIndex = $(this).closest('.oneBookmark').index();
		console.log(actualIndex);
		
		$('.gui-display-shaddy').fadeIn('slow');
		// #2 : Inclure en ajax le formulaire avec les bonnes valeurs
		$.ajax({
			type : "POST",
			url : JS_PATH_AJAX_BOOKMARK_EDIT_FORM,
			data : {
				itemHash        : actualBookmark.settings.hash,
				itemTitle       : actualBookmark.settings.title,
				itemDescription : actualBookmark.settings.description,
				itemTags        : actualBookmark.settings.tags,
				itemCategoryId  : actualBookmark.settings.category,
				itemVisibility  : actualBookmark.settings.visibility,
				itemPublicKey   : JS_PUBLIC_KEY
			},
			dataType : "text",
			success : function(data) {
				$('.gui-display-shaddy').before(data);
			},
			error : function() {
			}
		});
		return false;
	});
	/* =================== Bookmark Edit ============= */
	
	/* =================== Bookmark Save ============= */
	// Selecteur du formulaire


		var buttonSave = '#bookmark-edit-save';
		var formEdit = '#bookmarkForm';
		// @todo public
		$(buttonSave).unbind('click').live('click', function() {
			console.log('Current index : ' + actualIndex);
			$.ajax({
				type : "POST",
				url : JS_PATH_AJAX_BOOKMARK_EDIT,
				data : {
					itemHash        : $('#hash').val(),
					itemTitle       : $('#title').val(),
					itemDescription : $('#desc').val(),
					itemTags        : $('#tags').val(),
					itemPublic      : $('#public').prop('checked'),
					itemPublicKey   : JS_PUBLIC_KEY
				},
				dataType : "text",
				success : function(data) {
					//$('.bookmarks-list li').eq(actualIndex).remove();
					actualIndex++;

					$(".bookmarks-list li:nth-child(" + actualIndex + ")").before( $( data ) ).remove();
					//$(".bookmarks-list li:nth-child(" + actualIndex+1 + ")").remove();
					$('.gui-display-shaddy').hide();
					$('#bookmarkContainer').remove();
					$.getScript(JS_PATH_JS + 'admin-bookmarks-handler.js');
				},
				error : function() {

				}
			});
		}); 

	/* =================== /Bookmark Save ============= */
	
	/* ================== Snippet reset form ========= */
	/*$.fn.reset = function () {
	  $(this).each (function() { this.reset(); });
	}*/
	/* ================== /Snippet reset form ========= */
	 
	/* Reset formulaire edition bookmark */
	var buttonReset = '#bookmark-edit-reset';
	var form        = '#bookmarkForm';
	$(buttonReset).live('click', function() {
		$( form ).each (function(){
		  this.reset();
		});
	});
	/* /Reset formulaire edition bookmark */
	
	/*
	 * Cache le formulaire d'edition d'un bookmark ainsi que
	 * le fond noir transparent
	 */
	$('.bookmark-close').live('click',function(){
		if( $('#bookmarkContainer') ) {
			$('#bookmarkContainer').remove();
			$('.gui-display-shaddy').toggle();
		}
	});
	
	
})(jQuery);
