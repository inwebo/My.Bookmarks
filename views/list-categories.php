<?php
extract( $GLOBALS );
$_SESSION['list-categories']->rewind();
while( $_SESSION['list-categories']->valid() ) {
?>
<li data-id="<?php echo $_SESSION['list-categories']->current()->id ?>" class="categorie-droppable">
	<a href="<?php echo PATH_INDEX; ?>categorie/<?php echo $_SESSION['list-categories']->current()->name ?>/<?php echo $_SESSION['list-categories']->current()->id ?>"
		title="Category <?php echo $_SESSION['list-categories']->current()->name ?>">
		<?php echo $_SESSION['list-categories']->current()->name ?></a>
</li>
<?php
	$_SESSION['list-categories']->next();	
}
?>