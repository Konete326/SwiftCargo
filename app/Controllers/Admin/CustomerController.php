<?php

declare(strict_types=1);

namespace app\Controllers\Admin;

use app\Controllers\BaseController;
use app\Middleware\AuthMiddleware;
use app\Models\UserModel;

class CustomerController extends BaseController
{
    private UserModel $users;

    public function __construct()
    {
        $this->users = new UserModel();
    }

    public function index(): void
    {
        AuthMiddleware::requireAdmin();

        $query     = $this->sanitize($_GET['q'] ?? '');
        $customers = $query
            ? $this->users->search($query)
            : $this->users->allCustomers();

        $this->view('admin/customers/index', compact('customers', 'query'), 'admin');
    }
}
