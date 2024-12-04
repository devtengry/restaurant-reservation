<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthCheck implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $cookie = $request->getCookie('admin_session');

        if (!$session->get('loggedIn')) {
            $cookie = $request->getCookie('admin_session');
            if ($cookie) {
                $data = json_decode($cookie, true);
                if ($data && $data['loggedIn']) {
                    $session->set([
                        'isAdmin' => true,
                        'adminUsername' => $data['username'],
                        'loggedIn' => true
                    ]);
                } else {
                    return redirect()->to('/admin/login')->with('error', 'Oturumunuz sona erdi, lütfen yeniden giriş yapın.');
                }
            } else {
                return redirect()->to('/admin/login')->with('error', 'Lütfen giriş yapın.');
            }
        }


        if (!$session->get('loggedIn')) {
            return redirect()->to('/admin/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // İşlem sonrası herhangi bir şey yok
    }
}
