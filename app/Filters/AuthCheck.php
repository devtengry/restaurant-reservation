<?php
// Filters/AuthCheck.php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthCheck implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if ($session->has('lastActivity')) {
            $timeout = 300; // 5 dakika
            $elapsedTime = time() - $session->get('lastActivity');

            if ($elapsedTime > $timeout) {
                $session->destroy();
                return redirect()->to('/login')->with('error', 'Oturum süresi doldu.');
            }
        }

        // Oturum süresini güncelle
        $session->set('lastActivity', time());
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Gerekirse bir işlem yapabilirsiniz.
    }
}
