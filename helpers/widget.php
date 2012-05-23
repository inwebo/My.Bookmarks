<?php
/**
 * My Bookmarks
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
 * @category  My.Bookmarks
 * @package   Base
 * @copyright Copyright (c) 2005-2011 Inwebo (http://www.inwebo.net)
 * @author    Julien Hannotin
 * @license   http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
 * @version   $Id:$
 * @link      https://github.com/inwebo/My.Bookmarks
 * @since     File available since Beta 28-11-2011
 */
?>

<a href="
javascript:(function(){

	var description;
	var keywords;

var favicon = document.evaluate('//*[contains(@rel,\'shortcut icon\')]', document, null, XPathResult.ORDERED_NODE_SNAPSHOT_TYPE, null);

        if( favicon.snapshotLength == 0 ) {
            favicon ='empty';
        }
        else {
            favicon=favicon.snapshotItem(0).getAttribute('href') ;
        }
	var metas = document.getElementsByTagName('meta');
	for (var x=0,y=metas.length; x<y; x++) {
	  if (metas[x].name.toLowerCase() == 'description') {
		description = metas[x];
	  }
	  if (metas[x].name.toLowerCase() == 'keywords') {
		keywords = metas[x];
	  }
	}

	if( typeof(description) == 'undefined' ) {
		var description = document.createElement('p');
		description.content = 'empty';
	}

	if( typeof(keywords) == 'undefined' ) {
		var keywords = document.createElement('p');
		keywords.content = 'empty';
	}

	var jsScript=document.createElement('script');
	jsScript.setAttribute('type','text/javascript');
	jsScript.setAttribute('src', '<?php echo PATH_BOOKMARK_FORM; ?>?url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(document.title) +'&amp;tags=' + keywords.content +'&amp;desc=' + description.content +'&amp;favicon='+ encodeURIComponent(favicon) + '&amp;JS_PUBLIC_KEY=<?php echo PUBLIC_KEY; ?>' );
	document.getElementsByTagName('head')[0].appendChild(jsScript);



})();


" class="myButton myButtonHeadline">&hearts; this !</a>
