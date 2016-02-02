<?php
$db = new Mypdo();
$managerP = new PersonneManager($db);
$managerE = new EtudiantManager($db);
$managerS = new SalarieManager($db);

if(empty($_GET['personne'])) //si personne pas selectionnée
{?>
	<!-- liste des peronnes enregistrées -->
	<h1>Liste des personnes enregistrées</h1>
	<p>Actuellement <?php echo $managerP->getNbPersonnes()->nbPersonnes;?> personne(s) sont enregistrées </p>

	<table class="tableCli">
		<tr class="hautTableau">
			<td><b>Numéro     </b></td>
			<td><b>Nom        </b></td>
			<td><b>Prenom      </b></td>
		</tr>

		<?php
		//on recupere la liste de toutes les personnes présentent dans la base
		$listePersonnes = $managerP->getList();

		foreach($listePersonnes as $personne)
		{?>
			<tr>
				<td><a href="index.php?page=1&personne=<?php echo $personne->getNumPers();?> "> <?php echo $personne->getNumPers() ; ?> </a></td>
				<td> <?php echo $personne->getNomPers() ; ?> </td>
				<td> <?php echo $personne->getPrenomPers() ; ?> </td>
			</tr> <?php
		} ?>
	</table>

	<p> Cliquez sur le numéro d'une personne pour afficher plus de détails</p>

	<?php
	}
	else
	{
		$numPersonne = $_GET['personne'];

		//recuperer la liste des etudiants
		if($managerE->isEtudiant($numPersonne))
		{
			$etudiant = $managerE->getEtudiant($numPersonne);?>

			<h1>Détail sur l'étudiant <?php echo $etudiant->per_nom;?> </h1>
			<table class="tableCli">
				<tr class="hautTableau">
					<td><b>Prénom        	</b></td>
					<td><b>Mail          	</b></td>
					<td><b>Tel          	</b></td>
					<td><b>Département  	</b></td>
					<td><b>Ville        	</b></td>
				</tr>

				<tr>
					<td><?php echo $etudiant->per_prenom;?> 	</td>
					<td><?php echo $etudiant->per_mail;?>   	</td>
					<td><?php echo $etudiant->per_tel;?>     	</td>
					<td><?php echo $etudiant->dep_nom;?>      </td>
					<td><?php echo $etudiant->vil_nom;?>     	</td>
				</tr>
			</table>
			<?php
		}
	else
	{
		//recuperer la liste des salaries
		$salarie = $managerS->getSalarie($numPersonne);
		if($managerP->isPersonne($_GET['personne']))
		{?>
			<h1>Détail sur le salarié <?php echo $salarie->per_nom;?> </h1>
			<table class="tableCli">
				<tr class="hautTableau">
					<td><b>Prénom       </b></td>
					<td><b>Mail         </b></td>
					<td><b>Tel          </b></td>
					<td><b>Tel pro      </b></td>
					<td><b>Fonction     </b></td>
				</tr>

				<tr>
					<td><?php echo $salarie->per_prenom;?>    </td>
					<td><?php echo $salarie->per_mail;?>      </td>
					<td><?php echo $salarie->per_tel;?>       </td>
					<td><?php echo $salarie->sal_telprof;?>   </td>
					<td><?php echo $salarie->fon_libelle;?>   </td>
				</tr>
			</table><?php
		}
		else { //si le numero de la personne n'existe pas (entrée par URL)?>
			<h1>Erreur 404: Personne non trouvée</h1>
			<?php
		}
	}
}
?>
