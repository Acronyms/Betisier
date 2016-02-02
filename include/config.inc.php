<?php
// Paramètres de l'application Bétisier
// A modifier en fonction de la configuration

//permet la connexion à la base de données
  define('DBHOST', "localhost"); //hote
  define('DBNAME', "betisier"); //nom de la base
  define('DBUSER', "bd"); //nom de l'utilisateur
  define('DBPASSWD', "bede"); //mot de passe de l'utilisateur
  define('ENV','dev');  //environnement de travail
// pour un environememnt de production remplacer 'dev' (d�veloppement) par 'prod' (production)
// les messages d'erreur du SGBD s'affichent dans l'environememnt dev mais pas en prod
?>
