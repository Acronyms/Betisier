	<h1>Valider une citation</h1>

<?php
$db = new Mypdo();
$managerC = new CitationManager($db);
$managerP = new PersonneManager($db);

if(!$managerP->isAdminId($_SESSION['id'])) //il faut etre administrateur pour valider une citation
{?>
  <img src="image/erreur.png" alt="Erreur" /> Seul les <b>administrateurs</b> ont le droit de valider une citation <br/><br/>
  <a href="index.php?page=2" class="bouton">Retour aux citations</a><?php
}
else {
  $managerC->validerCitation($_SESSION['id'], $_GET['citation'], date("Y\-m\-d"));?>
	
	<!-- message de confirmation -->
  <img src="image/valid.png" alt="ImageValide" /> La citation a bien été validée !<?php
}


?>
