<?php header('Content-type: application/javascript'); ?>
<?php
chdir('..');
chdir('..');
include('autoload.php');
include( 'helpers/const.define.php');
?>
<!--
	var fileCss=document.createElement("link");
	fileCss.setAttribute("rel", "stylesheet");
	fileCss.setAttribute("type", "text/css");
	fileCss.setAttribute("href", "<?php echo ROOT_CSS; ?>style-public.css");
	document.getElementsByTagName("head")[0].appendChild(fileCss);

	var submitForm=document.createElement('div');
	submitForm.setAttribute('id','bookmarkContainer');

	document.getElementsByTagName('body')[0].appendChild( submitForm );

	document.getElementById('bookmarkContainer').innerHTML = "<h1>Add this <span><a href=\"#\" title=\"close me\" onclick=\"var mynode = document.getElementById(\'bookmarkContainer\');var parent = mynode.parentNode;parent.removeChild(mynode);return false;\">close</a></span></h1><form id=\"bookmarkForm\" name=\"bookmarkForm\" method=\"post\" enctype=\"application/x-www-form-urlencoded\" action=\"<?php echo ROOT_AJAX; ?>\"><label id=\"labelCategories\">Categories : <br><select id=\"selectCategories\" name=\"selectCategories\"></select></label><label id=\"labelUrl\">URL : <br><input id=\"url\" disabled=\"disabled\" name=\"url\" value=\"<?php echo $_GET['url']; ?>\" type=\"text\"></label><label id=\"labelTitle\">Title : <br><input id=\"title\" name=\"title\" value=\"<?php echo $_GET['title'] ?>\" type=\"text\"></label><label id=\"labelTags\">Tags : <br></label><label id=\"labelDesc\">Desc : <br></label><hr><a id=\"save\" href=\"#\" title=\"Save it!\" class=\"bookmarker\" onclick=\"saveContent();return false;\">Save</a><hr><div class=\"copyright\">Powered by <a href=\"#\" title=\"Try me i\'m free !\">My.bookmarks<span><span>&nbsp;</span>Don\'t let your datas in the wild, you can host them with My.bookmarks which is free and open source PHP5 application, try it !</span></a>.</div></form>";

	<?php
		$categoriesJavascript = "";
		$categories = $sql->query('SELECT * FROM `categories`');
		while ($row = mysql_fetch_assoc( $categories )) {
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
	var selectElmt = document.getElementById('selectCategories');
	var idCat = selectElmt.options[selectElmt.selectedIndex].value;

	var jsScript=document.createElement('script');
	jsScript.setAttribute('type','text/javascript');
	jsScript.setAttribute('src', '<?php echo ROOT_AJAX; ?>bookmark-save.php?url='+encodeURIComponent(location.href)+'&title='+encodeURIComponent(getTitle.value)+'&tags='+encodeURIComponent(getTags.value)+'&desc='+encodeURIComponent(getDesc.value)+'&id='+encodeURIComponent(idCat) );
	document.getElementsByTagName('head')[0].appendChild(jsScript);
}
//-->
