<?php 

namespace App\Controllers;
use App\Models\RegimeModel;

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

}