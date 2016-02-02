<?php
class PersonneManager
{
  private $db;

  function __construct($database)
  {
    $this->db = $database;
  }

  //Cette fonction retourne le nombre de personnes présentes dans la base de données
  public function getNbPersonnes()
  {
    $req=$this->db->prepare("SELECT COUNT(*) AS nbPersonnes FROM personne;");
    $req->execute();
    $personne=$req->fetch(PDO::FETCH_OBJ);
    return $personne;
    $req->closeCursor();
  }

  //Cette fonction renvoie la liste des personnes présentes dans la base de données
  public function getList()
  {
    $listePersonne = array();
    $req=$this->db->prepare("SELECT per_num, per_nom, per_prenom FROM personne p;");
    $req->execute();
    while($personne = $req->fetch(PDO::FETCH_OBJ))
    {
      $listePersonne [] = new Personne ($personne);
    }
    return $listePersonne;
    $req->closeCursor();
  }

  //Cette fonction retourne une personne identifiée par un id
  //Paramètre :
  // $num : id de la personne
  //Retourne un objet Personne
  public function getPersonneById($num)
  {
    $req=$this->db->prepare("SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd
                              FROM personne p
                              WHERE per_num=:num;");
    $req->bindParam(':num', $num);
    $req->execute();
    $personne = $req->fetch(PDO::FETCH_OBJ);
    return $personne;
    $req->closeCursor();
  }

  //Cette fonction détermine si un id est celui d'une personne
  //Paramètres :
  //  $id : id à tester
  //Retourne vrai si l'id est celui d'une personne, faux sinon
  public function isPersonne($num)
  {
    $req=$this->db->prepare("SELECT per_num FROM personne WHERE per_num=:num;");
    $req->bindParam(':num', $num);
    $req->execute();
    $isPers = $req->fetch(PDO::FETCH_OBJ);
    return $isPers;
  }

  //Cette fonction détermine si un pseudo est déja pris
  //Paramètres :
  //  $pseudo : pseudo à tester
  //Retourne vrai si le pseudo est déja pris, faux sinon
  public function existePseudo($pseudo){
    $req=$this->db->prepare("SELECT per_login FROM personne WHERE per_login=:pseudo;");
    $req->bindParam(':pseudo', $pseudo);
    $req->execute();
    $existe = $req->fetch(PDO::FETCH_OBJ);
    return $existe;
  }

  //Cette fonction détermine si un pseudo et un mot de passe correspondent à un utilisateur
  //Paramètres :
  //  $pseudo : pseudo à tester
  //  $pass : mot de passe à tester
  //Retourne vrai si le pseudo et le mot de passe correspondent à un utilisateur, faux sinon
  public function isUtilisateur($pseudo, $pass)
  {
    $salt = "48@!alsd";
    $password_crypte = MD5(MD5($pass).$salt);
    $req=$this->db->prepare("SELECT per_login, per_pwd FROM personne WHERE per_login=:pseudo AND per_pwd=:password_crypte;");
    $req->bindParam(':pseudo', $pseudo);
    $req->bindParam(':password_crypte', $password_crypte);
    $req->execute();
    $isMem = $req->fetch(PDO::FETCH_OBJ);
    return $isMem;
    $req->closeCursor();
  }

  //Cette fonction détermine si un id est celui d'un administrateur
  //Paramètres :
  //  $id : id à tester
  //Retourne vrai si l'id est celui d'un administrateur, faux sinon
  public function isAdminId($id)
  {
    $req=$this->db->prepare("SELECT per_num FROM personne WHERE per_num=:id AND per_admin=1;");
    $req->bindParam(':id', $id);
    $req->execute();
    $isAdm = $req->fetch(PDO::FETCH_OBJ);
    return $isAdm;
    $req->closeCursor();
  }

  //Cette procédure ajoute une personne dans la base de données
  //Paramètres :
  //  $nom : nom de la personne
  //  $prenom : prenom de la personne
  //  $tel : numéro de téléphone de la personne
  //  $mail : mail de la personne
  //  $login : login de la personne
  //  $mdp : mot de passe de la personne
  // UNE PERSONNE AJOUTEE N'EST PAS ADMIN (per_admin=0)
  public function ajouterPersonne($nom, $prenom, $tel, $mail, $login, $mdp)
  {
    $salt = "48@!alsd";
    $password_crypte = MD5(MD5($mdp).$salt);
    $admin=0;
    $req=$this->db->prepare("INSERT INTO personne(per_nom, per_prenom, per_tel, per_mail, per_admin, per_login, per_pwd)
                              VALUES(:nom, :prenom, :tel, :mail, :admin, :login, :passwd);");
    $req->bindParam(':nom', $nom);
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':tel', $tel);
    $req->bindParam(':mail', $mail);
    $req->bindParam(':admin', $admin);
    $req->bindParam(':login', $login);
    $req->bindParam(':passwd', $password_crypte);
    $req->execute();
    $_SESSION['LAST_ID_PERSONNE']=$this->db->lastInsertId();
    $req->closeCursor();
  }

  //Cette procedure modifie les caractèristiques d'une personne
  //Paramètre :
  //  $num : id de la personne
  //  $nom : nom de la personne
  //  $prenom : prenom de la personne
  //  $tel : numéro de téléphone de la personne
  //  $mail : mail de la personne
  //  $login : login de la personne
  //  $mdp : mot de passe de la personne
  public function modifierPersonne($num, $nom, $prenom, $tel, $mail, $login, $mdp)
  {
    if($this->isAdminId($num)) // si la personne était un admin
    {
      $admin=1;
    }
    else {
      $admin=0;
    }

    if(empty($mdp)) //si le mot de passe ne souhaite pas etre modifié
    {
      $req=$this->db->prepare("UPDATE personne SET
                                per_nom=:nom, per_prenom=:prenom, per_tel=:tel, per_mail=:mail, per_admin=:admin, per_login=:login
                                WHERE per_num=:num");
    }
    else {
      $salt = "48@!alsd";
      $password_crypte = MD5(MD5($mdp).$salt);
      $req=$this->db->prepare("UPDATE personne SET
                                per_nom=:nom, per_prenom=:prenom, per_tel=:tel, per_mail=:mail, per_admin=:admin, per_login=:login, per_pwd=:passwd
                                WHERE per_num=:num");
      $req->bindParam(':passwd', $password_crypte);
    }

    $req->bindParam(':num', $num);
    $req->bindParam(':nom', $nom);
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':tel', $tel);
    $req->bindParam(':mail', $mail);
    $req->bindParam(':admin', $admin);
    $req->bindParam(':login', $login);
    $req->execute();
    $req->closeCursor();
  }

  //Cette fonction retourne l'id d'une personne avec son pseudo
  //Paramètre :
  //  $pseudo : pseudo de la personne
  //Retourne l'id de la personne concernée
  public function getIdPseudo($pseudo)
  {
    $req=$this->db->prepare("SELECT per_num FROM personne WHERE per_login=:pseudo;");
    $req->bindParam(':pseudo', $pseudo);
    $req->execute();
    $id = $req->fetch(PDO::FETCH_OBJ);
    return $id;
    $req->closeCursor();
  }

  //Cette procedure supprime une personne de la base de données
  //Paramètre :
  //  $num : id de la personne à supprimer
  public function supprimerPersonne($num)
  {
    $req=$this->db->prepare("DELETE FROM personne WHERE per_num=:id;");
    $req->bindParam(':id', $num);
    $req->execute();
    $req->closeCursor();
  }

  //cette fonction retourne le nombre d'administrateur présent dans la base de données
  public function nbAdmin(){
    $admin=1;
    $req=$this->db->prepare("SELECT COUNT(per_num) AS nbAdmin FROM personne WHERE per_admin=:admin;");
    $req->bindParam(':admin', $admin);
    $req->execute();
    $nbAdmin = $req->fetch(PDO::FETCH_OBJ);
    return $nbAdmin->nbAdmin;
    $req->closeCursor();
  }

}
?>
