<?php

namespace Tempest\Commands\Migrations;

use Tempest\Commands\Migrations\BaseCommand;

class MigrateCommand extends BaseCommand
{
    protected $name = "migrate";

    protected $description = "Migrates the database.";

    protected function handle()
    {
        $yell = $this->option('yell');
        $this->output->writeln($yell);
    }

    protected function getArguments()
    {
        return [
            'name : Sets the user name.',
        ];
    }

    protected function getOptions()
    {
        return [
            'y|yell= : If set, the task will yell in uppercase letters.'
        ];
    }
}
