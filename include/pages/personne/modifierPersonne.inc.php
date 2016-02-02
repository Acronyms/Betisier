<h1>Modifier une personne enregistrée</h1>
<?php
$db = new Mypdo();
$managerP = new PersonneManager($db);
$_SESSION['numPers']=$_GET['personne'];

if($managerP->isPersonne($_SESSION['numPers']))
{
  $personne=$managerP->getPersonneById($_SESSION['numPers']);
  ?>
  <!-- formulaire de saisie d'une personne -->
  <div class="divCentre" class="ajout">
    <form action="index.php?page=106" method="post">
      <div class="texteFormulaire">
        <p>Nom :</p>
        <p>Prénom :</p>
        <p>Téléphone :</p>
        <p>Mail :</p>
        <p>Login :</p>
        <p>Mot de passe :</p>
        <p>Catégorie :</p>
      </div>

      <div class="champsFormulaire">
        <input class="zoneTexte" type="text" name="nom" value="<?php echo $personne->per_nom ?>" required>
        <input class="zoneTexte" type="text" name="prenom" value="<?php echo $personne->per_prenom ?>" required>
        <input class="zoneTexte" type="text" name="tel" pattern="[0-9]+" title="Exemple : 0102030405" value="<?php echo $personne->per_tel ?>" required>
        <input class="zoneTexte" type="text" name="mail" value="<?php echo $personne->per_mail ?>" required>
        <input class="zoneTexte" type="text" name="login" value="<?php echo $personne->per_login ?>" required>
        <input class="zoneTexte" type="password" name="passwd" pattern=".{3,}" placeholder="Laisser vide pour conserver" title="Le mot de passe doit contenir au moins 3 caractères">
        <div class="radio">
          <input type= "radio" name="categorie" value="etudiant" checked> Etudiant
          <input type= "radio" name="categorie" value="personnel"> Personnel
        </div>
      </div>
      <input class="bouton" type="submit" value="Valider">
    </form>
  </div><?php
}
else //si le numero de la personne n'existe pas (entrée par URL)
{?>
  <h2>Erreur 404: Personne non trouvée</h2><?php
}
?>
