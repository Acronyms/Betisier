<?php

class Etudiant extends Personne
{
  private $dep_num;
  private $div_num;

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
        case 'dep_num' : $this->setDepNum($valeurs); break;
        case 'div_num' : $this->setDivNum($valeurs);break;
      }

    }
  }

  function setDepNum($val)
  {
    $this->dep_num = $val;
  }
  function getDepNum()
  {
    return $this->dep_num;
  }

  function setDivNum($val)
  {
    $this->div_num = $val;
  }
  function getDivNum()
  {
    return $this->div_num;
  }
}
?>
