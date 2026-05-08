<?php

namespace App\Controllers;

use App\Models\ObjectifUtilisateurModel;

class ObjectifUtilisateurController extends BaseController
{
    private ObjectifUtilisateurModel $objectifUtilisateurModel;

    
    public function __construct()
    {
        $this->objectifUtilisateurModel = new ObjectifUtilisateurModel();
    }

    public function choixObjectif () {
        return view('objectif/choix-objectif');
    }

    // $routes->post('/create-objectif', 'ObjectifUtilisateurController::createObjectifUser');
    // public function createObjectifUser(int $id_utilisateur, int $choix, float $poids): int
    public function createObjectifUser()
    {

        //A convertir en session 
        $id_utilisateur = (int) $this->request->getPost('id');
        $poids = (float) $this->request->getPost('poids');
        $id_objectif = (int) $this->request->getPost('choix');

        if (empty($id_utilisateur) || empty($id_objectif) || empty($poids)) {
            return redirect()->to('/choix-objectif');
        }

        try {
            $createdId = $this->objectifUtilisateurModel->createObjectifUser($id_utilisateur, $id_objectif, $poids);

            if (! $createdId ) {
                return redirect()->to('/choix-objectif');
            }
            return redirect()->to('/dashboard');
            
        } catch (\Exception $e) {
            return redirect()->to('/choix-objectif');
            
        }
    }

    public function getAllObjectifByUserId(int $id_utilisateur): ?array
    {
        return $this->objectifUtilisateurModel->getAllObjectifByUserId($id_utilisateur);
    }

}