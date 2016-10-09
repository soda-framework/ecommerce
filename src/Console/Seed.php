<?php

namespace Soda\Ecommerce\Console;

use Illuminate\Console\Command;

class Seed extends Command
{

    protected $signature = 'soda:ecommerce:seed {--class=SeedAll : The class name of the root seeder}';
    protected $description = 'Seed the Soda Ecommerce Database';
    protected $except = [];

    /**
     * Runs seeds for Soda CMS, defaulting to 'SodaSeeder'
     */
    public function handle()
    {
        $this->call('db:seed', [
            '--class' => 'Soda\\Ecommerce\\Seeds\\'.$this->option('class'),
        ]);
    }
}
