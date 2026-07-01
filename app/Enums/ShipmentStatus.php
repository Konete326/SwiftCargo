<?php

declare(strict_types=1);

namespace app\Enums;

enum ShipmentStatus: string
{
    case Booked     = 'booked';
    case InTransit  = 'in_transit';
    case OutForDelivery = 'out_for_delivery';
    case Delivered  = 'delivered';
    case Cancelled  = 'cancelled';

    public function label(): string
    {
        return match($this) {
            self::Booked           => 'Booked',
            self::InTransit        => 'In Transit',
            self::OutForDelivery   => 'Out for Delivery',
            self::Delivered        => 'Delivered',
            self::Cancelled        => 'Cancelled',
        };
    }

    public function badgeClass(): string
    {
        return match($this) {
            self::Booked           => 'badge-warning',
            self::InTransit        => 'badge-info',
            self::OutForDelivery   => 'badge-primary',
            self::Delivered        => 'badge-success',
            self::Cancelled        => 'badge-danger',
        };
    }
}
