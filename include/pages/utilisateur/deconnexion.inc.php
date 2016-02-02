<p>
  <!-- message de confirmation -->
  <img src="image/valid.png" alt="ImageValide" /> Vous avez bien été deconnecté <br/>
  Redirection automatique dans 2 secondes
  <?php
   session_destroy(); //destruction de la session (et toutes les variables associées)
   header ("Refresh:2;URL=index.php?page=0"); //redirection dans 2 secondes
  ?>
</p>
