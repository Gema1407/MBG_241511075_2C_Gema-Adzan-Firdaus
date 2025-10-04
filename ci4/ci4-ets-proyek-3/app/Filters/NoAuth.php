<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class NoAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jika user sudah login
        if (session()->get('logged_in')) {
            // Redirect ke dashboard sesuai rolenya
            if (session()->get('role') == 'gudang') {
                return redirect()->to('/gudang');
            } else {
                return redirect()->to('/dapur');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}