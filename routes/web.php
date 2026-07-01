<?php

declare(strict_types=1);

use routes\Router;
use app\Controllers\Auth\LoginController;
use app\Controllers\Auth\RegisterController;
use app\Controllers\Admin\DashboardController as AdminDashboard;
use app\Controllers\Admin\ShipmentController as AdminShipment;
use app\Controllers\Admin\AgentController;
use app\Controllers\Admin\CustomerController;
use app\Controllers\Admin\ReportController;
use app\Controllers\Agent\DashboardController as AgentDashboard;
use app\Controllers\Agent\ShipmentController as AgentShipment;
use app\Controllers\User\DashboardController as UserDashboard;
use app\Controllers\User\TrackController;

$router = new Router();

$router->get('/',                           [LoginController::class,    'showForm']);
$router->get('/login',                      [LoginController::class,    'showForm']);
$router->post('/login',                     [LoginController::class,    'login']);
$router->get('/logout',                     [LoginController::class,    'logout']);
$router->get('/register',                   [RegisterController::class, 'showForm']);
$router->post('/register',                  [RegisterController::class, 'register']);

$router->get('/admin/dashboard',            [AdminDashboard::class,     'index']);
$router->get('/admin/shipments',            [AdminShipment::class,      'index']);
$router->get('/admin/shipments/create',     [AdminShipment::class,      'create']);
$router->post('/admin/shipments/store',     [AdminShipment::class,      'store']);
$router->get('/admin/shipments/edit/{id}',  [AdminShipment::class,      'edit']);
$router->post('/admin/shipments/update/{id}', [AdminShipment::class,    'update']);
$router->get('/admin/shipments/delete/{id}', [AdminShipment::class,     'delete']);
$router->get('/admin/agents',               [AgentController::class,    'index']);
$router->get('/admin/agents/create',        [AgentController::class,    'create']);
$router->post('/admin/agents/store',        [AgentController::class,    'store']);
$router->get('/admin/agents/edit/{id}',     [AgentController::class,    'edit']);
$router->post('/admin/agents/update/{id}',  [AgentController::class,    'update']);
$router->get('/admin/agents/delete/{id}',   [AgentController::class,    'delete']);
$router->get('/admin/customers',            [CustomerController::class, 'index']);
$router->get('/admin/reports',              [ReportController::class,   'index']);
$router->post('/admin/reports/download',    [ReportController::class,   'download']);

$router->get('/agent/dashboard',            [AgentDashboard::class,     'index']);
$router->get('/agent/shipments',            [AgentShipment::class,      'index']);
$router->get('/agent/shipments/create',     [AgentShipment::class,      'create']);
$router->post('/agent/shipments/store',     [AgentShipment::class,      'store']);
$router->get('/agent/shipments/edit/{id}',  [AgentShipment::class,      'edit']);
$router->post('/agent/shipments/update/{id}', [AgentShipment::class,    'update']);

$router->get('/user/dashboard',             [UserDashboard::class,      'index']);
$router->get('/user/track',                 [TrackController::class,    'showForm']);
$router->post('/user/track',                [TrackController::class,    'track']);
$router->get('/user/track/{tracking}',      [TrackController::class,    'result']);

$router->get('/unauthorized', function () {
    http_response_code(403);
    require dirname(__DIR__) . '/views/errors/unauthorized.php';
});

return $router;
