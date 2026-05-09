<?php
/**
 * Générateur de PDF — FPDF
 * composer require setasign/fpdf
 * 
 * À placer dans : app/Libraries/PDFModel.php
 */

namespace App\Libraries;

$fpdfLoaded = false;
$vendorAutoload = ROOTPATH . 'vendor/autoload.php';
if (file_exists($vendorAutoload)) {
    require_once $vendorAutoload;
    if (class_exists('FPDF')) $fpdfLoaded = true;
}
if (!$fpdfLoaded) {
    $vendorDirect = ROOTPATH . 'vendor/setasign/fpdf/fpdf.php';
    if (file_exists($vendorDirect)) {
        require_once $vendorDirect;
        if (class_exists('FPDF')) $fpdfLoaded = true;
    }
}
if (!$fpdfLoaded) {
    $thirdParty = APPPATH . 'ThirdParty/fpdf/fpdf.php';
    if (file_exists($thirdParty)) {
        require_once $thirdParty;
        if (class_exists('FPDF')) $fpdfLoaded = true;
    }
}

if (!$fpdfLoaded && !class_exists('FPDF')) {
    class FPDF {
        public function __construct() {
            throw new \RuntimeException("FPDF library not found. Install it with: composer require setasign/fpdf");
        }
    }
}



class PDFModel extends \FPDF
{
    private string $titreDocument;

    public function setTitreDocument(string $titre)
    {
        $this->titreDocument = $titre;
    }

    private function encode(string $texte): string
    {
        return mb_convert_encoding($texte, 'ISO-8859-1', 'UTF-8');
    }

    public function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(33, 97, 140);
        $this->Cell(0, 10, $this->encode($this->titreDocument ?? 'Document'), 0, 1, 'C');
        $this->SetDrawColor(33, 97, 140);
        $this->Line(10, 20, 200, 20);
        $this->Ln(5);
    }

    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(150, 150, 150);
        $this->Cell(0, 10, 'Page ' . $this->encode($this->PageNo()) . ' / {nb}', 0, 0, 'C');
    }
    
    /**
     * Ajoute un titre de section
     */
    public function ajouterTitre(string $texte, int $niveau = 2)
    {
        $tailles = [1 => 16, 2 => 13, 3 => 11];
        $this->SetFont('Arial', 'B', $tailles[$niveau] ?? 11);
        $this->SetTextColor(20, 20, 20);
        $this->Ln($niveau === 1 ? 5 : 3);
        $this->Cell(0, 10, $this->encode($texte), 0, 1);
        $this->Ln(2);
    }
    
    /**
     * Ajoute un paragraphe
     */
    public function ajouterParagraphe(string $texte, int $taille = 11)
    {
        $this->SetFont('Arial', '', $taille);
        $this->SetTextColor(60, 60, 60);
        $this->MultiCell(0, 7, $this->encode($texte), 0, 'L');
        $this->Ln(3);
    }
    
    /**
     * Ajoute un tableau structuré
     */
    public function ajouterTableau(array $entetes, array $lignes, array $largeurs = [])
    {
        $nbCols = count($entetes);
        if (empty($largeurs)) {
            $largeurs = array_fill(0, $nbCols, 190 / $nbCols);
        }

        // En-têtes
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(33, 97, 140);
        $this->SetTextColor(255, 255, 255);
        foreach ($entetes as $i => $entete) {
            $this->Cell($largeurs[$i], 9, $this->encode($entete), 1, 0, 'C', true);
        }
        $this->Ln();

        // Lignes
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(40, 40, 40);
        foreach ($lignes as $index => $ligne) {
            $this->SetFillColor(...($index % 2 === 0 ? [240, 248, 255] : [255, 255, 255]));
            foreach ($ligne as $i => $cellule) {
                $this->Cell($largeurs[$i] ?? 40, 8, $this->encode((string)$cellule), 1, 0, 'L', true);
            }
            $this->Ln();
        }
        $this->Ln(5);
    }
    
    /**
     * Ajoute une alerte (info, succès, erreur, warning)
     */
    public function ajouterAlerte(string $texte, string $type = 'info')
    {
        $couleurs = [
            'info'    => [219, 234, 254],
            'succes'  => [220, 252, 231],
            'erreur'  => [254, 226, 226],
            'warning' => [254, 243, 199],
        ];
        $this->SetFillColor(...($couleurs[$type] ?? $couleurs['info']));
        $this->SetFont('Arial', 'I', 10);
        $this->SetTextColor(40, 40, 40);
        $this->MultiCell(0, 8, '  ' . $this->encode($texte), 1, 'L', true);
        $this->Ln(4);
    }
    
    /**
     * Ajoute une ligne de séparation décorative
     */
    public function ajouterSeparateur()
    {
        $this->Ln(3);
        $this->SetDrawColor(33, 97, 140);
        $this->SetLineWidth(0.5);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->Ln(3);
    }
}
