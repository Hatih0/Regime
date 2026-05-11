<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use App\Models\SanteUtilisateurModel;
use App\Models\ObjectifUtilisateurModel;
use App\Models\PortefeuilleModel;
use App\Models\CodeRechargementModel;
use App\Models\RechargementModel;

class UtilisateurController extends BaseController
{
    private UtilisateurModel $utilisateurModel; 
    private SanteUtilisateurModel $santeUtilisateurModel; 
    private ObjectifUtilisateurModel $objectifUtilisateurModel; 
    private PortefeuilleModel $portefeuilleModel;
    private CodeRechargementModel $codeModel;
    private RechargementModel $rechargementModel;
    
    public function __construct()
    {
        $this->utilisateurModel = new UtilisateurModel();
        $this->santeUtilisateurModel = new SanteUtilisateurModel();
        $this->objectifUtilisateurModel = new ObjectifUtilisateurModel();
        $this->portefeuilleModel = new PortefeuilleModel();
        $this->codeModel = new CodeRechargementModel();
        $this->rechargementModel = new RechargementModel();
    }

    public function wallet()
    {
        if (!session()->get('is_logged')) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté.');
        }

        $userId = session()->get('user_id');
        $port = $this->portefeuilleModel->getByUser($userId);
        if (! $port) {
            $this->portefeuilleModel->createForUser($userId);
            $port = $this->portefeuilleModel->getByUser($userId);
        }

