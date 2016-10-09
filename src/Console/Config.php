<?php

namespace Soda\Ecommerce\Console;

use Illuminate\Console\Command;

class Config extends Command
{

    protected $signature = 'soda:ecommerce:config';
    protected $description = 'Update config for the Soda Ecommerce module';
    protected $except = [];

    /**
     * Force publishes Soda Ecommerce assets
     */
    public function handle()
    {
        $this->info('Updating Soda Ecommerce config...');
        $this->callSilent('vendor:publish', [
            '--force' => 1,
            '--tag'   => 'soda.ecommerce.config',
        ]);
        $this->info('Soda Ecommerce config updated successfully.');
    }
}

