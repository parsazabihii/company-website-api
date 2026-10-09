<?php

namespace App\Services;

use App\Models\Service;
use App\Models\ServiceFeature;
use Illuminate\Database\Eloquent\Collection;

class ServiceFeatureService
{
    /**
     * Get all features belonging to a service.
     */
    public function getAll(Service $service): Collection
    {
        return $service->features()
            ->orderBy('display_order')
            ->get();
    }

    /**
     * Create a feature for a service.
     */
    public function create(Service $service, array $data): ServiceFeature
    {
        return $service->features()->create($data);
    }

    /**
     * Update an existing service feature.
     */
    public function update(
        ServiceFeature $serviceFeature,
        array $data
    ): ServiceFeature {
        $serviceFeature->update($data);

        return $serviceFeature->refresh();
    }

    /**
     * Delete an existing service feature.
     */
    public function delete(ServiceFeature $serviceFeature): void
    {
        $serviceFeature->delete();
    }
}
