<?php

  //cette fonction permet le chargement automatique d'une classes
  //Préconditions :
  //  la classe se trouve dans le repertoire "classes"
  //  le fichier de classe se nomme "<nomdelaclasse>.class.php"
  function __autoload($nomClasse)
  {
    $chemin="./classes/$nomClasse.class.php";
    include $chemin;
  }

?>
