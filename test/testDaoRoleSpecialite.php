<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>test DaoRole et test DaoSpecialite</title>
    </head>
    <body>
        <?php
        require_once("../includes/parametres.inc.php");
        require_once("../includes/fonctions.inc.php");
        
        $dao = new M_DaoRole();
        $dao->connecter();
        
        // Role : test de sélection par Id 
        echo "<p>Role : test de sélection par Id</p>";
        $role = $dao->getOneById(4);
        var_dump($role);
        
        // Role : test de sélection de tous les enregistrements
        echo "<p>Role : test de sélection de tous les enregistrements</p>";
        $lesRoles = $dao->getAll();
        var_dump($lesRoles);
        
        // role : test de la selection par l'id d'un seul role
        echo "<p><u>Role : test select one </u></p>";
        $unRole = $dao->selectOne(4);
        var_dump($unRole);
        
        
        $dao = new M_DaoSpecialite();
        $dao->connecter();
        
        // Specialite : test de sélection par Id 
        echo "<p>Specialite : test de sélection par Id</p>";
        $spe = $dao->getOneById(2);
        var_dump($spe);
        
        // Specialite : test de sélection de tous les enregistrements
        echo "<p>Specialite : test de sélection de tous les enregistrements</p>";
        $lesSpes = $dao->getAll();
        var_dump($lesSpes);
        
        // Specialite : test de la selection par l'id d'une seule specialite
        echo '<p>Specilite : test select one</p>';
        $selection = $dao->selectOne(1);
        var_dump($selection);
        $dao->deconnecter();
        ?>
    </body>
</html>