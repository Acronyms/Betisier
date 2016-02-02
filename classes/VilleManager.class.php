<?php
class VilleManager {

  private $db;

  public function __construct($db)
  {
    $this->db=$db;
  }

  //Cette fonction retourne le nombre de villes stockées dans la base de données
  public function getNbVilles()
  {
    $req=$this->db->prepare("SELECT COUNT(*) AS nbVilles FROM ville;");
    $req->execute();

    $ville=$req->fetch(PDO::FETCH_OBJ);
    return $ville;
    $req->closeCursor();
  }

  //Cette fonction retourne un tableau des villes stockées dans la base de données
  public function getVilles()
  {
    $listeVilles=array();
    $req=$this->db->prepare("SELECT vil_num, vil_nom FROM ville;");
    $req->execute();

    while($ville=$req->fetch(PDO::FETCH_OBJ))
    {
      $listeVilles[]=new Ville($ville);
    }

    return $listeVilles;
    $req->closeCursor();
  }

  //Cette fonction ajoute une ville dans la base de données
  //Paramètre :
  //  $nom : nom de la ville à ajouter
  public function ajouterVille($nom)
  {
      $req=$this->db->prepare("INSERT INTO ville(vil_nom) VALUES(:nom);");
      $req->bindParam(':nom', $nom);
      $req->execute();
      $req->closeCursor();
  }

  //Cette fonction modifie une ville dans la base de données
  //Paramètres :
  //  $num : num de la ville à modifier
  //  $nom : nom de la ville à modifier
  public function modifierVille($num, $nom)
  {
    $req=$this->db->prepare("UPDATE ville SET vil_nom=:vilnom WHERE vil_num=:vilnum;");
    $req->bindParam(':vilnum', $num);
    $req->bindParam(':vilnom', $nom);
    $req->execute();
    $req->closeCursor();
  }

  //Cette procédure permet la suppression d'une Ville
  //Paramètre :
  //  $num : id de la ville à supprimer
  public function supprimerVille($num)
  {
    $req=$this->db->prepare("DELETE FROM ville WHERE vil_num=:vilnum;");
    $req->bindParam(':vilnum', $num);
    $req->execute();
    $req->closeCursor();
  }

  //Cette fonction détermine si une ville existe par nom
  //Paramètre :
  //  $nom : nom de la ville à tester
  //Retourne vrai si la ville est présente dans la base, faux sinon
  public function existeVille($nom)
  {
      $req=$this->db->prepare("SELECT vil_nom FROM ville WHERE vil_nom=:nom collate 'utf8_bin'");
      $req->bindParam(':nom', $nom);
      $req->execute();
      $ville=$req->fetch(PDO::FETCH_OBJ);
      return $ville;
      $req->closeCursor();
  }

  //Cette fonction détermine si une ville existe par id
  //Paramètre :
  //  $num : id de la ville à tester
  //Retourne vrai si la ville est présente dans la base, faux sinon
  public function isVille($num)
  {
      $req=$this->db->prepare("SELECT vil_num FROM ville WHERE vil_num=:num");
      $req->bindParam(':num', $num);
      $req->execute();
      $ville=$req->fetch(PDO::FETCH_OBJ);
      return $ville;
      $req->closeCursor();
  }

  //Cette fonction recupère l'id d'une ville avec son nom
  //Paramètre :
  //  $num : id de la ville à récupérer
  //Retourne le nom de la ville
  public function getNomVilleIdVille($num)
  {
      $req=$this->db->prepare("SELECT vil_nom FROM ville WHERE vil_num=:num");
      $req->bindParam(':num', $num);
      $req->execute();
      $nom=$req->fetch(PDO::FETCH_OBJ);
      return $nom->vil_nom;
      $req->closeCursor();
  }

}?>