        return view('wallet/wallet', ['portefeuille' => $port]);
    }

    public function rechargeWithCode()
    {
        if (!session()->get('is_logged')) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté.');
        }

        $codeText = trim((string) $this->request->getPost('code'));
        if (empty($codeText)) {
            return redirect()->back()->with('error', 'Code requis.');
        }

        $code = $this->codeModel->findByCode($codeText);
        if (! $code || $code['status'] !== 'valide') {
            return redirect()->back()->with('error', 'Code invalide ou déjà utilisé.');
        }

        $userId = session()->get('user_id');
        $port = $this->portefeuilleModel->getByUser($userId);
        if (! $port) {
            $this->portefeuilleModel->createForUser($userId);
            $port = $this->portefeuilleModel->getByUser($userId);
        }

        // add funds
        $this->portefeuilleModel->addFunds($userId, (float) $code['montant']);

        // mark code used
        $this->codeModel->markUsed((int) $code['id']);

        // create rechargement record
        $this->rechargementModel->createRecord((int) $port['id'], (int) $code['id']);

        return redirect()->to('/wallet')->with('success', 'Rechargement effectué. +'.$code['montant'].'€');
    }

    public function index()
    {   
        return view('dashboard/index');
    }

    public function login(): string
    {
        return view('login/login', [
            'firstUser' => $this->utilisateurModel->first(),
        ]);
    }

    public function checkUser()
    {
        $nom = trim((string) $this->request->getPost('nom'));
        $password = (string) $this->request->getPost('password');

        if (empty($nom) || empty($password)) {
            return redirect()->back()
                ->with('error', 'Nom et mot de passe requis.');
        }

        if ($nom == "user" && $password == "user123") {
            session()->set([
                'user_id'      => 1, 
                'nom'          => $nom,
                'is_logged' => true,
            ]);
            return redirect()->to('/user-profile');
        }

        $user = $this->utilisateurModel->checkUser($nom, $password);

        if (! $user) {
            return redirect()->back()
                ->with('error', 'Nom ou mot de passe incorrect.');
        }

        session()->set([
            'user_id'      => $user['id'],
            'nom'          => $user['nom'],
            'is_logged' => true,
        ]);

        return redirect()->to('/user-profile');
    }

    public function profil()
    {
        if (!session()->get('is_logged')) {
            return redirect()->to('/userAuth')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        $userId = session()->get('user_id');
        $user = $this->utilisateurModel->find($userId);

        if (!$user) {
            $user = [
                'nom' => 'user',
                'date_inscription' => date('Y-m-d'),
                'genre' => 'Homme',
                'gold' => FALSE,
            ];
        }

        // return redirect()->to('/user-profile');
        return view('user/userProfil', ['user' => $user]);
    }

    public function signin(): string
    {
        return view('signin/signin');
    }

    public function createUser()
    {
        $nom = trim((string) $this->request->getPost('nom'));
        $email = trim((string) $this->request->getPost('email'));
        $mot_de_passe = (string) $this->request->getPost('mot_de_passe');
        $genre = (string) $this->request->getPost('genre');

        if (empty($nom) || empty($mot_de_passe) || empty($genre)) {
            return redirect()->to('/signin');
        }

        $poids = (float) $this->request->getPost('poids');
        $taille = (float) $this->request->getPost('taille');

        try {
            $createdId = $this->utilisateurModel->createUser($nom, $email, $mot_de_passe, $genre);
            $createdSanteId = $this->santeUtilisateurModel->createSanteInfo($createdId, $poids, $taille);

            if (! $createdId || ! $createdSanteId) {
                return redirect()->to('/signin');
            }
            return redirect()->to('/login');
            
        } catch (\Exception $e) {
            return redirect()->to('/signin');
        }
    }

    public function getUserProfile()
    {
        $id_utilisateur = session()->get('user_id');
        
        if (!$id_utilisateur) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté.');
        }
        
        $objectifsInfos = $this->objectifUtilisateurModel->getAllObjectifUser($id_utilisateur);
        $santeInfos = $this->santeUtilisateurModel->getAllSanteInfoUser($id_utilisateur);
        $user = $this->utilisateurModel->getInfoUser($id_utilisateur);
        $imcInfos = $this->santeUtilisateurModel->calculIMC($id_utilisateur);
        // $objectifs = $this->objectifUtilisateurModel->getAllObjectifs($id_utilisateur);

        $data = [
            'user' => $user,
            'objectifsInfos' => $objectifsInfos,
            'santeInfos' => $santeInfos,
            'imc' => $imcInfos
            // ,'objectifs' => $objectifs
        ];
        
        return view('profile/profile', $data);
    }

    public function updateUtilisateur()
    {
        $id_utilisateur = session()->get('user_id');
        
        if (!$id_utilisateur) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté.');
        }
        
        $nom = trim((string) $this->request->getPost('nom'));
        $email = trim((string) $this->request->getPost('email'));
        $genre = (string) $this->request->getPost('genre');

        if (empty($nom) || empty($email) || empty($genre)) {
            return redirect()->back()->with('error', 'Tous les champs sont requis.');
        }

        $updated = $this->utilisateurModel->updateUtilisateur($id_utilisateur, $nom, $email, $genre);
        
        if ($updated) {
            return redirect()->back()->with('success', 'Informations mises à jour.');
        }
        
        return redirect()->back()->with('error', 'Erreur lors de la mise à jour.');
    }

    public function updateSante()
    {
        $id_utilisateur = session()->get('user_id');
        
        if (!$id_utilisateur) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté.');
        }
        
        $poids = (float) $this->request->getPost('poids');
        $taille = (float) $this->request->getPost('taille');

        if ($poids <= 0 || $taille <= 0) {
            return redirect()->back()->with('error', 'Les valeurs doivent être positives.');
        }

        $created = $this->santeUtilisateurModel->createSanteInfo($id_utilisateur, $poids, $taille);
        
        if ($created) {
            return redirect()->back()->with('success', 'Nouvelle mesure enregistrée.');
        }
        
        return redirect()->back()->with('error', 'Erreur lors de l\'enregistrement.');
    }

    public function updateObjectif()
    {
        $id_utilisateur = session()->get('user_id');
        
        if (!$id_utilisateur) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté.');
        }
        
        $id_objectif = (int) $this->request->getPost('id_objectif');
        $poids = (float) $this->request->getPost('poids');

        if (!in_array($id_objectif, [1, 2, 3]) || $poids <= 0) {
            return redirect()->back()->with('error', 'Données invalides.');
        }

        $created = $this->objectifUtilisateurModel->createObjectifUser($id_utilisateur, $id_objectif, $poids);
        
        if ($created) {
            return redirect()->back()->with('success', 'Nouvel objectif enregistré.');
        }
        
        return redirect()->back()->with('error', 'Erreur lors de l\'enregistrement.');
    }

    public function goldPage()
    {
        if (!session()->get('is_logged')) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté.');
        }

        $userId = session()->get('user_id');
        $user = $this->utilisateurModel->find($userId);
        $goldPrice = 99.99; // Prix unique de l'option Gold
        
        $port = $this->portefeuilleModel->getByUser($userId);
        if (!$port) {
            $this->portefeuilleModel->createForUser($userId);
            $port = $this->portefeuilleModel->getByUser($userId);
        }

        return view('user/gold_option', [
            'user' => $user,
            'goldPrice' => $goldPrice,
            'solde' => (float) $port['solde']
        ]);
    }

    public function buyGold()
    {
        if (!session()->get('is_logged')) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté.');
        }

        $userId = session()->get('user_id');
        $user = $this->utilisateurModel->find($userId);
        $goldPrice = 99.99;

        // Vérifier si déjà Gold
        if ($user && (bool) $user['gold']) {
            return redirect()->to('/user-profile')->with('error', 'Vous avez déjà l\'option Gold.');
        }

        // Vérifier solde
        $port = $this->portefeuilleModel->getByUser($userId);
        if (!$port || (float) $port['solde'] < $goldPrice) {
            return redirect()->back()->with('error', 'Solde insuffisant. Il vous manque ' . number_format($goldPrice - ($port['solde'] ?? 0), 2) . '€');
        }

        // Déduire du portefeuille
        $newSolde = (float) $port['solde'] - $goldPrice;
        $this->portefeuilleModel->update($port['id'], ['solde' => $newSolde]);

        // Activer Gold pour l'utilisateur
        $this->utilisateurModel->update($userId, ['gold' => true]);

        return redirect()->to('/user-profile')->with('success', 'Option Gold activée ! Vous bénéficiez maintenant de 15% de remise sur tous les régimes.');
    }

}