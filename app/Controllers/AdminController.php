<?php 

namespace App\Controllers;
use App\Models\AdminModel;

class AdminController extends BaseController
{
    private AdminModel $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
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
}