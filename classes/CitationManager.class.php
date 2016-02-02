<?php

class CitationManager
{
  private $db;

  public function __construct($database)
  {
    $this->db = $database;
  }

  //Cette fonction retourne le nombre de citations valides présentes dans la base de données
  public function getNbCitationValide()
  {
    $req=$this->db->prepare("SELECT COUNT(cit_date) AS nbCitation FROM citation WHERE cit_valide = 1 AND cit_date_valide IS NOT NULL;");
    $req->execute();
    $citation=$req->fetch(PDO::FETCH_OBJ);
    return $citation;
    $req->closeCursor();
  }

  //Cette fonction renvoie la liste des citations
  //triées par date de déposition
  public function getListeCitations()
  {
      $listCitation = array();
      $req=$this->db->prepare("SELECT per_num, cit_libelle, cit_date, cit_num FROM citation ORDER BY cit_date");
      $req->execute();
      while($citation = $req->fetch(PDO::FETCH_OBJ))
      {
        $listCitation [] = new Citation ($citation);
      }
      return $listCitation;
      $req->closeCursor();
  }

  //Cette fonction renvoie la liste des citations
  //triées par le numero de l'enseignant qui a déposé la citation
  //et comprises entre les deu dates passées en paramètre
  public function getListeCitationsTri($num, $dateUn, $dateDeux)
  {
    $listCitation = array();
    $req=$this->db->prepare("SELECT per_num, cit_libelle, cit_date, cit_num FROM citation
                              WHERE per_num LIKE :num
                              AND cit_date BETWEEN :dateU AND :dateD;");
    $req->bindParam(':dateU', $dateUn);
    $req->bindParam(':dateD', $dateDeux);
    $req->bindParam(':num', $num);
    $req->execute();
    while($citation = $req->fetch(PDO::FETCH_OBJ))
    {
      $listCitation [] = new Citation ($citation);
    }
    return $listCitation;
    $req->closeCursor();
  }

  //Cette fonction calcule et retourne la moyenne d'une citation
  //Paramètre :
  //  $num : numero de la citation
  //Retourne la moyenne de la citation
  public function getMoyenneCitationNum($num)
  {
    $req=$this->db->prepare("SELECT ROUND(AVG(vot_valeur),2) AS moyenne
    FROM vote
    WHERE cit_num=:num
    GROUP BY cit_num;");
    $req->bindParam(':num', $num);
    $req->execute();
    $moyenne = $req->fetchColumn();
    return $moyenne;
    $req->closeCursor();
  }

  //Cette procédure ajoute une citation dans la base
  //Paramètres :
  //  $perNumProf : num de l'enseignant ayant formulé la citation
  //  $perNumAjout : num de l'étudiant ayant ajouté la citation
  //  $citation : citation à ajouter
  //  $dateA : date d'ajout de la citation
  public function ajouterCitation($perNumProf, $perNumAjout, $citation, $dateA)
  {
    $req=$this->db->prepare("INSERT INTO citation(per_num, per_num_etu, cit_libelle, cit_date, cit_valide)
                             VALUES(:perNumProf, :perNumAjout, :citation, :dateA, 0);");
    $req->bindParam(':perNumProf', $perNumProf);
    $req->bindParam(':perNumAjout', $perNumAjout);
    $req->bindParam(':citation', $citation);
    $req->bindParam(':dateA', $dateA);
    $req->execute();
    $req->closeCursor();
  }

  //Cette fonction détermine si une citation est valides
  //Paramètres :
  //  $num : numéro de la citation
  //Retourne vrai si la citation est valide, faux sinon
  public function isCitationValide($num)
  {
    $req=$this->db->prepare("SELECT cit_num FROM citation
                              WHERE cit_num=:cit_num
                              AND cit_date_valide IS NOT NULL
                              AND cit_valide=1;");
    $req->bindParam(':cit_num', $num);
    $req->execute();
    $citation = $req->fetch(PDO::FETCH_OBJ);
    return $citation;
    $req->closeCursor();
  }

  //Cette fonction recupere le libelle d'une citation
  //Paramètres :
  //  $num : numéro de la citation
  //Retourne le libele de la citation
  public function getLibelleCitation($num)
  {
    $req=$this->db->prepare("SELECT cit_libelle FROM citation WHERE cit_num=:num;");
    $req->bindParam(':num', $num);
    $req->execute();
    $cit = $req->fetch(PDO::FETCH_OBJ);
    return $cit;
    $req->closeCursor();
  }

  //Cette procedure valide une citation
  //Paramètres :
  //  $per_num : numéro de la personne validant la citation
  //  $cit_num : numéro de la citation
  //  $date : date de la validation
  public function validerCitation($per_num, $cit_num, $date)
  {
    $req=$this->db->prepare("UPDATE citation SET per_num_valide=:per_num, cit_valide=1, cit_date_valide=:dateV WHERE cit_num=:citnum;");
    $req->bindParam(':per_num', $per_num);
    $req->bindParam(':dateV', $date);
    $req->bindParam(':citnum', $cit_num);
    $req->execute();
    $req->closeCursor();
  }

  //Cette procédure supprime une citation
  //Paramètres :
  //  $num : numéro de la citation
  public function supprimerCitation($num)
  {
    $req=$this->db->prepare("DELETE FROM citation where cit_num=:citnum");
    $req->bindParam(':citnum', $num);
    $req->execute();
    $req->closeCursor();
  }

  //Cette fonction retourne la liste de citations notées par un etudiant
  //Paramètre :
  //  $etu : id de l'étudiant
  //Retourne la liste des citations comportant une note de l'etudiant
  public function getCitationIdEtudiant($etu){
    $listCitation = array();
    $req=$this->db->prepare("SELECT cit_num FROM citation
                              WHERE per_num_etu = :num");
    $req->bindParam(':num', $etu);
    $req->execute();
    while($citation = $req->fetch(PDO::FETCH_OBJ))
    {
      $listCitation [] = new Citation ($citation);
    }
    return $listCitation;
    $req->closeCursor();
  }

  //Cette fonction retourne la liste de citations exprimées par un salarie
  //Paramètre :
  //  $etu : id du salarie
  //Retourne la liste des citations du salarié
  public function getCitationIdSalarie($sal){
    $listCitation = array();
    $req=$this->db->prepare("SELECT cit_num FROM citation
                              WHERE per_num = :num");
    $req->bindParam(':num', $sal);
    $req->execute();
    while($citation = $req->fetch(PDO::FETCH_OBJ))
    {
      $listCitation [] = new Citation ($citation);
    }
    return $listCitation;
    $req->closeCursor();
  }

  //Cette fonction retourne la liste de citations validées par un administrateur
  //Paramètre :
  //  $admin : id de l'administrateur
  //Retourne la liste des citations validées par un administrateur
  public function getCitationIdAdmin($admin){
    $listCitation = array();
    $req=$this->db->prepare("SELECT cit_num FROM citation
                              WHERE per_num_valide = :num");
    $req->bindParam(':num', $admin);
    $req->execute();
    while($citation = $req->fetch(PDO::FETCH_OBJ))
    {
      $listCitation [] = new Citation ($citation);
    }
    return $listCitation;
    $req->closeCursor();
  }

  //Cette procédure supprime les citations proposées par un etudiant
  //Paramètres :
  //  $num : per_num de l'etudiant
  public function supprimerCitationIdEtudiant($num)
  {
    $req=$this->db->prepare("DELETE FROM citation where per_num_etu=:num");
    $req->bindParam(':num', $num);
    $req->execute();
    $req->closeCursor();
  }

  //Cette procédure supprime les citations validées par un administrateur
  //Paramètres :
  //  $num : per_num de l'administrateur
  public function supprimerCitationIdAdmin($num)
  {
    $req=$this->db->prepare("DELETE FROM citation where per_num_valide=:num");
    $req->bindParam(':num', $num);
    $req->execute();
    $req->closeCursor();
  }

  //Cette procédure supprime les citations venant d'un enseignant
  //Paramètres :
  //  $num : per_num de l'enseignant
  public function supprimerCitationIdSalarie($num)
  {
    $req=$this->db->prepare("DELETE FROM citation where per_num=:num");
    $req->bindParam(':num', $num);
    $req->execute();
    $req->closeCursor();
    }
}

 ?>
