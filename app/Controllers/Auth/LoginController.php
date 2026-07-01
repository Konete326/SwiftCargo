<?php

declare(strict_types=1);

namespace app\Controllers\Auth;

use app\Controllers\BaseController;
use app\Helpers\Session;
use app\Models\UserModel;
use app\Models\AgentModel;

class LoginController extends BaseController
{
    private UserModel $users;
    private AgentModel $agents;

    public function __construct()
    {
        $this->users  = new UserModel();
        $this->agents = new AgentModel();
    }

    public function showForm(): void
    {
        \app\Middleware\AuthMiddleware::guest();
        $this->view('auth/login', [], 'auth');
    }

    public function login(): void
    {
        $email    = $this->sanitize($this->input('email', ''));
        $password = $this->input('password', '');
        $role     = $this->sanitize($this->input('role', 'user'));

        if (empty($email) || empty($password)) {
            $this->flashError('Email and password are required.');
            $this->redirect('/SwiftCargo/login');
        }

        $account = match($role) {
            'admin' => $this->users->findByEmail($email),
            'agent' => $this->agents->findByEmail($email),
            default => $this->users->findByEmail($email),
        };

        if (!$account || !password_verify($password, $account['password'])) {
            $this->flashError('Invalid credentials.');
            $this->redirect('/SwiftCargo/login');
        }

        if ($role === 'admin' && $account['role'] !== 'admin') {
            $this->flashError('Access denied.');
            $this->redirect('/SwiftCargo/login');
        }

        Session::start();
        Session::set('user_id',   $account['id']);
        Session::set('user_name', $account['name']);
        Session::set('user_role', $role);

        if ($role === 'agent') {
            Session::set('agent_city_id', $account['city_id']);
        }

        $this->redirect("/SwiftCargo/{$role}/dashboard");
    }

    public function logout(): void
    {
        Session::start();
        Session::destroy();
        $this->redirect('/SwiftCargo/login');
    }
}

