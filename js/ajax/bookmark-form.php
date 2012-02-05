<?php header('Content-type: application/javascript'); ?>
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
<?php
chdir('..');
chdir('..');
include('autoload.php');
include( 'helpers/const.define.php');

if( 
        ( count($_GET)== 0 ) ||
        !isset($_GET['JS_PUBLIC_KEY']) ||
        !isset($_GET['url']) ||
        !isset($_GET['title']) ||
        !isset($_GET['tags']) ||
        !isset($_GET['favicon']) ||
        !isset($_GET['desc']) 
  ){
    exit('Error GET');
}

if( $_GET['JS_PUBLIC_KEY'] != PUBLIC_KEY ) {
    exit('Error');
}

?>
<!--
	var fileCss=document.createElement("link");
	fileCss.setAttribute("rel", "stylesheet");
	fileCss.setAttribute("type", "text/css");
	fileCss.setAttribute("href", "<?php echo PATH_CSS; ?>style-public.css");
	document.getElementsByTagName("head")[0].appendChild(fileCss);

	var submitForm=document.createElement('div');
	submitForm.setAttribute('id','bookmarkContainer');

	document.getElementsByTagName('body')[0].appendChild( submitForm );

	document.getElementById('bookmarkContainer').innerHTML = "<h1>Add this <span><a href=\"#\" title=\"close me\" onclick=\"var mynode = document.getElementById(\'bookmarkContainer\');var parent = mynode.parentNode;parent.removeChild(mynode);return false;\">close</a></span></h1><form id=\"bookmarkForm\" name=\"bookmarkForm\" method=\"post\" enctype=\"application/x-www-form-urlencoded\" action=\"<?php echo PATH_AJAX; ?>\"><label id=\"labelCategories\">Categories : <br><select id=\"selectCategories\" name=\"selectCategories\"></select></label><label id=\"labelUrl\">URL : <br><input id=\"url\" disabled=\"disabled\" name=\"url\" value=\"<?php echo $_GET['url']; ?>\" type=\"text\"></label><label id=\"labelTitle\">Title : <br><input id=\"title\" name=\"title\" value=\"<?php echo $_GET['title'] ?>\" type=\"text\"></label><label id=\"labelTags\">Tags : <br></label><label id=\"labelDesc\">Desc : <br></label><label id=\"labelPublic\">Public : <input type=\"checkbox\" name=\"public\" id=\"public\"></label><hr><a id=\"save\" href=\"#\" title=\"Save it!\" class=\"bookmarker\" onclick=\"saveContent();return false;\">Save</a><hr><div class=\"copyright\">Powered by <a href=\"#\" title=\"Try me i\'m free !\">My.bookmarks<span><span>&nbsp;</span>Don\'t let your datas in the wild, you can host them with My.bookmarks which is free and open source PHP5 application, try it !</span></a>.</div></form>";

	<?php
		$categoriesJavascript = "";
		$categories = $sql->query('SELECT * FROM `'. DB_TABLE_PREFIX .'categories`');
		//while ($row = mysql_fetch_assoc( $categories )) {
		foreach ( $categories as $row) {
		$categoriesJavascript .= "
			var elOptNew = document.createElement('option');
			elOptNew.text = '".$row['name']."';
			elOptNew.value = '".$row['id']."';
			var elSel = document.getElementById('selectCategories');

			try {
				elSel.add(elOptNew, null); // standards compliant; doesn't work in IE
			}
			catch(ex) {
				elSel.add(elOptNew); // IE only
			}
		";
		}
		echo $categoriesJavascript;
	?>
        //var newFav = document.createElement('img');
        //newFav.setAttribute('src','<?php echo $_GET['favicon'];?>');
        var newFav = document.getElementById('url');
        newFav.setAttribute( 'style','background-image: url(<?php echo $_GET['favicon'];?>);' );

	var newTags = document.createElement('input');
	newTags.setAttribute('id','tags');
	newTags.setAttribute('name','tags');
	newTags.setAttribute('type','text');
	newTags.setAttribute('value','<?php echo str_replace(',','',str_replace("\"", "", str_replace('\'','',$_GET['tags']))); ?>');
	document.getElementById('labelTags').appendChild( newTags );

	var newDesc = document.createElement('textarea');
	newDesc.setAttribute('id','desc');
	newDesc.setAttribute('name','desc');
	newDesc.setAttribute('rows','5');
	newDesc.setAttribute('cols','40');

	document.getElementById('labelDesc').appendChild( newDesc );
	document.getElementById('desc').value= '<?php echo str_replace("\"", "", str_replace('\'','',$_GET['desc'])); ?>';


function saveContent() {
	var getTags = document.getElementById('tags');
	var getDesc = document.getElementById('desc');
	var getTitle = document.getElementById('title');

	var getPublic = document.getElementById('public').checked ;
        ( getPublic == true ) ? getPublic = 1 : getPublic =0 ;

	var selectElmt = document.getElementById('selectCategories');
	var idCat = selectElmt.options[selectElmt.selectedIndex].value;

	var jsScript=document.createElement('script');
	jsScript.setAttribute('type','text/javascript');
	jsScript.setAttribute('src', '<?php echo PATH_AJAX; ?>bookmark-save.php?JS_PUBLIC_KEY=<?php echo $_GET['JS_PUBLIC_KEY']; ?>&url='+encodeURIComponent(location.href)+'&title='+encodeURIComponent(getTitle.value)+'&tags='+encodeURIComponent(getTags.value)+'&desc='+encodeURIComponent(getDesc.value)+'&id='+encodeURIComponent(idCat)+'&public='+encodeURIComponent(getPublic)+'&favicon='+document.domain );
	document.getElementsByTagName('head')[0].appendChild(jsScript);
}
//-->
