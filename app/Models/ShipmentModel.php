<?php

declare(strict_types=1);

namespace app\Models;

class ShipmentModel extends BaseModel
{
    protected string $table = 'shipments';

    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table}
             (tracking_number, sender_name, sender_phone, sender_city_id,
              receiver_name, receiver_phone, receiver_city_id,
              weight, courier_type, delivery_date, amount, status, agent_id, created_at)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'booked', ?, NOW())"
        );
        $stmt->execute([
            $data['tracking_number'],
            $data['sender_name'],
            $data['sender_phone'],
            $data['sender_city_id'],
            $data['receiver_name'],
            $data['receiver_phone'],
            $data['receiver_city_id'],
            $data['weight'],
            $data['courier_type'],
            $data['delivery_date'],
            $data['amount'],
            $data['agent_id'],
        ]);
        return (int) $this->lastInsertId();
    }

    public function findByTracking(string $trackingNumber): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT s.*, 
                    fc.name AS from_city, tc.name AS to_city
             FROM {$this->table} s
             JOIN cities fc ON s.sender_city_id = fc.id
             JOIN cities tc ON s.receiver_city_id = tc.id
             WHERE s.tracking_number = ?"
        );
        $stmt->execute([$trackingNumber]);
        return $stmt->fetch();
    }

    public function updateStatus(int $id, string $status): bool
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    public function allWithCities(): array
    {
        $stmt = $this->db->query(
            "SELECT s.*, fc.name AS from_city, tc.name AS to_city
             FROM {$this->table} s
             JOIN cities fc ON s.sender_city_id = fc.id
             JOIN cities tc ON s.receiver_city_id = tc.id
             ORDER BY s.created_at DESC"
        );
        return $stmt->fetchAll();
    }

    public function byAgentCity(int $cityId): array
    {
        $stmt = $this->db->prepare(
            "SELECT s.*, fc.name AS from_city, tc.name AS to_city
             FROM {$this->table} s
             JOIN cities fc ON s.sender_city_id = fc.id
             JOIN cities tc ON s.receiver_city_id = tc.id
             WHERE s.sender_city_id = ? OR s.receiver_city_id = ?
             ORDER BY s.created_at DESC"
        );
        $stmt->execute([$cityId, $cityId]);
        return $stmt->fetchAll();
    }

    public function statusCounts(): array
    {
        $stmt = $this->db->query(
            "SELECT status, COUNT(*) AS total FROM {$this->table} GROUP BY status"
        );
        return $stmt->fetchAll();
    }

    public function statusCountsByCity(int $cityId): array
    {
        $stmt = $this->db->prepare(
            "SELECT status, COUNT(*) AS total FROM {$this->table}
             WHERE sender_city_id = ? OR receiver_city_id = ?
             GROUP BY status"
        );
        $stmt->execute([$cityId, $cityId]);
        return $stmt->fetchAll();
    }

    public function filterByDate(string $from, string $to): array
    {
        $stmt = $this->db->prepare(
            "SELECT s.*, fc.name AS from_city, tc.name AS to_city
             FROM {$this->table} s
             JOIN cities fc ON s.sender_city_id = fc.id
             JOIN cities tc ON s.receiver_city_id = tc.id
             WHERE DATE(s.created_at) BETWEEN ? AND ?
             ORDER BY s.created_at DESC"
        );
        $stmt->execute([$from, $to]);
        return $stmt->fetchAll();
    }

    public function filterByCity(int $cityId): array
    {
        $stmt = $this->db->prepare(
            "SELECT s.*, fc.name AS from_city, tc.name AS to_city
             FROM {$this->table} s
             JOIN cities fc ON s.sender_city_id = fc.id
             JOIN cities tc ON s.receiver_city_id = tc.id
             WHERE s.sender_city_id = ? OR s.receiver_city_id = ?
             ORDER BY s.created_at DESC"
        );
        $stmt->execute([$cityId, $cityId]);
        return $stmt->fetchAll();
    }

    public function filterByAgentCityAndDate(int $cityId, string $from, string $to): array
    {
        $stmt = $this->db->prepare(
            "SELECT s.*, fc.name AS from_city, tc.name AS to_city
             FROM {$this->table} s
             JOIN cities fc ON s.sender_city_id = fc.id
             JOIN cities tc ON s.receiver_city_id = tc.id
             WHERE (s.sender_city_id = ? OR s.receiver_city_id = ?)
               AND DATE(s.created_at) BETWEEN ? AND ?
             ORDER BY s.created_at DESC"
        );
        $stmt->execute([$cityId, $cityId, $from, $to]);
        return $stmt->fetchAll();
    }

    public function generateTrackingNumber(): string
    {
        return 'SC' . strtoupper(uniqid());
    }
}
