<h1>Ajouter une ville</h1>
<?php
$db=new Mypdo();
$manager= new VilleManager($db);

if($manager->existeVille($_POST['ville'])) //si la ville existe déjà
{?>
  <img src="image/erreur.png" alt="Erreur" /> La ville <b>"<?php echo $_POST['ville'] ?>"</b> est déjà présente <?php
}
else
{
  $manager->ajouterVille($_POST['ville']);?>
  <!-- message de confirmation -->
  <img src="image/valid.png" alt="Valide" /> La ville <b>"<?php echo $_POST['ville'] ?>"</b> a été ajoutée <?php
}?>
