<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Redirect implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Tidak digunakan karena filter ini dijalankan SETELAH
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Cek jika route sekarang adalah login dan request-nya POST
        if (service('router')->controllerName() === 'App\Controllers\Auth' && $request->getMethod() === 'post') {
            $session = session();

            // Cek apakah login sukses berdasarkan session
            if ($session->get('logged_in') === true) {
                // Redirect ke halaman produk
                return redirect()->to('v_produk');
            }
        }
    }
}
