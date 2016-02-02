<?php

class Personne
{
  private $num_pers;
  private $nom_pers;
  private $prenom_pers;

  function __construct($valeur = array() )
  {
    if(!empty($valeur))
    {
      $this->affecte($valeur);
    }
  }

  function affecte($donnees)
  {
    foreach ($donnees as $attribut => $valeurs)
    {
      switch ($attribut)
      {
        case 'per_num' : $this->setNumPers($valeurs); break;
        case 'per_nom' : $this->setNomPers($valeurs); break;
        case 'per_prenom' : $this->setPrenomPers($valeurs);break;
      }

    }
  }

  function setNomPers($nom)
  {
    $this->nom_pers = $nom;
  }
  function getNomPers()
  {
    return $this->nom_pers;
  }

  function setNumPers($num)
  {
    $this->num_pers = $num;
  }
  function getNumPers()
  {
    return $this->num_pers;
  }

  function setPrenomPers($pre)
  {
    $this->prenom_pers = $pre;
  }
  function getPrenomPers()
  {
    return $this->prenom_pers;
  }
}
?>
