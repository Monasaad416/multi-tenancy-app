<?php

use Illuminate\Database\Seeder;
use Hyn\Tenancy\Commands\Seed;

class TenantDataSeeder extends Seeder
{
    public function run()
    {
        // Get all tenants
        $tenants = app(\Hyn\Tenancy\Contracts\Repositories\TenantRepository::class)->all();

        // Seed data for each tenant
        foreach ($tenants as $tenant) {
            $this->call(Seed::class, [
                '--tenant' => $tenant->uuid,
                '--class' => TenantDatabaseSeeder::class,
            ]);
        }
    }
}