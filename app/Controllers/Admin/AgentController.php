<?php

declare(strict_types=1);

namespace app\Controllers\Admin;

use app\Controllers\BaseController;
use app\Middleware\AuthMiddleware;
use app\Models\AgentModel;
use app\Models\CityModel;

class AgentController extends BaseController
{
    private AgentModel $agents;
    private CityModel $cities;

    public function __construct()
    {
        $this->agents = new AgentModel();
        $this->cities = new CityModel();
    }

    public function index(): void
    {
        AuthMiddleware::requireAdmin();
        $agents = $this->agents->allWithCity();
        $this->view('admin/agents/index', compact('agents'), 'admin');
    }

    public function create(): void
    {
        AuthMiddleware::requireAdmin();
        $cities = $this->cities->allActive();
        $this->view('admin/agents/create', compact('cities'), 'admin');
    }

    public function store(): void
    {
        AuthMiddleware::requireAdmin();

        $name     = $this->sanitize($this->input('name', ''));
        $email    = $this->sanitize($this->input('email', ''));
        $phone    = $this->sanitize($this->input('phone', ''));
        $password = $this->input('password', '');
        $cityId   = (int) $this->input('city_id', 0);

        if ($this->agents->findByEmail($email)) {
            $this->flashError('Agent with this email already exists.');
            $this->redirect('/SwiftCargo/public/admin/agents/create');
        }

        $this->agents->create($name, $email, $password, $cityId, $phone);
        $this->flashSuccess('Agent created successfully.');
        $this->redirect('/SwiftCargo/public/admin/agents');
    }

    public function edit(string $id): void
    {
        AuthMiddleware::requireAdmin();
        $agent  = $this->agents->findById((int) $id);
        $cities = $this->cities->allActive();
        $this->view('admin/agents/edit', compact('agent', 'cities'), 'admin');
    }

    public function update(string $id): void
    {
        AuthMiddleware::requireAdmin();

        $name   = $this->sanitize($this->input('name', ''));
        $email  = $this->sanitize($this->input('email', ''));
        $phone  = $this->sanitize($this->input('phone', ''));
        $cityId = (int) $this->input('city_id', 0);

        $this->agents->update((int) $id, $name, $email, $phone, $cityId);
        $this->flashSuccess('Agent updated.');
        $this->redirect('/SwiftCargo/public/admin/agents');
    }

    public function delete(string $id): void
    {
        AuthMiddleware::requireAdmin();
        $this->agents->delete((int) $id);
        $this->flashSuccess('Agent deleted.');
        $this->redirect('/SwiftCargo/public/admin/agents');
    }
}
