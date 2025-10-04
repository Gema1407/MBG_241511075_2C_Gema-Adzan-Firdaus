<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jika user belum login
        if (!session()->get('logged_in')) {
            // Maka redirect ke halaman login
            return redirect()->to('/login');
        }

        if ($arguments) {
            // Periksa apakah role user sesuai dengan yang diizinkan
            if (!in_array(session()->get('role'), $arguments)) {
                // Jika tidak sesuai, redirect ke halaman sebelumnya atau halaman utama
                 return redirect()->back();
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}