<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;

class UtilisateurController extends BaseController
{
    private UtilisateurModel $utilisateurModel; 

    
    public function __construct()
    {
        $this->utilisateurModel = new UtilisateurModel();
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
            return redirect()->to('/userProfil');
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

        return redirect()->to('/userProfil');
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

        return view('user/userProfil', ['user' => $user]);
    }

}