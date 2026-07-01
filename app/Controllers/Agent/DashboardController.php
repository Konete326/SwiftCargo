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

    public function reports(): void
    {
        AuthMiddleware::requireAgent();
        $this->view('agent/reports', [], 'agent');
    }

    public function downloadReport(): void
    {
        AuthMiddleware::requireAgent();

        $from   = $this->input('from', '');
        $to     = $this->input('to', '');
        $cityId = (int) Session::get('agent_city_id');

        $rows = $this->shipments->filterByAgentCityAndDate($cityId, $from, $to);

        $filename = 'branch_report_' . date('Ymd_His') . '.csv';

        header('Content-Type: text/csv');
        header("Content-Disposition: attachment; filename=\"{$filename}\"");

        $out = fopen('php://output', 'w');

        fputcsv($out, ['Tracking No', 'Sender', 'Sender Phone', 'From City', 'Receiver', 'Receiver Phone', 'To City', 'Weight', 'Type', 'Amount', 'Status', 'Date']);

        foreach ($rows as $row) {
            fputcsv($out, [
                $row['tracking_number'],
                $row['sender_name'],
                $row['sender_phone'],
                $row['from_city'],
                $row['receiver_name'],
                $row['receiver_phone'],
                $row['to_city'],
                $row['weight'],
                $row['courier_type'],
                $row['amount'],
                $row['status'],
                $row['created_at'],
            ]);
        }

        fclose($out);
        exit;
    }
}
