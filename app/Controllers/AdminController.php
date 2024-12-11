<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            if ($this->validate([
                'username' => 'required|min_length[3]',
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]',
                'csrf_test_name' => 'required|csrf',
            ])) {
                // Redirect to the login page after successful registration
                return redirect()->to('/admin/login');
            } else {
                // Set an error message
                session()->setFlashdata('error', 'Kayıt sırasında bir hata oluştu');
            }
        }

        // Load the registration view
        return view('admin/register');
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
        return redirect()->to('/admin/login')->with('success', 'Kayıt başarılı! Giriş yapabilirsiniz.');
    }

    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            if ($this->validate([
                'username' => 'required',
                'password' => 'required',
                'csrf_test_name' => 'required|csrf',
            ])) {
                // Redirect to the dashboard after a successful login
                return redirect()->to('/admin/dashboard');
            } else {
                // Set an error message
                session()->setFlashdata('error', 'Geçersiz kullanıcı adı veya şifre');
            }
        }

        // Load the login view
        return view('admin/login');
    }

    public function authenticate()
    {
        $db = \Config\MongoDB::connect();
        $collection = $db->admins;

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $collection->findOne(['username' => $username]);

        if ($admin && password_verify($password, $admin->password)) {
            // Set session data
            session()->set([
                'isAdmin' => true,
                'adminUsername' => $admin->username,
                'loggedIn' => true
            ]);

            // Set a cookie for 5 minutes
            $this->response->setCookie('admin_session', json_encode([
                'username' => $admin->username,
                'loggedIn' => true
            ]), 300);

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

        return view('admin/dashboard');
    }

    public function users()
    {
        $db = \Config\MongoDB::connect();
        $collection = $db->admins;
        $users = $collection->find()->toArray();

        return view('admin/users', ['users' => $users]);
    }

    public function deleteUser($id)
    {
        $db = \Config\MongoDB::connect();
        $collection = $db->admins;

        $collection->deleteOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);
        return redirect()->to('/admin/users')->with('success', 'Kullanıcı başarıyla silindi.');
    }

    public function content()
    {
        $db = \Config\MongoDB::connect();
        $collection = $db->site_content;
        $content = $collection->findOne();

        return view('admin/content', ['content' => $content]);
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
