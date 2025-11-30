<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\SystemSettingModel;

class MaintenanceFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $settingModel = new SystemSettingModel();
        $setting = $settingModel->first();

        // If the system is in maintenance mode, show maintenance page for student routes
        if ($setting && $setting['system_mode'] === 'maintenance') {
            return service('response')
                ->setStatusCode(503)
                ->setBody(view('maintenance_view'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
