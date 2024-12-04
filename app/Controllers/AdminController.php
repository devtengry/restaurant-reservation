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
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT) // Güvenli şifreleme
        ];

        $collection->insertOne($data);
        return redirect()->to('/admin/login')->with('success', 'Kayıt başarılı! Giriş yapabilirsiniz.');
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

        // Kullanıcı adı eşleşen bir admin arıyoruz
        $admin = $collection->findOne(['username' => $username]);

        if ($admin) {
            // Şifre doğrulaması
            if (password_verify($password, $admin->password)) {
                // Başarılı giriş
                session()->set([
                    'isAdmin' => true,
                    'adminUsername' => $admin->username,
                    'loggedIn' => true
                ]);
                return redirect()->to('/reservation/list');
            } else {
                return redirect()->back()->with('error', 'Yanlış şifre!');
            }
        } else {
            return redirect()->back()->with('error', 'Kullanıcı bulunamadı!');
        }
    }



    public function logout()
    {
        session()->destroy(); // Tüm oturum verilerini temizler
        return redirect()->to('/admin');
    }

}
