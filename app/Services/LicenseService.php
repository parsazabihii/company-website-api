<?php

namespace App\Services;

use App\Models\License;

class LicenseService
{
    public function list(int $perPage = 15)
    {
        return License::latest()->paginate($perPage);
    }


    public function find(int $id)
    {
        return License::findOrFail($id);
    }


    public function create(array $data)
    {
        return License::create($data);
    }


    public function update(int $id, array $data)
    {
        $license = License::findOrFail($id);

        $license->update($data);

        return $license;
    }


    public function delete(int $id): bool
    {
        return License::findOrFail($id)->delete();
    }
}
