<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function saveRegister()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        // Check if username exists
        if ($userModel->where('username', $username)->first()) {
            return redirect()->back()->with('error', 'Username already taken.');
        }

        $userModel->save([
            'username' => $username,
            'password' => $password
        ]);

        return redirect()->to('/login')->with('success', 'Registration successful! You can now log in.');
    }

    public function verifyLogin()
{
    $userModel = new UserModel();
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    // Hardcoded admin credentials
    $hardcodedAdmin = [
        'username' => 'admin',
        'password' => 'admin123', // plaintext password
        'id'       => 0,
        'role'     => 'admin'
    ];

    // Check hardcoded admin first
    if ($username === $hardcodedAdmin['username'] && $password === $hardcodedAdmin['password']) {
        session()->set([
            'user_id'   => $hardcodedAdmin['id'],
            'user_name' => $hardcodedAdmin['username'],
            'role'      => $hardcodedAdmin['role'],
            'user'      => $hardcodedAdmin
        ]);

        return redirect()->to('/students')->with('success', 'Welcome back, Admin ' . $hardcodedAdmin['username'] . '!');
    }

    // Regular database login
    $user = $userModel->where('username', $username)->first();

    if ($user && password_verify($password, $user['password'])) {
        session()->set([
            'user_id'   => $user['id'],
            'user_name' => $user['username'],
            'user'      => $user
        ]);

        return redirect()->to('/students')->with('success', 'Welcome back, ' . $user['username'] . '!');
    }

    return redirect()->back()->with('error', 'Invalid username or password.');
}


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have been logged out successfully.');
    }
}
