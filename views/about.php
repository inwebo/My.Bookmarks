<!-- About -->
<div class="grid_12 about">

    <ul id="sommaire">
        <li><a href="#Presentation">Présentation</a></li>
        <li><a href="#Telechargements">Téléchargements</a></li>
        <li><a href="#Installation">Installation</a></li>
        <li><a href="#Setup">Setup</a></li>
        <li><a href="#Readme">Readme</a></li>
        <li><a href="#Faq">FAQ</a></li>
        <li><a href="#Todo">Todo</a></li>
        <li><a href="#Technique">Technique</a></li>
        <li><a href="#Demo">Démo</a></li>
        <li><a href="#Licence">Licence</a></li>

    </ul>
    <a name="Presentation"></a>
    <h2>Gardez vos données</h2>
    <p>
        My.Bookmarks est une application PHP5 permettant la sauvegarde de vos sites
        favoris sur internet.
    </p>
    <p>
        Si comme moi vous :
    </p>
    <ul>
        <li>Utilisez plusieurs postes différents dans une journée.</li>
        <li>Jonglez avec plusieurs navigateurs.</li>
        <li>Perdez vos favoris suite à un formatage de disque dur. (la lose je sais).</li>
        <li>Souhaitez partager vos dernières découvertes avec vos amis.</li>
        <li>Voulez rester maitre de vos données.</li>
    </ul>
    <p>
        My.Bookmarks est fait pour vous (pour moi en tout cas). Grâce à un simple widget ( un composant d'in-
        -terface graphique), déposé dans votre barre de favoris (CTRL+B dans
        firefox pour l'afficher), vous pouvez enregistrer la page que vous êtes en train
        de visualiser directement sur votre espace web.
    </p>
    <p>
        Le logiciel va extraire :
    </p>
    <ul>
        <li>L'url courant</li>
        <li>Le titre de la page en cours</li>
        <li> Les mots clefs associés (balise meta)</li>
        <li>La description associée (balise meta)</li>
    </ul>
    <p>
        Libre à vous bien sûr d'éditer toutes ces informations si elles ne vous sembles
        pas pertinentes.
    </p>
    <p>
Il est vrai qu'il existe déjà des services comparables : xmark, firefox sync...
Services gratuits le plus souvent, mais si une de ces sociétés ou association
ferme, que vont devenir vos données ? Le meilleur exemple est la fermeture soudaine de megaupload en ce début d'année 2012.
Le plus sage serait <strong>l'autonomie</strong> !
    </p>
    <a name="Telechargements"></a>
    <h2>Téléchargements</h2>
    <dd>
        <dl>La version la plus à jour se trouve sur Github.<dt><a href="https://github.com/inwebo/My.Bookmarks">https://github.com/inwebo/My.Bookmarks</a></dt></dl>
        <dl>La dernière version stable :<dt><a href="http://bookmarks.inwebo.net/download/my.bookmarks.zip">version 01-02-2012</a></dt></dl>
    </dd>
    <a name="Installation"></a>
    <h2>Installation</h2>
    <ol>
        <li>Décompression de l'archive dans sur votre serveur</li>
        <li>Configuration de l'application</li>
        <li>Déposer le widget dans votre barre personnelle</li>
        <li>Enjoy</li>
    </ol>
    <a name="Setup"></a>
    <h2>Setup</h2>
    <p>
        Détail à faire
    </p>
    <a name="Readme"></a>
    <h2>Readme</h2>
    <p>
        Un fichier <a href="<?php echo PATH_ROOT ?>README">readme</a> est disponible pour un lecture hors-ligne.
    </p>
    <a name="Faq"></a>
    <h2>Foire aux questions</h2>
    <dd>
    <dl>
        Q : Comment remettre à zéro ma configuration de site sans perdre mes données ?<dt>R : Supprimer simplement config.ini se situant dans config/config.ini</dt>
    </dl>
    <dl>Q : Comment mettre à jour ma version de my.bookmarks ?<dt> R : Supprimer tous les fichiers contenu dans votre dossier d'installation.</dt></dl>
    <dl>Q : J'ai perdu mon mot de passe que faire ?<dt> R : Il faut vous rendre dans Php my admin dans la table users, éditer le champs `password` avec le md5 de votre nouveau mot de passe.</dt></dl>
    <dl>Q : J'ai une page blanche ou une erreur 503 ?<dt>R : N'oubliez pas d'activer PHP 5.3 dans le .htaccess à la racine de votre site</dt>
        <pre>
            Pour ovh :
            SetEnv PHP_VER 5_3
        </pre>
    </dl>
    <a name="Todo"></a>
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
    <a name="Technique"></a>
    <h2>Aspect technique</h2>
    <p>
        <img src="<?php echo PATH_IMG.'system/dinosaures.jpg'; ?>"> My.Bookmarks est
        une application riche ! Elle nécessite donc un navigateur moderne ainsi qu'un
        serveur digne de ce nom. Ainsi Internet Explorer n'est pas supporté (et ne le
        sera probablement jamais). La compatibilité avec l'hébergeur free.fr est terminée.
        
    </p>
    <div class="clear"></div>
    <p>
        My Bookmarks utilise l'ensemble de ces outils :
    </p>
    <ul>
        <li>PHP 5.3</li>
        <li>jQuery 1.6.4</li>
        <li>jQuery-ui 1.8.16</li>
        <li>MySQL 5</li>
        <li>HTML5 / CSS3<ul><li>Firefox 6+</li><li>Opera 11.52+</li><li>Chromium 14+</li></ul></li>
        <li>Boilerplate</li>
        <li>960 grid system</li>
        <li>GitHub</li>
        <li>Approche MVC</li>
    </ul>
    <a name="Demo"></a>
    <h2>Démo</h2>
    <p>
        <a href="http://bookmarks.inwebo.net/" alt="Page de démonstratiob">Une démonstration en ligne est dispo</a>
    </p>
    <a name="Licence"></a>
    <h2>Licence</h2>
    <p>
        <a href="http://creativecommons.org/licenses/by-nc-sa/2.0/fr/">Creative commons 2.0</a>
    </p>
</div>
<!-- About -->