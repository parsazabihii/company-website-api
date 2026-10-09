<?php

namespace App\Services;

use App\Models\AdminLog;

class AdminLogService
{
    public function getAll()
    {
        return AdminLog::with('user')
            ->latest()
            ->get();
    }


    public function getById(AdminLog $adminLog)
    {
        return $adminLog->load('user');
    }
}
