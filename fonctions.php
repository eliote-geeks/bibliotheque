<?php 
function truncate_text($text,$maxchars=200,$points=1){
	//Test de la longeur d'un texte
	if (strlen($text) > $maxchars) {
		//Selection du maximum de mots
		$text = substr($text, 0, $maxchars);
		//recuperation de la position de la derniere espace
		$position_espace = strrpos($text, " ");
		$text = substr($text,0, $position_espace);
		//ajout des "..."
		if ($points == 1) {
			$text = $text."...";
		}
	}
	return $text;
}


function url_custom_encode($titre,$categorie=0){
	$titre = htmlspecialchars($titre);
	$find =    array('é','à','-','%20','','');	
	$replace = array('e','a',' ','-','','');
	$titre = str_replace($find, $replace, $titre);
	$titre = strtolower($titre);
	$mots = preg_split('/[^A-Z^a-z^0-9]+/', $titre);

	$encoded = "";
	foreach ($mots as $mot) {
		if ($categorie == 0) {
			if (strlen($mot) >=3 OR str_replace(['0','1','2','3','4','5','6','7','8','9'], '', $mot) != $mot) {
				$encoded .= $mot.'-';
			}else{
				$encoded .= $mot.'-';
			}
		}

	}

		$encoded = substr($encoded,0,-1);
		return $encoded;
}
function conversion($unite)
{

	$resultat = $unite / 1024;
	 // return number_format($resultat);
	 return $resultat;		
}






?>
