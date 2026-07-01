<?php

declare(strict_types=1);

namespace app\Models;

class UserModel extends BaseModel
{
    protected string $table = 'users';

    public function findByEmail(string $email): array|false
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function create(string $name, string $email, string $password, string $phone): int
    {
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} (name, email, password, phone, role, created_at)
             VALUES (?, ?, ?, ?, 'user', NOW())"
        );
        $stmt->execute([$name, $email, password_hash($password, PASSWORD_BCRYPT), $phone]);
        return (int) $this->lastInsertId();
    }

    public function updatePassword(int $id, string $password): bool
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET password = ? WHERE id = ?");
        return $stmt->execute([password_hash($password, PASSWORD_BCRYPT), $id]);
    }

    public function allCustomers(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE role = 'user' ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function search(string $query): array
    {
        $like = "%{$query}%";
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE role = 'user' AND (name LIKE ? OR email LIKE ? OR phone LIKE ?)"
        );
        $stmt->execute([$like, $like, $like]);
        return $stmt->fetchAll();
    }
}
