<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function register()
    {
        return view('admin_register');
    }

    public function createAdmin()
    {
        $db = \Config\MongoDB::connect();
        $collection = $db->admins;

        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT)
        ];

        $collection->insertOne($data);
        return redirect()->to('/admin/login');
    }

    public function login()
    {
        return view('admin_login');
    }

    public function authenticate()
    {
        $db = \Config\MongoDB::connect();
        $collection = $db->admins;

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $admin = $collection->findOne(['username' => $username]);

        if ($admin && password_verify($password, $admin->password)) {
            session()->set('isAdmin', true);
            return redirect()->to('/reservation/list');
        }

        return redirect()->back()->with('error', 'Geçersiz giriş bilgileri!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
