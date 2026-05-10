<?php 

namespace App\Controllers;
use App\Models\RegimeModel;
use App\Models\ActiviteModel;
use App\Models\CombinaisonModel;
use App\Models\UtilisateurModel;
use App\Models\SanteUtilisateurModel;
use App\Models\ObjectifUtilisateurModel;
use App\Libraries\PDFModel;

class RegimeController extends BaseController
{
    protected $regimeModel;

    public function __construct()
    {
        $this->regimeModel = new RegimeModel();
    }

    public function index()
    {
        $regimes = $this->regimeModel->getAllRegimes();
        return view('regime/listeRegime', ['regimes' => $regimes]);
    }

    public function show($id)
    {
        $regime = $this->regimeModel->getRegimeById($id);
        if (!$regime) {
            return redirect()->to('/regimes')->with('error', 'Régime non trouvé.');
        }
        return view('regime/showForm', ['regime' => $regime]);
    }

    public function create()
    {
        return view('regime/showForm');
    }

    public function store()
    {
        $data = $this->request->getPost();
        if ($this->regimeModel->createRegime($data)) {
            return redirect()->to('/regimes')->with('success', 'Régime créé avec succès.');
        }
        return redirect()->back()->with('error', 'Erreur lors de la création du régime.');
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        if ($this->regimeModel->updateRegime($id, $data)) {
            return redirect()->to('/regimes')->with('success', 'Régime mis à jour avec succès.');
        }
        return redirect()->back()->with('error', 'Erreur lors de la mise à jour du régime.');
    }

    public function delete($id)
    {
        if ($this->regimeModel->deleteRegime($id)) {
            return redirect()->to('/regimes')->with('success', 'Régime supprimé avec succès.');
        }
        return redirect()->back()->with('error', 'Erreur lors de la suppression du régime.');
    }

        public function calculRegime()
    {
        $choix = $this->request->getPost('regime');

        $weights = [
            'rapide'     => [0.6, 0.2, 0.2],
            'economique' => [0.2, 0.7, 0.1],
            'sportif'    => [0.2, 0.1, 0.7],
        ];

        [$w1, $w2, $w3] = $weights[$choix] ?? [0.33, 0.33, 0.33];

        $id_utilisateur = session()->get('user_id');

        $objectifUserModel = new ObjectifUtilisateurModel();

        // getPoidsObjectif retourne déjà une variation signée :
        //   > 0  → prise de masse
        //   < 0  → perte de poids
        //   (cas IMC : positif ou négatif selon l'écart au poids cible)
        $variation_objectif = floatval($objectifUserModel->getPoidsObjectif($id_utilisateur));

        if ($variation_objectif == 0.0) {
            // L'utilisateur est déjà à son objectif
            return view('regime/resultat-regime', [
                'resultat' => [
                    'choix'              => $choix,
                    'variation_objectif' => 0.0,
                    'meilleure'          => null,
                    'nb_jours'           => 0,
                    'prix_total'         => 0.0,
                    'w'                  => [$w1, $w2, $w3],
                    'message'            => 'Vous avez déjà atteint votre objectif de poids.',
                ]
            ]);
        }

        $activiteModel = new ActiviteModel();
        $combModel     = new CombinaisonModel();
        $utilisateurModel = new UtilisateurModel();

        $allRegimes   = $this->regimeModel->getAllRegimes();
        $allActivites = $activiteModel->getAll();

        // Les combinaisons incompatibles (mauvais sens) seront automatiquement
        // écartées par get_efficacite_combinaison (retourne PHP_INT_MAX → score ≈ 0)
        $combinaisons         = $combModel->get_combinaisons_filtres($allRegimes, $allActivites);
        $meilleurecombinaison = $combModel->get_meilleure_combinaison($combinaisons, $variation_objectif, $w1, $w2, $w3);

        $prix_total = $meilleurecombinaison['prix_total'];
        
        // Appliquer remise Gold de 15% si applicable
        $user = $utilisateurModel->find($id_utilisateur);
        $remise_appliquee = false;
        if ($user && (bool) $user['gold']) {
            $prix_total = $prix_total * 0.85;  // 15% de remise
            $remise_appliquee = true;
        }

        $resultat = [
            'choix'              => $choix,
            'variation_objectif' => $variation_objectif,   // signée, utile en vue
            'meilleure'          => $meilleurecombinaison['combinaison'],
            'nb_jours'           => $meilleurecombinaison['nb_jours'],
            'prix_total'         => $prix_total,
            'w'                  => [$w1, $w2, $w3],
            'remise_gold'        => $remise_appliquee,
        ];

        return view('regime/resultat-regime', ['resultat' => $resultat]);
    }

    public function choixRegime()
    {
        return view('regime/choix-regime');
    }

    private function encode(string $texte): string
    {
        return mb_convert_encoding($texte, 'ISO-8859-1', 'UTF-8');
    }

