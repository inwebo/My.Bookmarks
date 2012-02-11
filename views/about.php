<?php
extract( $GLOBALS );
?>
<!-- About -->
<div class="grid_4" >
    <a href="http://creativecommons.org/licenses/by-nc-sa/2.0/fr/"><img src="<?php echo PATH_IMG; ?>/system/cc.large.png" style="width: 278px; height: 259px;"></a>
</div>
<div class="grid_4 grid-download">
    <h3>About</h3>
    <p>
        My.Bookmarks permet de sauvegarder facilement vos sites favoris sur votre propre serveur, grâce à un seul bouton à déposer dans votre navigateur.Ne laissez pas vos données dans la nature, elles vous appartiennent ! L'affaire megaupload nous l'a bien rapellée.J'ai développé cette application dans un esprit d'<strong>indépendance</strong> (oui cela comme <em>aussi</em> par là).
        Un <a href="https://github.com/inwebo/My.Bookmarks/wiki" title="Need help ?">wiki</a> est disponible pour de plus amples informations. Ainsi qu'un <a href="https://github.com/inwebo/My.Bookmarks/issues">bug tracker</a>.
    </p>
    
    <hr>
    <div><a href="#" class="myButton">Download</a></div>
</div>
<div class="grid_4  grid-github">
        <p class="github-rollover">
            Meow ! Fork me i'm famous
        </p>
        <a href="https://github.com/inwebo/My.Bookmarks" target="_blank" title="miaou"><img src="<?php echo PATH_IMG; ?>/system/github-logo.png" style="width: 278px; height: 259px;"></a>
</div>

<div class="grid_12 about">
    <h2>Todo</h2>
    <ul>
        <?
            $todo = new MyLog('config/todolist');
            $rows = $todo->getBuffer();
            foreach( $rows as $value ) {
                if($value[0] == '-') {
                    $value = substr($value,1);
                    echo '<li><del>'.$value.'</del></li>';
                }
                else {
                    $value = substr($value,1);
                    echo '<li>'.$value.'</li>';
                }
            }
        ?>
    </ul>
</div>
<!-- About -->