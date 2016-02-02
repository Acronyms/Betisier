<?php

class Departement
{
  private $num_dep;
  private $nom_dep;
  private $num_vil;

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
          case 'dep_num' : $this->setDepNum($valeurs); break;
          case 'dep_nom' : $this->setDepNom($valeurs); break;
          case 'vil_num' : $this->setVilleNum($valeurs); break;
        }

      }
    }

    function setDepNum($num)
    {
      $this->num_dep = $num;
    }
    function getDepNum()
    {
      return $this->num_dep;
    }

    function setDepNom($nom)
    {
      $this->nom_dep = $nom;
    }
    function getDepNom()
    {
      return $this->nom_dep;
    }

    function setVilleNum($num)
    {
      $this->num_vil = $num;
    }
    function getVilleNum()
    {
      return $this->num_vil;
    }
}
