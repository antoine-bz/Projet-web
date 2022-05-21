<?php
$idEtudiant=getIdEtudiant(valider("idUser","SESSION"));
$rep=getReponseEtudiant($idEtudiant);

echo "<h1>Réponses positives</h1>";
foreach($rep as $annonce)
	{
        if ($annonce["rep"]=="yes"){	
		mkAnnoncePreview($annonce["idAnnonces"],"previewAnnonce");
        }
	}
echo "<h1>Réponses negatives</h1>";
foreach($rep as $annonce){
        if ($annonce["rep"]=="no"){	
        mkAnnoncePreview($annonce["idAnnonces"],"previewAnnonce");
        }
}
echo "<h1>Réponses en attentes</h1>";
foreach($rep as $annonce){
        if (!$annonce["rep"]){	
        mkAnnoncePreview($annonce["idAnnonces"],"previewAnnonce");
        }
}
?>