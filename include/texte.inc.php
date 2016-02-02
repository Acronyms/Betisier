		<div id="texte">
<?php
if (!empty($_GET["page"]))
{
	$db = new Mypdo();
	$managerP = new PersonneManager($db);
	if($_GET["page"]>=50 && !isset($_SESSION['pseudo'])) //utilisateur non connecté et page>49
	{
		$page=0;
	}
	else if($_GET["page"]>99 && !$managerP->isAdminId($_SESSION['id'])) //utilisateur connecté NON ADMIN et page>99
	{
		$page=0;
	}
	else //ADMIN
	{
		$page=$_GET["page"];
	}
}
else
{
	$page=0;
}

switch ($page) {

case 0:
	// inclure ici la page accueil photo
	include_once('pages/accueil.inc.php');
	break;

//
// PAGES 1 - 49
// Pages accessibles hors-connexion
//

//lister
case 1:
	include_once('pages/personne/listerPersonnes.inc.php');
	break;

case 2:
	include_once('pages/citation/listerCitation.inc.php');
	break;

case 3:
	include_once('pages/ville/listerVilles.inc.php');
	break;

//connexion
case 5:
	include_once('pages/utilisateur/connexion.inc.php');
	break;

case 15:
	include_once('pages/utilisateur/verifConnexion.inc.php');
	break;


//PAGE 50
//Page de deconnexion
case 50:
	include_once('pages/utilisateur/deconnexion.inc.php');
	break;


//
// PAGES 51 - 99
// Pages accessibles en étant connecté NON ADMIN
//

//ajouter 51 - 59
case 51:
	include_once("pages/personne/ajouterPersonne.inc.php");
    break;

case 52:
	include_once("pages/citation/ajouterCitation.inc.php");
    break;

case 53:
	include_once('pages/ville/ajouterVille.inc.php');
    break;

case 55:
	include_once("pages/personne/verifAjouterPersonne.inc.php");
	  break;

case 56:
	include_once("pages/personne/etudiant/ajoutEtudiant.inc.php");
	break;

case 57:
	include_once("pages/personne/salarie/ajoutSalarie.inc.php");
	break;

case 58:
	include_once("pages/ville/verifAjouterVille.inc.php");
  break;

//rechercher 60 - 69
case 60:
	include_once("pages/citation/rechercherCitation.inc.php");
	break;

case 65:
	include_once("pages/citation/verifRechercherCitation.inc.php");
	break;

//modifier 70 - 80(HORS ADMIN)
case 70:
	include_once("pages/ville/modifierVille.inc.php");
	break;

case 75:
	include_once("pages/ville/verifModifierVille.inc.php");
	break;

//voter 80-89
case 80:
	include_once("pages/citation/voterCitation.inc.php");
	break;

case 85:
	include_once("pages/citation/verifVoterCitation.inc.php");
	break;

//
// PAGES 100 - 150
// Pages accessibles par les administrateurs
//

//modifier 100 - 109 (ADMIN)
case 100:
	include_once("pages/personne/listerPersonneModification.inc.php");
	break;

case 105:
	include_once("pages/personne/modifierPersonne.inc.php");
	break;

case 106:
	include_once("pages/personne/verifModifierPersonne.inc.php");
	break;

case 107:
	include_once("pages/personne/etudiant/modifierEtudiant.inc.php");
	break;

case 108:
	include_once("pages/personne/salarie/modifierSalarie.inc.php");
	break;
//valider	110 - 119
case 110:
	include_once("pages/citation/validerCitation.inc.php");
	break;

case 115:
	include_once("pages/citation/verifValiderCitation.inc.php");
	break;

//supprimer 120 - 129
case 120:
	include_once("pages/personne/supprimerPersonne.inc.php");
	break;

case 121:
	include_once("pages/citation/supprimerCitation.inc.php");
	break;

case 122:
	include_once("pages/ville/supprimerVille.inc.php");
	break;

case 125:
	include_once("pages/personne/verifSupprimerPersonne.inc.php");
	break;

case 126:
	include_once("pages/citation/verifSupprimerCitation.inc.php");
	break;

case 127:
	include_once("pages/ville/verifSupprimerVille.inc.php");
	break;


default :
	include_once('pages/accueil.inc.php');
}

?>
		</div>
