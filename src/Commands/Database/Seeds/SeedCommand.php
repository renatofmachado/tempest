<?php

namespace Tempest\Commands\Database\Seeds;

use Tempest\Commands\Database\BaseCommand;

class SeedCommand extends BaseCommand
{
    protected $name = 'seed';

    protected $description = 'Seeds the database.';

    protected function handle()
    {
        (new \DatabaseSeeder())->run();
    }
}
