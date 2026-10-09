<?php

namespace App\Services;

use App\Models\SubBrand;

class SubBrandService
{

    public function getAll()
    {
        return SubBrand::latest()->get();
    }


    public function create(array $data)
    {
        return SubBrand::create($data);
    }


    public function getById(SubBrand $subBrand)
    {
        return $subBrand;
    }


    public function update(
        SubBrand $subBrand,
        array $data
    ) {

        $subBrand->update($data);

        return $subBrand;
    }


    public function delete(SubBrand $subBrand)
    {
        return $subBrand->delete();
    }

}
