<?php
extract( $GLOBALS );
?>
<?php
    $allCategories = $sql->query('SELECT `id`, `name` FROM `' . DB_TABLE_PREFIX . 'categories` WHERE `id` !=2 ');
?>
<!-- About -->

<div class="grid_12">
    <h2>Admin</h2>
    <div id="vtab">
        <ul class="tabs-left">
            <li class="home">Site configuration</li>
            <li class="login">Categories</li>
            <li class="support">Corbeille</li>
            <li class="journaux">Journaux</li>
            <li class="Constantes">Constantes</li>
        </ul>
        
        <div class="tabs-content">
            <div>

                <?php
                    $template->display('configuration');
                ?>
            </div>
            <div>
                <h3>Categories weight</h3>
                <ul id="sortable">
                    <?php  foreach( $allCategories as $value ) { ?>
                        <li data-weight="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></li>
                    <?php } ?>
                </ul>
                <a id="categories-weigth-save" href="#">Save</a>
            </div>
            <div>
                <h3>Corbeille</h3>
                SUPPORT CONTENT
            </div>
            <div>
                <h3>Journaux</h3>
                SUPPORT CONTENT
            </div>
            <div>
                <h3>Constantes</h3>
                <code>
                    <?php
                        $constantes = get_defined_constants(true);
                        $constantes = $constantes['user'];
                        foreach ($constantes as $key => $value) {
                            echo '<strong>'.$key . '</strong> : ' . $value . '<br>';
                        }
                    ?>
                </code>
            </div>
        </div>
    </div>

</div>
<div class="grid_12">
    <h2>SPL collection</h2>
    <code>
        <pre>
            <?php
                $factory = new FactoryCategories( $sql );
                $a= $factory->getCategorieById( '2' );
                //var_dump($a);
            ?>
        </pre>
    </code>
    <hr>
    <code>
        <pre>
            <?php
                //var_dump($factory);
            ?>
        </pre>
    </code>
    <a id="categories-weigth-save" href="#">Save</a>
</div>
<!-- About -->