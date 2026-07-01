<?php

declare(strict_types=1);

namespace app\Controllers\User;

use app\Controllers\BaseController;
use app\Middleware\AuthMiddleware;
use app\Models\ShipmentModel;
use app\Helpers\Session;

class DashboardController extends BaseController
{
    private ShipmentModel $shipments;

    public function __construct()
    {
        $this->shipments = new ShipmentModel();
    }

    public function index(): void
    {
        AuthMiddleware::requireLogin();
        $this->view('user/dashboard', [], 'user');
    }
}