    public function pdfExport()
    {
        // Récupération des données
        $data = $this->request->getPost('data');
        
        if (empty($data)) {
            return redirect()->back()->with('error', 'Aucune donnée à exporter');
        }
        
        // Décodage des données
        $resultat = @unserialize(base64_decode($data));
        
        if (!$resultat || !is_array($resultat)) {
            return redirect()->back()->with('error', 'Données invalides');
        }
        
        // Nettoyer le buffer de sortie
        ob_clean();
        
        try {
            // Création du PDF
            $pdf = new PDFModel('P', 'mm', 'A4');
            $pdf->setTitreDocument($this->encode('Plan'));
            $pdf->AliasNbPages();
            $pdf->AddPage();
            
            
            // Titre principal
            $pdf->SetFont('Arial', 'B', 22);
            $pdf->SetTextColor(33, 97, 140);
            $pdf->Cell(0, 12, $this->encode('Plan de Régime Personnalisé'), 0, 1, 'C');
            
            // Sous-titre
            $pdf->SetFont('Arial', 'I', 11);
            $pdf->SetTextColor(100, 100, 100);
            $pdf->Cell(0, 8, $this->encode('Généré le ' . date('d/m/Y à H:i')   ), 0, 1, 'C');
            $pdf->Ln(5);
            
            $pdf->ajouterSeparateur();
            
            
            $pdf->ajouterTitre('Informations Générales', 2);
            
            $pdf->ajouterParagraphe(sprintf(
                "Type de profil : %s\n" .
                "Objectif : %s kg\n" .
                "Durée du plan : %d jours\n" .
                "Budget total : %s Ar",
                ucfirst($resultat['choix'] ?? 'Non spécifié'),
                ($resultat['variation_objectif'] ?? 0) > 0 ? '+' . $resultat['variation_objectif'] : $resultat['variation_objectif'],
                $resultat['nb_jours'] ?? 0,
                number_format($resultat['prix_total'] ?? 0, 2, ',', ' ')
            ));
            
            // Pondérations
            if (!empty($resultat['w'])) {
                $pdf->ajouterParagraphe(sprintf(
                    "Pondérations : Régimes %.0f%% / Activités %.0f%% / Prix %.0f%%",
                    ($resultat['w'][0] ?? 0) * 100,
                    ($resultat['w'][1] ?? 0) * 100,
                    ($resultat['w'][2] ?? 0) * 100
                ), 10);
            }
            
            $pdf->ajouterSeparateur();
            
            
            if (!empty($resultat['meilleure']['regimes'])) {
                
                if ($pdf->GetY() > 200) {
                    $pdf->AddPage();
                }
                
                $pdf->ajouterTitre('Régimes Alimentaires Recommandés', 2);
                $pdf->ajouterParagraphe('Les régimes suivants ont été sélectionnés selon vos objectifs :', 10);
                $pdf->Ln(2);
                
                // Construction du tableau
                $entetes = ['Régime', 'Viande%', 'Poisson%', 'Volaille%', 'Var./jour', 'Prix (Ar)'];
                $largeurs = [45, 22, 22, 22, 25, 20, 34];
                $lignes = [];
                
                foreach ($resultat['meilleure']['regimes'] as $regime) {
                    $lignes[] = [
                        $regime['nom'] ?? '',
                        number_format($regime['pourcentage_viande'] ?? 0, 2) . '%',
                        number_format($regime['pourcentage_poisson'] ?? 0, 2) . '%',
                        number_format($regime['pourcentage_volaille'] ?? 0, 2) . '%',
                        number_format($regime['variation_poids'] ?? 0, 2) . ' kg',
                        number_format($regime['prix'] ?? 0, 0, ',', ' ') . ' Ar'
                    ];
                }
                
                $pdf->ajouterTableau($entetes, $lignes, $largeurs);
                
            }
            
            if (!empty($resultat['meilleure']['activites'])) {
                if ($pdf->GetY() > 220) {
                    $pdf->AddPage();
                }
                
                $pdf->ajouterSeparateur();
                $pdf->ajouterTitre('Activités Sportives Recommandées', 2);
                $pdf->ajouterParagraphe('Pour optimiser vos résultats, pratiquez ces activités :', 10);
                $pdf->Ln(2);
                
                $entetes = ['Activité', 'Variation/jour', 'Durée recommandée'];
                $largeurs = [90, 50, 50];
                $lignes = [];
                
                foreach ($resultat['meilleure']['activites'] as $activite) {
                    $lignes[] = [
                        $this->encode($activite['nom'] ?? ''),
                        number_format($activite['variation_poids'] ?? 0, 2) . ' kg',
                        ($activite['duree'] ?? 0) . ' heures/semaine'
                    ];
                }
                
                $pdf->ajouterTableau($entetes, $lignes, $largeurs);
            }

            
            // Génération du PDF
            $pdf->Output('I', 'Plan_Regime_' . date('Y-m-d') . '.pdf');
            exit;
            
        } catch (\Exception $e) {
            log_message('error', '[PDF Export] Erreur : ' . $e->getMessage());
            return redirect()->to('/choix-regime')->with('error', 'Une erreur est survenue lors de la génération du PDF. Veuillez réessayer.');
        }
    }

}