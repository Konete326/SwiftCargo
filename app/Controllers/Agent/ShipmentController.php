<?php

declare(strict_types=1);

namespace app\Controllers\Agent;

use app\Controllers\BaseController;
use app\Middleware\AuthMiddleware;
use app\Models\ShipmentModel;
use app\Models\CityModel;
use app\Helpers\Session;

class ShipmentController extends BaseController
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
        AuthMiddleware::requireAgent();
        $cityId    = (int) Session::get('agent_city_id');
        $shipments = $this->shipments->byAgentCity($cityId);
        $this->view('agent/shipments/index', compact('shipments'), 'agent');
    }

    public function create(): void
    {
        AuthMiddleware::requireAgent();
        $cities = $this->cities->allActive();
        $this->view('agent/shipments/create', compact('cities'), 'agent');
    }

    public function store(): void
    {
        AuthMiddleware::requireAgent();

        $data = [
            'tracking_number'  => $this->shipments->generateTrackingNumber(),
            'sender_name'      => $this->sanitize($this->input('sender_name', '')),
            'sender_phone'     => $this->sanitize($this->input('sender_phone', '')),
            'sender_city_id'   => (int) $this->input('sender_city_id', 0),
            'receiver_name'    => $this->sanitize($this->input('receiver_name', '')),
            'receiver_phone'   => $this->sanitize($this->input('receiver_phone', '')),
            'receiver_city_id' => (int) $this->input('receiver_city_id', 0),
            'weight'           => (float) $this->input('weight', 0),
            'courier_type'     => $this->sanitize($this->input('courier_type', '')),
            'delivery_date'    => $this->input('delivery_date', ''),
            'amount'           => (float) $this->input('amount', 0),
            'agent_id'         => (int) Session::get('user_id'),
        ];

        $this->shipments->create($data);
        $this->flashSuccess("Shipment created. [SMS simulated to Sender ({$data['sender_phone']}) & Receiver ({$data['receiver_phone']}): Shipment {$data['tracking_number']} booked]");
        $this->redirect('/SwiftCargo/public/agent/shipments');
    }

    public function edit(string $id): void
    {
        AuthMiddleware::requireAgent();
        $shipment = $this->shipments->findById((int) $id);
        $cities   = $this->cities->allActive();
        $this->view('agent/shipments/edit', compact('shipment', 'cities'), 'agent');
    }

    public function update(string $id): void
    {
        AuthMiddleware::requireAgent();
        $shipment = $this->shipments->findById((int) $id);
        $status = $this->sanitize($this->input('status', ''));
        $this->shipments->updateStatus((int) $id, $status);

        if ($shipment) {
            $msg = "Status updated.";
            if ($status === 'delivered') {
                $msg .= " [SMS simulated to {$shipment['sender_phone']} & {$shipment['receiver_phone']}: Shipment {$shipment['tracking_number']} has been delivered]";
            } else {
                $msg .= " [SMS simulated: Status changed to " . str_replace('_', ' ', $status) . "]";
            }
            $this->flashSuccess($msg);
        } else {
            $this->flashSuccess('Status updated.');
        }
        $this->redirect('/SwiftCargo/public/agent/shipments');
    }
}
