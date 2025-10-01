<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function loginForm($role)
    {
        if ($role !== 'gudang' && $role !== 'dapur') {
            return redirect()->to('/')->with('error', 'Peran tidak valid.');
        }
        $data['role'] = $role;
        return view('tampilan_login', $data);
    }

    public function processLogin()
    {
        $session = session();
        $userModel = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');
        $expectedRole = ($role === 'gudang') ? 'admin' : 'client';
        $user = $userModel->getUserByEmail($email);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                
                if ($user['role'] === $expectedRole) {
                    
                    $ses_data = [
                        'user_id'    => $user['id'],
                        'user_name'  => $user['name'],
                        'user_role'  => $user['role'],
                        'isLoggedIn' => TRUE
                    ];
                    $session->set($ses_data);
                    
                    return redirect()->to('/dashboard/' . $role)->with('success', 'Login berhasil! Selamat datang, ' . $user['name']);

                } else {
                    $session->setFlashdata('error', 'Peran yang Anda pilih tidak sesuai dengan akun Anda.');
                    return redirect()->back()->withInput();
                }

            } else {
                $session->setFlashdata('error', 'Password yang Anda masukkan salah.');
                return redirect()->back()->withInput();
            }
        } else {
            $session->setFlashdata('error', 'Email tidak ditemukan.');
            return redirect()->back()->withInput();
        }
    }
    
    public function registerForm($role)
    {
        if ($role !== 'gudang' && $role !== 'dapur') {
            return redirect()->to('/')->with('error', 'Peran pendaftaran tidak valid.');
        }

        $data['role'] = $role;
        
        return view('tampilan_register', $data); 
    }
}
