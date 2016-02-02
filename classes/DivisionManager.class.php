<?php
class DivisionManager
    {
      private $db;
      
      function __construct($database)
      {
        $this->db = $database;
      }

      //Cette fonction retourne la liste des divisions présentes dans la base de données
      public function getListeDivision()
      {
          $listeAnnees = array();
          $req=$this->db->prepare("SELECT div_num, div_nom FROM division;");
          $req->execute();

          while($annee = $req->fetch(PDO::FETCH_OBJ))
          {
            $listeAnnees [] = new Division ($annee);
          }
          return $listeAnnees;
          $req->closeCursor();
      }
    }
 ?>
