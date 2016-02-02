
<h1> Noter une citation </h1>
<?php
$db = new Mypdo();
$managerV = new VoteManager($db);

$managerV->voter($_SESSION['numCitation'], $_SESSION['id'], $_POST['noteCit']);?>

<!-- message de confirmation -->
<img src="image/valid.png" alt="ImageValide" /> Votre note a bien été prise en compte !<?php
unset($_SESSION['numCitation']); //on desinitialise le numero de la citation
 ?>
