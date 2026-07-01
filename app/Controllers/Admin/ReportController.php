<?php

declare(strict_types=1);

namespace app\Controllers\Admin;

use app\Controllers\BaseController;
use app\Middleware\AuthMiddleware;
use app\Models\ShipmentModel;
use app\Models\CityModel;

class ReportController extends BaseController
{
    private ShipmentModel $shipments;
    private CityModel $cities;

    public function __construct()
    {
        $this->shipments = new ShipmentModel();
        $this->cities    = new CityModel();
    }

    public function index(): void
    {
        AuthMiddleware::requireAdmin();
        $cities = $this->cities->allActive();
        $this->view('admin/reports/index', compact('cities'), 'admin');
    }

    public function download(): void
    {
        AuthMiddleware::requireAdmin();

        $type   = $this->sanitize($this->input('type', 'date'));
        $from   = $this->input('from', '');
        $to     = $this->input('to', '');
        $cityId = (int) $this->input('city_id', 0);

        $rows = match($type) {
            'city'  => $this->shipments->filterByCity($cityId),
            default => $this->shipments->filterByDate($from, $to),
        };

        $filename = 'shipments_report_' . date('Ymd_His') . '.csv';

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
