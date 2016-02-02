<?php
class EtudiantManager extends PersonneManager {
  private $db;

  function __construct($database)
  {
    $this->db = $database;
  }

  //Cette fonction ajoute un etudiant dans la base de données
  //Paramètres :
  //  $dep : id du departement de l'étudiant
  //  $div : id de la division de l'étudiant
  public function ajouterEtudiant($dep, $div)
  {
    $req=$this->db->prepare("INSERT INTO etudiant VALUES(:id, :dep, :div);");
    $req->bindParam(':id', $_SESSION['LAST_ID_PERSONNE']);
    $req->bindParam(':dep', $dep);
    $req->bindParam(':div', $div);
    $req->execute();
    $req->closeCursor();
  }

  //Cette donction ajoute un etudiant dans la base de données avec un id donné
  //Paramètres :
  //  $id : id de l'étudiant
  //  $dep : id du departement de l'étudiant
  //  $div : id de la division de l'étudiant
  public function ajouterEtudiantId($id, $dep, $div)
  {
    $req=$this->db->prepare("INSERT INTO etudiant VALUES(:id, :dep, :div);");
    $req->bindParam(':id', $id);
    $req->bindParam(':dep', $dep);
    $req->bindParam(':div', $div);
    $req->execute();
    $req->closeCursor();
  }

  //Cette fonction retourne un etudiant
  //Paramètres :
  //  $id : id de l'étudiant
  public function getEtudiant($num)
  {
    $req=$this->db->prepare("SELECT per_nom, per_prenom, per_mail, per_tel, dep_nom, vil_nom, e.div_num, e.dep_num FROM personne p
    INNER JOIN etudiant e on (e.per_num = p.per_num)
    INNER JOIN departement d ON (d.dep_num = e.dep_num)
    INNER JOIN ville v ON (v.vil_num = d.vil_num)
    WHERE p.per_num = :num;");
    $req->bindParam(':num', $num);
    $req->execute();
    $etu = $req->fetch(PDO::FETCH_OBJ);
    return $etu;
    $req->closeCursor() ;
  }

  //Cette fonction détermine si un id est celui d'un etudiant
  //Paramètres :
  //  $id : id à tester
  //Retourne vrai si l'id est celui d'un etudiant, faux sinon
  public function isEtudiant($num)
  {
    $req=$this->db->prepare("SELECT per_num FROM etudiant WHERE per_num=:num;");
    $req->bindParam(':num', $num);
    $req->execute();
    $isEtu = $req->fetch(PDO::FETCH_OBJ);
    return $isEtu;
    $req->closeCursor();
  }

  //Cette fonction permet de modifier les caractéristiques d'un etudiant
  //Paramètres :
  //  $id : id de l'étudiant
  //  $dep : id du nouveau departement de l'étudiant
  //  $div : id de la nouvelle division de l'étudiant
  public function modifierEtudiant($num, $div,$dep)
  {
    $req=$this->db->prepare("UPDATE etudiant SET dep_num=:dep, div_num=:div WHERE per_num=:id;");
    $req->bindParam(':id', $num);
    $req->bindParam(':dep', $dep);
    $req->bindParam(':div', $div);
    $req->execute();
    $req->closeCursor();
  }

  //Cette procedure supprime un etudiant
  //Paramètre :
  //  $id : id de l'étudiant
  public function supprimerEtudiant($num)
  {
    $req=$this->db->prepare("DELETE FROM etudiant WHERE per_num=:id;");
    $req->bindParam(':id', $num);
    $req->execute();
    $req->closeCursor();
  }

  //Cette fonction retourne la liste des étudiants d'un département
  //Paramètre :
  //  $dep : id du département
  //Retourne la liste des étudiants d'un département donné
  public function getEtudiantIdDepartement($dep){
    $listeEtudiant = array();
    $req=$this->db->prepare("SELECT per_num FROM etudiant WHERE dep_num = :num;");
    $req->bindParam(':num', $dep);
    $req->execute();
    while($etudiant = $req->fetch(PDO::FETCH_OBJ))
    {
      $listeEtudiant [] = new Etudiant ($etudiant);
    }
    return $listeEtudiant;
    $req->closeCursor();
  }

}
?>
