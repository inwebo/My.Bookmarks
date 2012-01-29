<!-- About -->
<div class="grid_12">
    <h2>Gardez vos données</h2>
    <p>

    </p>
    <h2>Téléchargements</h2>
    <p>
        
    </p>
    <h2>Installation</h2>
    <p>
        
    </p>
    <h2>Setup</h2>
    <p>

    </p>
    <h2>Readme</h2>
    <p>
        Un fichier <a href="<?php echo ROOT ?>README">readme</a> est disponible pour un lecture hors-ligne.
    </p>
    <h2>Foire aux questions</h2>
    <p>
        Un fichier <a href="<?php echo ROOT ?>README">readme</a> est disponible pour un lecture hors-ligne.
    </p>
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
    <h2>Aspect technique</h2>
    <p>

    </p>
    <h2>Démo</h2>
    <p>

    </p>
    <h2>Licence</h2>
    <p>

    </p>
</div>
<!-- About -->