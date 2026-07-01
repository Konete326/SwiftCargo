<?php

declare(strict_types=1);

namespace app\Controllers\Agent;

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
        AuthMiddleware::requireAgent();

        $cityId      = (int) Session::get('agent_city_id');
        $statusRows  = $this->shipments->statusCountsByCity($cityId);
        $recentShipments = array_slice($this->shipments->byAgentCity($cityId), 0, 5);

        $counts = [];
        foreach ($statusRows as $row) {
            $counts[$row['status']] = $row['total'];
        }

        $this->view('agent/dashboard', compact('counts', 'recentShipments'), 'agent');
    }
}
