<?php

declare(strict_types=1);

namespace app\Controllers\Auth;

use app\Controllers\BaseController;
use app\Middleware\AuthMiddleware;
use app\Models\UserModel;

class RegisterController extends BaseController
{
    private UserModel $users;

    public function __construct()
    {
        $this->users = new UserModel();
    }

    public function showForm(): void
    {
        AuthMiddleware::guest();
        $this->view('auth/register', [], 'auth');
    }

    public function register(): void
    {
        $name     = $this->sanitize($this->input('name', ''));
        $email    = $this->sanitize($this->input('email', ''));
        $phone    = $this->sanitize($this->input('phone', ''));
        $password = $this->input('password', '');
        $confirm  = $this->input('confirm_password', '');

        if (empty($name) || empty($email) || empty($phone) || empty($password)) {
            $this->flashError('All fields are required.');
            $this->redirect('/SwiftCargo/register');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->flashError('Invalid email address.');
            $this->redirect('/SwiftCargo/register');
        }

        if ($password !== $confirm) {
            $this->flashError('Passwords do not match.');
            $this->redirect('/SwiftCargo/register');
        }

        if ($this->users->findByEmail($email)) {
            $this->flashError('Email already registered.');
            $this->redirect('/SwiftCargo/register');
        }

        $this->users->create($name, $email, $password, $phone);

        $this->flashSuccess('Registration successful. Please login.');
        $this->redirect('/SwiftCargo/login');
    }
}

