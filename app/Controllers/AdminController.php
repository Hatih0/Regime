<?php 

namespace App\Controllers;
use App\Models\AdminModel;
use App\Models\CodeRechargementModel;

class AdminController extends BaseController
{
    private AdminModel $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->codeModel = new CodeRechargementModel();
    }

    public function login()
    {
        $firstAdmin = $this->adminModel->first();
        return view('admin/login', ['firstAdmin' => $firstAdmin]);
    }

    public function authenticate()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if ($username == "admin" && $password == "admin123") {
            session()->set([
                'user_id'      => 1, 
                'nom'          => $username,
                'is_logged_in' => true,
            ]);
            return redirect()->to('/only-admin');
        }

      $user = $this->adminModel->checkUser($username, $password);

        if (!$user) {
            return redirect()->back()
                ->with('error', 'Nom ou mot de passe incorrect.');
        }

        session()->set([
            'user_id'      => $user['id'],
            'nom'          => $user['nom'],
            'is_logged_in' => true,
        ]);

        return redirect()->to('/only-admin');
    }

    public function onlyAdmin()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/adminAuth')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        return view('admin/only');
    }

    public function codesList()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/adminAuth')->with('error', 'Vous devez être connecté.');
        }

        $codes = $this->codeModel->findAll();
        return view('admin/codes', ['codes' => $codes]);
    }

    public function generateCodes()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/adminAuth')->with('error', 'Vous devez être connecté.');
        }

        $count = (int) $this->request->getPost('count');
        $montant = (float) $this->request->getPost('montant');
        if ($count <= 0 || $montant <= 0) {
            return redirect()->back()->with('error', 'Données invalides.');
        }

        $codes = $this->codeModel->generateCodes($count, $montant);
        return view('admin/generated_codes', ['codes' => $codes]);
    }
}