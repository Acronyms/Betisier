<?php
class MotManager
{
  private $db;
  
  function __construct($database)
  {
    $this->db = $database;
  }

  //Cette fonction determine quels mots d'une citation sont iterdits
  //Paramètre :
  //  $citation : citation à tester
  //Retourne un tableau de mots interdits, présents dans la citation
  public function motsInterditsCitation($citation)
  {
    $listeMots = array();
    $req=$this->db->prepare("SELECT mot_id, mot_interdit FROM mot WHERE MATCH (mot_interdit) AGAINST (:citation);");
    $req->bindParam(':citation', $citation);
    $req->execute();
    while($mot = $req->fetch(PDO::FETCH_OBJ))
    {
      $listeMots [] = new Mot ($mot);
    }
    return $listeMots;
    $req->closeCursor();
    }
}
?>
