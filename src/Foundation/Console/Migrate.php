<?php

namespace Soda\Ecommerce\Foundation\Console;

use Illuminate\Console\Command;

class Migrate extends Command
{
    protected $signature = 'soda:ecommerce:migrate';
    protected $description = 'Migrate the Soda Ecommerce module database';
    protected $except = [];

    /**
     * Runs all database migrations for Soda.
     */
    public function handle()
    {
        $this->call('migrate', [
            '--path' => '/vendor/soda-framework/ecommerce/database/migrations',
        ]);
    }
}
