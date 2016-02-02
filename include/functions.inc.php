<?php
	//Cette fonction transorme une date DD/MM/YYYY
	// et la traduit au format YYYY-MM-DD
	function getEnglishDate($date){
		$membres = explode('/', $date);
		$date = $membres[2].'-'.$membres[1].'-'.$membres[0];
		return $date;
	}

	//Cette fonction transorme une date YYYY-MM-DD
	// et la traduit au format DD/MM/YYYY
	function getFrenchDate($date){
		$membres = explode('-', $date);
		$date = $membres[2].'/'.$membres[1].'/'.$membres[0];
		return $date;
	}

	//cette fonction supprime les votes et la citation identifiee
	//Paramètre
	//	$citation : numero de la citation a supprimer avec les votes associés
	function supprimerVoteEtCitation($citation){
		$db = new Mypdo();
		$managerC = new CitationManager($db);
		$managerV = new VoteManager($db);
		$managerV->supprimerVoteCitation($citation);
		$managerC->supprimerCitation($citation);
	}
?>
