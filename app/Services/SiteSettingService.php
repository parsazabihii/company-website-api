<?php

namespace App\Services;

use App\Models\SiteSetting;

class SiteSettingService
{
    public function getAll()
    {
        return SiteSetting::latest()->get();
    }


    public function create(array $data)
    {
        return SiteSetting::create($data);
    }


    public function getById(SiteSetting $siteSetting)
    {
        return $siteSetting;
    }


    public function update(
        SiteSetting $siteSetting,
        array $data
    ) {
        $siteSetting->update($data);

        return $siteSetting;
    }


    public function delete(SiteSetting $siteSetting)
    {
        return $siteSetting->delete();
    }
}
