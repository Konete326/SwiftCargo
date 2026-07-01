<?php

declare(strict_types=1);

namespace app\Controllers\Admin;

use app\Controllers\BaseController;
use app\Middleware\AuthMiddleware;
use app\Models\ShipmentModel;
use app\Models\AgentModel;
use app\Models\UserModel;

class DashboardController extends BaseController
{
    private ShipmentModel $shipments;
    private AgentModel $agents;
    private UserModel $users;

    public function __construct()
    {
        $this->shipments = new ShipmentModel();
        $this->agents    = new AgentModel();
        $this->users     = new UserModel();
    }

    public function index(): void
    {
        AuthMiddleware::requireAdmin();

        $statusCounts   = $this->shipments->statusCounts();
        $totalAgents    = count($this->agents->all());
        $totalCustomers = count($this->users->allCustomers());
        $recentShipments = array_slice($this->shipments->allWithCities(), 0, 5);

        $counts = [];
        foreach ($statusCounts as $row) {
            $counts[$row['status']] = $row['total'];
        }

        $this->view('admin/dashboard', compact('counts', 'totalAgents', 'totalCustomers', 'recentShipments'), 'admin');
    }
}
