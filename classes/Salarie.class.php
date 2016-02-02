<?php

class Salarie extends Personne
{

  private $sal_tel;
  private $num_fon;

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
        case 'sal_telprof' : $this->setSalTel($valeurs); break;
        case 'fon_num' : $this->setFonNum($valeurs);break;
      }

    }
  }

  function setSalTel($val)
  {
    $this->dep_num = $val;
  }
  function getSalTel()
  {
    return $this->dep_num;
  }

  function setFonNum($val)
  {
    $this->div_num = $val;
  }
  function getFonNum()
  {
    return $this->div_num;
  }
}
?>
