<?php

class Division
{
  private $num_div;
  private $nom_div;

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
          case 'div_num' : $this->setDivNum($valeurs); break;
          case 'div_nom' : $this->setDivNom($valeurs); break;
        }

      }
    }

    function setDivNum($num)
    {
      $this->num_div = $num;
    }
    function getDivNum()
    {
      return $this->num_div;
    }

    function setDivNom($nom)
    {
      $this->nom_div = $nom;
    }
    function getDivNom()
    {
      return $this->nom_div;
    }
}
