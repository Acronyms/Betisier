<h1>Ajouter une personne</h1>
<!-- formulaire de saisie d'une personne -->
<div class="divCentre" class="ajout">
  <form action="index.php?page=55" method="post">
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
      <input class="zoneTexte" type="text" name="nom" required>
      <input class="zoneTexte" type="text" name="prenom" required>
  		<input class="zoneTexte" type="text" name="tel" pattern="[0-9]+" title="Exemple : 0102030405" required>
  		<input class="zoneTexte" type="text" name="mail" required>
      <input class="zoneTexte" type="text" name="login" required>
  		<input class="zoneTexte" type="password" name="passwd" pattern=".{3,}" title="Le mot de passe doit contenir au moins 3 caractères" required>
	    <div class="radio">
  		  <input type= "radio" name="categorie" value="etudiant" checked> Etudiant
  		  <input type= "radio" name="categorie" value="personnel"> Personnel
		  </div>
    </div>
   <input class="bouton" type="submit" value="Valider">
  </form>
</div>
