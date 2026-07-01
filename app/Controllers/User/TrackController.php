<?php

declare(strict_types=1);

namespace app\Controllers\User;

use app\Controllers\BaseController;
use app\Middleware\AuthMiddleware;
use app\Models\ShipmentModel;

class TrackController extends BaseController
{
    private ShipmentModel $shipments;

    public function __construct()
    {
        $this->shipments = new ShipmentModel();
    }

    public function showForm(): void
    {
        AuthMiddleware::requireLogin();
        $this->view('user/track', [], 'user');
    }

    public function track(): void
    {
        AuthMiddleware::requireLogin();

        $trackingNumber = $this->sanitize($this->input('tracking_number', ''));

        if (empty($trackingNumber)) {
            $this->flashError('Please enter a tracking number.');
            $this->redirect('/SwiftCargo/public/user/track');
        }

        $this->redirect('/SwiftCargo/public/user/track/' . urlencode($trackingNumber));
    }

    public function result(string $tracking): void
    {
        AuthMiddleware::requireLogin();

        $shipment = $this->shipments->findByTracking(urldecode($tracking));

        if (!$shipment) {
            $this->flashError('No shipment found with that tracking number.');
            $this->redirect('/SwiftCargo/public/user/track');
        }

        $this->view('user/track_result', compact('shipment'), 'user');
    }
}
