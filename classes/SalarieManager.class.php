<?php
class SalarieManager extends PersonneManager
{
  private $db;
  
  function __construct($database)
  {
    $this->db = $database;
  }

  //Cette fonction retourne la liste de salariés présents dans la base de données
  public function getListeSalarie()
  {
      $listeSalaries = array();
      $req=$this->db->prepare("SELECT p.per_num AS per_num, per_nom
       FROM personne p
       INNER JOIN salarie s ON (p.per_num=s.per_num);");
      $req->execute();

      while($salarie = $req->fetch(PDO::FETCH_OBJ))
      {
        $listeSalaries [] = new Personne ($salarie);
      }
      return $listeSalaries;
      $req->closeCursor();
  }

  //Cette procédure ajoute un salarié dans la base de données
  //Paramètres :
  //  $tel : numéro de téléphone professionnel du salarié
  //  $fon : fonction du salarié
  public function ajouterSalarie($tel, $fon)
  {
    $req=$this->db->prepare("INSERT INTO salarie VALUES(:id, :tel, :fon);");
    $req->bindParam(':id', $_SESSION['LAST_ID_PERSONNE']);
    $req->bindParam(':tel', $tel);
    $req->bindParam(':fon', $fon);
    $req->execute();
    $req->closeCursor();
  }

  //Cette procédure ajoute un salarié dans la base de données avec un id donné
  //Paramètres :
  // $id : id du salarié à ajouter
  //  $tel : numéro de téléphone professionnel du salarié
  //  $fon : fonction du salarié
  public function ajouterSalarieId($id, $tel, $fon)
  {
    $req=$this->db->prepare("INSERT INTO salarie VALUES(:id, :tel, :fon);");
    $req->bindParam(':id', $id);
    $req->bindParam(':tel', $tel);
    $req->bindParam(':fon', $fon);
    $req->execute();
    $req->closeCursor();
  }

  //Cette fonction renvoie un salarié
  //Paramètres :
  // $num : id du salarié à recupérer
  //Retourne un salarie
  public function getSalarie($num)
  {
    $req=$this->db->prepare("SELECT per_nom, per_prenom, per_mail, per_tel, s.sal_telprof, fon_libelle, s.fon_num FROM personne p
    INNER JOIN salarie s ON (p.per_num = s.per_num)
    INNER JOIN fonction f ON (s.fon_num=f.fon_num)
    WHERE p.per_num = :num;");
    $req->bindParam(':num', $num);
    $req->execute();
    $sal = $req->fetch(PDO::FETCH_OBJ);
    return $sal;
    $req->closeCursor() ;
  }

  //Cette procédure modifient les informations d'un salarie
  //Pramètre :
  // $id : id du salarié à ajouter
  //  $tel : nouveau numéro de téléphone professionnel du salarié
  //  $fon : nouvelle fonction du salarié
  public function modifierSalarie($num, $tel, $fon)
  {
    $req=$this->db->prepare("UPDATE salarie SET
                              sal_telprof=:tel, fon_num=:fon
                              WHERE per_num=:id;");
    $req->bindParam(':id', $num);
    $req->bindParam(':tel', $tel);
    $req->bindParam(':fon', $fon);
    $req->execute();
    $req->closeCursor();
  }

  //Cette procédure supprime un salarie
  //Pramètre :
  // $num : id du salarié à supprimer
  public function supprimerSalarie($num)
  {
    $req=$this->db->prepare("DELETE FROM salarie WHERE per_num=:id;");
    $req->bindParam(':id', $num);
    $req->execute();
    $req->closeCursor();
  }
}
?>
