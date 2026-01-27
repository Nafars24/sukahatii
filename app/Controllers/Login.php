<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function authenticate()
    {
        $session = session();

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();

        // Cari user berdasarkan EMAIL
        $user = $userModel
            ->where('email', $email)
            ->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }

        // WAJIB pakai password_verify
        if (!password_verify($password, $user['password_hash'])) {
            return redirect()->back()->with('error', 'Password salah');
        }

        // Set session
        $session->set([
            'user_id'    => $user['id'] ?? null,
            'email'      => $user['email'],
            'username'   => $user['username'],
            'fullname'   => $user['fullname'],
            'id_kantor'  => $user['id_kantor'],
            'isLoggedIn' => true,
        ]);

        return redirect()->to('/');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}