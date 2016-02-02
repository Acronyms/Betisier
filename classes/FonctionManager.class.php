<?php
class FonctionManager
{
  private $db;
  
  function __construct($database)
  {
    $this->db = $database;
  }

  //Cette fonction retourne la liste des fonctions présentes dans la base de données
  public function getListeFonctions()
  {
    $listeFonctions = array();
    $req=$this->db->prepare("SELECT fon_num, fon_libelle FROM fonction;");
    $req->execute();
    while($fonction = $req->fetch(PDO::FETCH_OBJ))
    {
      $listeFonctions [] = new Fonction ($fonction);
    }
    return $listeFonctions;
    $req->closeCursor();
  }
}
?>
