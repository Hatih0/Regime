<?php

namespace App\Controllers;

use App\Models\ActiviteSportiveModel;

class ExerciceController extends BaseController
{
    protected ActiviteSportiveModel $activiteModel;

    public function __construct()
    {
        $this->activiteModel = new ActiviteSportiveModel();
    }

    public function index()
    {
        $activites = $this->activiteModel->getAllActivites();
        return view('exercices/listeExercice', ['activites' => $activites]);
    }

    public function show($id)
    {
        $activite = $this->activiteModel->getActiviteById((int) $id);
        if (!$activite) {
            return redirect()->to('/exercices')->with('error', 'Activité sportive non trouvée.');
        }

        return view('exercices/showForm', ['activite' => $activite]);
    }

    public function create()
    {
        return view('exercices/showForm');
    }

    public function store()
    {
        $data = $this->request->getPost();

        if ($this->activiteModel->createActivite($data)) {
            return redirect()->to('/exercices')->with('success', 'Activité sportive créée avec succès.');
        }

        return redirect()->back()->with('error', 'Erreur lors de la création de l’activité sportive.');
    }

    public function update($id)
    {
        $data = $this->request->getPost();

        if ($this->activiteModel->updateActivite((int) $id, $data)) {
            return redirect()->to('/exercices')->with('success', 'Activité sportive mise à jour avec succès.');
        }

        return redirect()->back()->with('error', 'Erreur lors de la mise à jour de l’activité sportive.');
    }

    public function delete($id)
    {
        if ($this->activiteModel->deleteActivite((int) $id)) {
            return redirect()->to('/exercices')->with('success', 'Activité sportive supprimée avec succès.');
        }

        return redirect()->back()->with('error', 'Erreur lors de la suppression de l’activité sportive.');
    }
}