<?php

declare(strict_types=1);

namespace app\Models;

class AgentModel extends BaseModel
{
    protected string $table = 'agents';

    public function findByEmail(string $email): array|false
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function create(string $name, string $email, string $password, int $cityId, string $phone): int
    {
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} (name, email, password, city_id, phone, created_at)
             VALUES (?, ?, ?, ?, ?, NOW())"
        );
        $stmt->execute([$name, $email, password_hash($password, PASSWORD_BCRYPT), $cityId, $phone]);
        return (int) $this->lastInsertId();
    }

    public function update(int $id, string $name, string $email, string $phone, int $cityId): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE {$this->table} SET name = ?, email = ?, phone = ?, city_id = ? WHERE id = ?"
        );
        return $stmt->execute([$name, $email, $phone, $cityId, $id]);
    }

    public function allWithCity(): array
    {
        $stmt = $this->db->query(
            "SELECT a.*, c.name AS city_name
             FROM {$this->table} a
             JOIN cities c ON a.city_id = c.id
             ORDER BY a.created_at DESC"
        );
        return $stmt->fetchAll();
    }
}
