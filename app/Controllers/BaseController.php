<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    protected $request;
    protected $helpers = [];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
    }

    public function __construct()
    {
        helper(['url', 'session']);
        $this->checkSessionTimeout();
    }

    private function checkSessionTimeout()
    {
        $session = session();

        if ($session->has('lastActivity')) {
            $timeout = 300;
            $elapsedTime = time() - $session->get('lastActivity');

            if ($elapsedTime > $timeout) {
                $session->destroy();
                return redirect()->to('/login')->with('error', 'Oturum süreniz doldu.');
            }
        }

        $session->set('lastActivity', time());
    }
}
