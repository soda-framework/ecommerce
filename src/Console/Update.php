<?php

namespace Soda\Ecommerce\Console;

use Illuminate\Console\Command;

class Update extends Command
{

    protected $signature = 'soda:ecommerce:update';
    protected $description = 'Update your version of the Soda Ecommerce module';

    public function handle()
    {
        $this->info('Updating Soda Ecommerce module via Composer...');
        shell_exec('composer update soda-framework/ecommerce');
        $this->info('Soda Ecommerce module update complete.');
    }
}

