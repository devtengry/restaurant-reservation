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

        $admin = $collection->findOne(['username' => $username]);

        if ($admin && password_verify($password, $admin->password)) {
            // Oturum bilgileri
            session()->set([
                'isAdmin' => true,
                'adminUsername' => $admin->username,
                'loggedIn' => true
            ]);

            // Çerez ayarı - 5 dakika süreli
            $this->response->setCookie('admin_session', json_encode([
                'username' => $admin->username,
                'loggedIn' => true
            ]), 300); // 300 saniye = 5 dakika

            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->back()->with('error', 'Geçersiz kullanıcı adı veya şifre!');
        }

    }





    public function logout()
    {
        session()->destroy();
        $this->response->deleteCookie('admin_session');
        return redirect()->to('/admin/login')->with('success', 'Başarıyla çıkış yaptınız.');
    }

    public function dashboard()
    {
        if (!session()->get('isAdmin')) {
            return redirect()->to('/admin/login')->with('error', 'Bu sayfaya erişmek için giriş yapmalısınız.');
        }

        return view('admin_dashboard');
    }
    public function users()
    {
        $db = \Config\MongoDB::connect();
        $collection = $db->admins;
        $users = $collection->find()->toArray();
        return view('admin_users', ['users' => $users]);
    }

    public function deleteUser($id)
    {
        $db = \Config\MongoDB::connect();
        $collection = $db->admins;
        $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        return redirect()->to('/admin/users')->with('success', 'Kullanıcı başarıyla silindi.');
    }
    public function content()
    {
        $db = \Config\MongoDB::connect();
        $collection = $db->site_content;
        $content = $collection->findOne();
        return view('admin_content', ['content' => $content]);
    }

    public function updateContent()
    {
        $db = \Config\MongoDB::connect();
        $collection = $db->site_content;
        $homepageContent = $this->request->getPost('homepageContent');

        $collection->updateOne(
            [],
            ['$set' => ['homepage' => $homepageContent]],
            ['upsert' => true]
        );

        return redirect()->to('/admin/content')->with('success', 'İçerik başarıyla güncellendi.');
    }



}
