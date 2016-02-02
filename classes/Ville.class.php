<?php class Ville{

  private $numVille;
  private $nomVille;

  public function __construct($valeurs = array())
  {
    if(!empty($valeurs))
    {
      $this->affecte($valeurs);
    }
  }

  public function affecte($donnees)
  {
    foreach($donnees as $attribut => $valeurs)
    {
      switch($attribut)
      {
        case 'vil_num' : $this->setNumVille($valeurs);
          break;

        case 'vil_nom' : $this->setNomVille($valeurs);
          break;
      }
    }
  }

  public function setNumVille($numVille)
  {
    $this->numVille=$numVille;
  }

  public function setNomVille($nomVille)
  {
    $this->nomVille=$nomVille;
  }

  public function getNumVille()
  {
    return $this->numVille;
  }

  public function getNomVille()
  {
    return $this->nomVille;
  }
}
?>
