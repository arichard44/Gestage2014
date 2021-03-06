<?php

/**
 * Description of C_AdminPersonnes
 * CRUD Personnes
 * @author btssio
 */
class C_AdminPersonnes extends C_ControleurGenerique {

    // Fonction d'affichage du formulaire de création d'une personne
    function creerPersonne() {
        $this->vue = new V_Vue("../vues/templates/template.inc.php");
        $this->vue->ecrireDonnee('titreVue', 'Cr&eacute;ation d\'une personne');
        // ... depuis la BDD       
        $daoPers = new M_DaoPersonne();
        $daoPers->connecter();
        $pdo = $daoPers->getPdo();

        // Mémoriser la liste des spécialités disponibles
        $daoSpecialite = new M_DaoSpecialite();
        $daoSpecialite->setPdo($pdo);
        $this->vue->ecrireDonnee('lesSpecialites', $daoSpecialite->getAll());

        // Mémoriser la liste des rôles disponibles
        $daoRole = new M_DaoRole();
        $daoRole->setPdo($pdo);
        $this->vue->ecrireDonnee('lesRoles', $daoRole->getAll());

        $this->vue->ecrireDonnee('loginAuthentification', MaSession::get('login'));
        $this->vue->ecrireDonnee('centre', "../vues/includes/adminPersonnes/centreCreerPersonne.inc.php");

        $this->vue->afficher();
    }

    //validation de création d'utilisateur 
    function validationcreerPersonne() {
        $this->vue = new V_Vue("../vues/templates/template.inc.php");
        $this->vue->ecrireDonnee('titreVue', "Validation de la création d'une personne");

        $idRole = $_POST['role'];

        $role = new M_Role(null, null, null);

        $daoRole = new M_DaoRole();
        $daoRole->connecter();
        $pdo = $daoRole->getPdo();
        $role = $daoRole->selectOne($idRole);
        //* récupération de toutes les données en rapport avec l'ID du rôle choisi dans la page de création d'une personne

        $civilite = $_POST['civilite'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $mail = $_POST['mail'];
        $numTel = $_POST['tel'];
        $mobile = $_POST['telP'];
        $etudes = $_POST['etudes'];
        $formation = $_POST['formation'];

        $login = $_POST['login'];
        $mdp = sha1($_POST['mdp']);

        $specialite = new M_Specialite(null, null, null);

        $idSpecialite = $_POST['option'];

        $daoSpecialite = new M_DaoSpecialite();
        $daoSpecialite->connecter();
        $pdo = $daoSpecialite->getPdo();
        $specialite = $daoSpecialite->selectOne($idSpecialite);
        //* récupération de toutes les données en rapport avec l'ID de la spécialité choisie dans la page de création d'une personne


        $unePersonne = new M_Personne(null, $specialite, $role, $civilite, $nom, $prenom, $numTel, $mail, $mobile, $etudes, $formation, $login, $mdp);


        $daoPers = new M_DaoPersonne();
        $daoPers->connecter();
        $pdo = $daoPers->getPdo();
        $daoPers->insert($unePersonne);

        if ($daoPers) {
            $this->vue->ecrireDonnee('centre', "../vues/includes/utilisateur/centreValiderCreationPersonne.php");
        }
        
        $this->vue->ecrireDonnee('loginAuthentification', MaSession::get('login'));
        $this->vue->afficher();
    }

}
