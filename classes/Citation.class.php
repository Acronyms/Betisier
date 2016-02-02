<?php


class Citation
{
  private $num_pers;
  private $num_cit;
  private $libelle;
  private $date;
  private $note;

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
          case 'cit_num' : $this->setNumCit($valeurs); break;
          case 'cit_libelle' : $this->setNomcitation($valeurs); break;
          case 'cit_date' : $this->setDateCitation($valeurs);break;
          case 'note' : $this->setNoteCitation($valeurs);break;
        }

      }
    }
  function setNumPers($num)
  {
    $this->num_pers = $num;
  }

  function getNumPers()
  {
    return $this->num_pers;
  }

  function setNumCit($num)
  {
    $this->num_cit = $num;
  }
  function getNumCit()
  {
    return $this->num_cit;
  }

  function setNomCitation($name)
  {
    $this->libelle= $name;
  }

  function getNomCitation()
  {
    return $this->libelle;
  }

    function setDateCitation($date)
  {
    $this->date = $date;
  }
    function getDateCitation()
  {
    return $this->date;
  }

    function setNoteCitation($note)
  {
    $this->note = $note;
  }
    function getNoteCitation()
  {
    return $this->note;
  }
}
 ?>
