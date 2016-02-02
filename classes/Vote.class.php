<?php

class Vote
{
  private $cit_num;
  private $per_num;
  private $vot_valeur;

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
          case 'cit_num' : $this->setCitNum($valeurs); break;
          case 'per_num' : $this->setPerNum($valeurs); break;
          case 'vot_valeur' : $this->setVoteValeur($valeurs); break;
        }

      }
    }

    function setCitNum($num)
    {
      $this->cit_num = $num;
    }
    function getCitNum()
    {
      return $this->cit_num;
    }

    function setPerNum($num)
    {
      $this->per_num = $num;
    }
    function getPerNum()
    {
      return $this->per_num;
    }

    function setVoteValeur($val)
    {
      $this->vot_valeur = $val;
    }
    function getVoteValeur()
    {
      return $this->vot_valeur;
    }
}
