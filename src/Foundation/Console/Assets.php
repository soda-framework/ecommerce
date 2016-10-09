<?php

namespace Soda\Ecommerce\Foundation\Console;

use Illuminate\Console\Command;

class Assets extends Command
{

    protected $signature = 'soda:ecommerce:assets';
    protected $description = 'Update assets for the Soda Ecommerce module';
    protected $except = [];

    /**
     * Force publishes Soda Ecommerce assets
     */
    public function handle()
    {
        $this->info('Updating Soda Ecommerce module styles and assets...');
        $this->callSilent('vendor:publish', [
            '--force' => 1,
            '--tag'   => 'soda.ecommerce.assets',
        ]);
        $this->info('Soda Ecommerce styles and assets updated successfully.');
    }
}

