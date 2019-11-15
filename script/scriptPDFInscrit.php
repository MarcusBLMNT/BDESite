<?php
// la classe de fonctions
require('../public/assets/fpdf.php');
$bdd = new PDO(
    'mysql:host=localhost;dbname=projetweb;charset=utf8',
    'root',
    ''
);

// classe étendue pour créer en-tête et pied de page
class PDF extends FPDF
{
    // en-tête
    function Header()
    {
        //Police Arial gras 15
        $this->SetFont('Arial', 'B', 14);
        //Décalage à droite
        $this->Cell(80);
        //Titre
        $this->Cell(30, 10, 'Liste Inscrit', 0, 0, 'C');
        //Saut de ligne
        $this->Ln(20);
    }

    // pied de page
    function Footer()
    {
        //Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        //Police Arial italique 8
        $this->SetFont('Arial', 'I', 8);
        //Numéro de page
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
// création du pdf
$pdf = new PDF();
$pdf->SetAuthor('BDE BORDEAUX');
$pdf->SetTitle('Liste Inscrit');
$pdf->SetSubject('Un exemple de création de fichier PDF');
$pdf->SetCreator('fpdf_cybermonde_org');
$pdf->AliasNBPages();
$pdf->AddPage();

$requete = $bdd->prepare('CALL list_inscrit(1);');
//$requete->bindValue(':id_event', $id_evenement, PDO::PARAM_STR);
$requete->execute();
// on boucle  
while ($row =  $requete->fetch(PDO::FETCH_ASSOC)) {
    $id = $row["pseudo"];
    $titre = $row["nom"];
    $description = $row["prenom"];
    // titre en gras
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Write(5, $titre);
    $pdf->Ln();
    // description
    $pdf->SetFont('Arial', '', 10);
    $pdf->Write(3, $description);
    $pdf->Ln();
    $pdf->Ln();
}
// sortie du fichier
$pdf->Output('monfichier.pdf', 'I');
