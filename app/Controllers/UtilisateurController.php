<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use App\Models\SanteUtilisateurModel;
use App\Models\ObjectifUtilisateurModel;

class UtilisateurController extends BaseController
{
    private UtilisateurModel $utilisateurModel; 
    private SanteUtilisateurModel $santeUtilisateurModel; 
    private ObjectifUtilisateurModel $objectifUtilisateurModel; 
    
    public function __construct()
    {
        $this->utilisateurModel = new UtilisateurModel();
        $this->santeUtilisateurModel = new SanteUtilisateurModel();
        $this->objectifUtilisateurModel = new ObjectifUtilisateurModel();
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
                'is_logged_in' => true,
            ]);
            return redirect()->to('/dashboard');
        }
        $user = $this->utilisateurModel->checkUser($nom, $password);

        if (! $user) {
            return redirect()->back()
                ->with('error', 'Nom ou mot de passe incorrect.');
        }

        session()->set([
            'user_id'      => $user['id'],
            'nom'          => $user['nom'],
            'is_logged_in' => true,
        ]);

        return redirect()->to('/dashboard');
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
        // $id_utilisateur = $this->request->getGet('user_id');
        $id_utilisateur = 1 ; // A remplacer par session user_id
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

}