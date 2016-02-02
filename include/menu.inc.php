		<div id="menu">
			<div id="menuInt">
			 <p><a href="index.php?page=0"><img class = "icone" src="image/accueil.gif"  alt="Accueil"/>Accueil</a></p><?php
				if(!isset($_SESSION['pseudo'])) //utilisateur non connecté
					{?>
						<p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
						<ul>
							<li><a href="index.php?page=1">Lister</a></li>
						</ul>
						<p><img class="icone" src="image/citation.gif"  alt="Citation"/>Citations</p>
						<ul>
							<li><a href="index.php?page=2">Lister</a></li>
						</ul>
						<p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
						<ul>
							<li><a href="index.php?page=3">Lister</a></li>
						</ul><?php
					}
					else
					{
						$db = new Mypdo();
						$manager = new PersonneManager($db);
						if(!$manager->isAdminId($_SESSION['id'])) //utilisateur connecté NON ADMIN
						{?>
							<p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
							<ul>
								<li><a href="index.php?page=1">Lister</a></li>
								<li><a href="index.php?page=51">Ajouter</a></li>
							</ul>
							<p><img class="icone" src="image/citation.gif"  alt="Citation"/>Citations</p>
							<ul>
								<li><a href="index.php?page=2">Lister</a></li>
								<li><a href="index.php?page=52">Ajouter</a></li>
								<li><a href="index.php?page=60">Rechercher</a></li>
							</ul>
							<p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
							<ul>
								<li><a href="index.php?page=3">Lister</a></li>
								<li><a href="index.php?page=53">Ajouter</a></li>
								<li><a href="index.php?page=70">Modifier</a></li>
							</ul><?php
						}
						else { //administrateur ?>
							<p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
							<ul>
								<li><a href="index.php?page=1">Lister</a></li>
								<li><a href="index.php?page=51">Ajouter</a></li>
								<li><a href="index.php?page=100">Modifier</a></li>
								<li><a href="index.php?page=120">Supprimer</a></li>
							</ul>
							<p><img class="icone" src="image/citation.gif"  alt="Citation"/>Citations</p>
							<ul>
								<li><a href="index.php?page=2">Lister</a></li>
								<li><a href="index.php?page=60">Rechercher</a></li>
								<li><a href="index.php?page=110">Valider</a></li>
								<li><a href="index.php?page=121">Supprimer</a></li>
							</ul>
							<p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
							<ul>
								<li><a href="index.php?page=3">Lister</a></li>
								<li><a href="index.php?page=53">Ajouter</a></li>
								<li><a href="index.php?page=70">Modifier</a></li>
								<li><a href="index.php?page=122">Supprimer</a></li>
							</ul><?php
						}
					}echo "\n";?>
			</div>
		</div>
