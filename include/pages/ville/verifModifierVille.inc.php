<h1> Modifier une ville</h1>
<?php
  $db=new Mypdo();
  $managerV= new VilleManager($db);
  $nomAncienneVille=$managerV->getNomVilleIdVille($_SESSION['numVille']);
if(strcmp($nomAncienneVille,$_POST['ville'])==0) //si le nom de la ville est le meme que précédemment
{?>
  <img src="image/erreur.png" alt="Erreur" /> Le nom de la ville est le même que précédemment<?php
}
else
{
  if($managerV->existeVille($_POST['ville'])) //si la ville existe déjà
  {?>
    <img src="image/erreur.png" alt="Erreur" /> La ville <b>"<?php echo $_POST['ville'] ?>"</b> est déjà présente <?php
  }
  else
  {
    $managerV->modifierVille($_SESSION['numVille'], $_POST['ville']);?>
    <!-- message de confirmation -->
    <img src="image/valid.png" alt="Valide" /> La ville <b>"<?php echo $nomAncienneVille; ?>"</b> a bien été modifiée en <b>"<?php echo $_POST['ville']; ?>"</b> <?php
  }
}
unset($_SESSION['numVille']); //désinitialisation de la variable de l'id de la ville
?>
