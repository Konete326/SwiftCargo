<?php

declare(strict_types=1);

namespace app\Models;

class CityModel extends BaseModel
{
    protected string $table = 'cities';

    public function allActive(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE is_active = 1 ORDER BY name");
        return $stmt->fetchAll();
    }

    public function create(string $name): int
    {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (name, is_active) VALUES (?, 1)");
        $stmt->execute([$name]);
        return (int) $this->lastInsertId();
    }
}
