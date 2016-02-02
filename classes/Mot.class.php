<?php

class Mot
{
  private $mot_id;
  private $mot;


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
          case 'mot_id' : $this->setMotId($valeurs); break;
          case 'mot_interdit' : $this->setMotInterdit($valeurs); break;
        }

      }
    }

  function setMotId($id)
  {
    $this->mot_id = $id;
  }

  function getMotId()
  {
    return $this->mot_id;
  }

  function setMotInterdit($mot)
  {
    $this->mot = $mot;
  }
  function getMotInterdit()
  {
    return $this->mot;
  }
}
 ?>
