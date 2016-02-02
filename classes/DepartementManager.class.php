<?php
class DepartementManager
    {
      private $db;

      function __construct($database)
      {
        $this->db = $database;
      }

      //Cette fonction retourne la liste des departements présents dans la base de données
      public function getListeDepartement()
      {
          $listeDepartements = array();
          $req=$this->db->prepare("SELECT dep_num, dep_nom, vil_num FROM departement;");
          $req->execute();

          while($departement = $req->fetch(PDO::FETCH_OBJ))
          {
            $listeDepartements [] = new Departement ($departement);
          }
          return $listeDepartements;
          $req->closeCursor();
      }

      //Cette fonction recupère un id de ville avec un id de departement
      //Paramètre :
      //  $numDepatement : id du departement
      //Retourne l'id de la ville correspondant
      public function getIdVilleIdDepartement($numDepatement)
      {
        $req=$this->db->prepare("SELECT vil_num FROM departement where dep_num=:depnum;");
        $req->bindParam(':depnum', $numDepatement);
        $req->execute();
        $vilnum = $req->fetch(PDO::FETCH_OBJ);
        return $vilnum;
        $req->closeCursor();
      }

      //Cette fonction retourne la liste des departements d'une ville
      //Paramètre :
      //  $ville : id de la ville
      //Retourne la liste des departement de la ville donnée
      public function getDepartementIdVille($ville)
      {
        $listeDepartements = array();
        $req=$this->db->prepare("SELECT dep_num FROM departement where vil_num=:ville;");
        $req->bindParam(':ville', $ville);
        $req->execute();
        while($departement = $req->fetch(PDO::FETCH_OBJ))
        {
          $listeDepartements [] = new Departement ($departement);
        }
        return $listeDepartements;
        $req->closeCursor();
      }

      //Cette procédure supprime tous les departements d'une ville
      //Paramètre :
      //  $ville : id de la ville
      public function supprimerDepartementIdVille($ville)
      {
        $req=$this->db->prepare("DELETE FROM departement where vil_num=:ville;");
        $req->bindParam(':ville', $ville);
        $req->execute();
        $req->closeCursor();
      }
    }
 ?>
