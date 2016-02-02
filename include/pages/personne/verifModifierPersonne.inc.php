<?php
$db = new Mypdo();
$managerDi = new DivisionManager($db);
$managerDe = new DepartementManager($db);
$managerF = new FonctionManager($db);
$managerV = new VilleManager($db);
$managerE = new EtudiantManager($db);
$managerS = new SalarieManager($db);

if($managerP->existePseudo($_POST['login'])) //si le pseudo est déja pris
{?>
    <img src="image/erreur.png" alt="Erreur" /> Le pseudo <b>"<?php echo $_POST['login'] ?>"</b> est déjà pris
    <a href="index.php?page=51" class="bouton">Retour à l'ajout de personne</a><?php
}
else{
  //on a besoin des variables suivant pour la prochaine page
  $_SESSION['nom']=$_POST['nom'];
  $_SESSION['prenom']=$_POST['prenom'];
  $_SESSION['tel']=$_POST['tel'];
  $_SESSION['mail']=$_POST['mail'];
  $_SESSION['login']=$_POST['login'];
  $_SESSION['passwd']=$_POST['passwd'];

  //si modification d'un etudiant
  if ($_POST['categorie'] == 'etudiant')
  {
    $listeDivisions = $managerDi->getListeDivision();?>

    <h1>Modifier un étudiant</h1>
    <div class="divCentre" id="ajout">
      <form action="index.php?page=107" method="post" name="ajoutEtu">
        <div class="texteFormulaire">
          <p>Année :</p>
          <p>Département :</p>
        </div>

        <div class="champsFormulaire">
          <!-- choix de la division -->
          <select class="zoneTexte" name="listerAnnees"><?php
            foreach ($listeDivisions as $division)
            { echo "\n";?>
              <option value="<?php echo $division->getDivNum();?>"
              <?php
              if($managerE->isEtudiant($_SESSION['numPers']))
              {
                $etudiant=$managerE->getEtudiant($_SESSION['numPers']);
                if($division->getDivNum()==$etudiant->div_num)
                {
                  echo " selected "; //on selectionne si correspond à la division actuelle
                }
              }?>
              ><?php echo $division->getDivNom();?></option><?php
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
              <option value="<?php echo $departement->getDepNum() ?>"
                <?php
                if($managerE->isEtudiant($_SESSION['numPers']))
                {
                  $etudiant=$managerE->getEtudiant($_SESSION['numPers']);
                  if($departement->getDepNum()==$etudiant->dep_num)
                  {
                    echo " selected ";//on selectionne si correspond au departement actuel
                  }
                }?>
                ><?php echo $departement->getDepNom()." (".$vilnom.")"; ?></option><?php
            }echo "\n";?>
          </select>
        </div>
        <input class="bouton" type="submit" value="Valider">
      </form>
    </div><?php
  }
  //si modification d'un salarie
  else {?>
    <h1>Modifier un salarié</h1>
    <div class="divCentre" id="ajout">
      <form action="index.php?page=108" method="post" name="ajoutSal">
        <div class="texteFormulaire">
          <p>Téléphone pro :</p>
          <p>Fonction :</p>
        </div>

        <div class="champsFormulaire">

          <!-- choix du telephone professionnel -->
          <input name="telpro" class="zoneTexte" type="text" pattern="[0-9]+" title="Exemple : 0102030405" <?php
          if(!$managerE->isEtudiant($_SESSION['numPers']))
          {
            $salarie=$managerS->getSalarie($_SESSION['numPers']);?>
            value="<?php echo $salarie->sal_telprof;?>"<?php //on recupere la valeur du telephone pro du salarie
          }?>
           required>

           <!-- choix de la fonction -->
          <select class="zoneTexte" name="listerFonctions"><?php
            $listeFonctions = $managerF->getListeFonctions();
            foreach ($listeFonctions as $fonction)
            { echo "\n";?>
              <option value="<?php echo $fonction->getFonNum() ?>"
              <?php
              if(!$managerE->isEtudiant($_SESSION['numPers']))
              {
                $salarie=$managerS->getSalarie($_SESSION['numPers']);
                if($fonction->getFonNum()==$salarie->fon_num)
                {
                  echo " selected ";
                }
              }?>
              ><?php echo $fonction->getFonNom(); ?></option><?php
            }echo "\n";?>
          </select>
        </div>

        <input class="bouton" type="submit" value="Valider">
      </form>
    </div><?php
  }
}


 ?>
