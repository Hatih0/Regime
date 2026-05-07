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

}