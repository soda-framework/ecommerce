<?php

namespace Soda\Ecommerce\Seeds;

use Illuminate\Database\Seeder;

class SeedAll extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $this->call('Soda\Ecommerce\Seeds\PermissionSeeder');
    }
}
