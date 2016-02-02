<?php
class VoteManager
{
  private $db;
  
  function __construct($database)
  {
    $this->db = $database;
  }

  //Cette fonction détermine si un étudiant a voté pour une citation
  //Paramètres :
  //  $cit_num : numéro de la citation
  //  $per_num : id de l'étudiant
  //Retourne vrai si l'étudiant a voté pour la citation, faux sinon
  public function aVote($cit_num, $per_num)
  {
    $req=$this->db->prepare("SELECT cit_num FROM vote WHERE cit_num=:cit_num AND per_num=:per_num");
    $req->bindParam(':cit_num', $cit_num);
    $req->bindParam(':per_num', $per_num);
    $req->execute();
    $vote = $req->fetch(PDO::FETCH_OBJ);
    return $vote;
    $req->closeCursor();
  }

  //Cette procédure ajoute un vote à la base de données
  //Paramètres :
  //  $cit_num : numéro de la citation
  //  $per_num : id de l'étudiant votant
  //  $note : note attribuée à la citation
  public function voter($cit_num, $per_num ,$note)
  {
    $req=$this->db->prepare("INSERT INTO vote VALUES (:citnum, :pernum, :note);");
    $req->bindParam(':citnum', $cit_num);
    $req->bindParam(':pernum', $per_num);
    $req->bindParam(':note', $note);
    $req->execute();
    $req->closeCursor();
  }

  //Cette procédure supprime une citation
  //Paramètre :
  //  $citation : numéro de la citation à supprimer
  public function supprimerVoteCitation($citation)
  {
    $req=$this->db->prepare("DELETE FROM vote where cit_num=:citnum");
    $req->bindParam(':citnum', $citation);
    $req->execute();
    $req->closeCursor();
  }

  //Cette procédure supprime les votes d'une personne
  //Paramètre :
  //  $num : id de la personne dont les votes doivent êtremodifiés
  public function supprimerVoteIdPersonne($num)
  {
    $req=$this->db->prepare("DELETE FROM vote where per_num=:num");
    $req->bindParam(':num', $num);
    $req->execute();
    $req->closeCursor();
  }
}
?>
