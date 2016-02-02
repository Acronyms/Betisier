<?php
$db = new Mypdo();
$managerDi = new DivisionManager($db);
$managerDe = new DepartementManager($db);
$managerF = new FonctionManager($db);
$managerV = new VilleManager($db);

if($managerP->existePseudo($_POST['login'])) //si le pseudo est déja pris
{?>
    <img src="image/erreur.png" alt="Erreur" /> Le pseudo <b>"<?php echo $_POST['login'] ?>"</b> est déjà pris
    <a href="index.php?page=51" class="bouton">Retour à l'ajout de personne</a><?php
}
else {
  //on a besoin des variables suivant pour la prochaine page
  $_SESSION['nom']=$_POST['nom'];
  $_SESSION['prenom']=$_POST['prenom'];
  $_SESSION['tel']=$_POST['tel'];
  $_SESSION['mail']=$_POST['mail'];
  $_SESSION['login']=$_POST['login'];
  $_SESSION['passwd']=$_POST['passwd'];


  //si ajout d'un etudiant
  if ($_POST['categorie'] == 'etudiant')
  {
    $listeDivisions = $managerDi->getListeDivision();?>

    <h1>Ajouter un étudiant</h1>
    <div class="divCentre" id="ajout">
      <form action="index.php?page=56" method="post" name="ajoutEtu">
        <div class="texteFormulaire">
          <p>Année :</p>
          <p>Département :</p>
        </div>

        <!-- choix de la division -->
        <div class="champsFormulaire">
          <select class="zoneTexte" name="listerAnnees"><?php
            foreach ($listeDivisions as $division)
            { echo "\n";?>
              <option value="<?php echo $division->getDivNum(); ?>"><?php echo $division->getDivNom();?></option><?php
            }echo "\n";?>
          </select>

          <!-- choix du departement -->
          <select class="zoneTexte" name="listerDepartements"><?php
            $listeDepartements = $managerDe->getListeDepartement();
            foreach ($listeDepartements as $departement)
            {
              $vilnum=$managerDe->getIdVilleIdDepartement($departement->getDepNum())->vil_num;
              $vilnom=$managerV->getNomVilleIdVille($vilnum);
              echo "\n";?>
              <option value="<?php echo $departement->getDepNum() ?>"><?php echo $departement->getDepNom()." (".$vilnom.")"; ?></option><?php
            }echo "\n";?>
          </select>
        </div>
        <input class="bouton" type="submit" value="Valider">
      </form>
    </div><?php
  }
  //si ajout d'un salarie
  else {?>
    <h1>Ajouter un salarié</h1>
    <div class="divCentre" id="ajout">
      <form action="index.php?page=57" method="post" name="ajoutSal">
        <div class="texteFormulaire">
          <p>Téléphone pro :</p>
          <p>Fonction :</p>
        </div>

        <div class="champsFormulaire">
          <!-- choix du telephone professionnel -->
          <input name="telpro" class="zoneTexte" type="text" pattern="[0-9]+" title="Exemple : 0102030405" required>

          <!-- choix de la fonction -->
          <select class="zoneTexte" name="listerFonctions"><?php
            $listeFonctions = $managerF->getListeFonctions();
            foreach ($listeFonctions as $fonction)
            { echo "\n";?>
              <option value="<?php echo $fonction->getFonNum() ?>"><?php echo $fonction->getFonNom(); ?></option><?php
            }echo "\n";?>
          </select>
        </div>

        <input class="bouton" type="submit" value="Valider">
      </form>
    </div><?php
  }
}

?>
