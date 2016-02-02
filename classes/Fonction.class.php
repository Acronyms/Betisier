<?php

class Fonction
{
  private $num_fon;
  private $libelle_fon;

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
          case 'fon_num' : $this->setFonNum($valeurs); break;
          case 'fon_libelle' : $this->setFonNom($valeurs); break;
        }

      }
    }

    function setFonNum($num)
    {
      $this->num_fon = $num;
    }
    function getFonNum()
    {
      return $this->num_fon;
    }

    function setFonNom($nom)
    {
      $this->libelle_fon = $nom;
    }
    function getFonNom()
    {
      return $this->libelle_fon;
    }
}
