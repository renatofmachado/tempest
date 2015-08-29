<?php

namespace Tempest\Commands\Migrations;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Tempest\Commands\Migrations\BaseCommand;

class MigrateCommand extends BaseCommand
{
    protected $name = "migrate";

    protected $description = "Migrates the database.";

    protected function handle()
    {
        $name = $this->argument('name');

        if ($name) {
            $text = 'Hello '.$name;
        } else {
            $text = 'Hello';
        }

        if ($this->option('yell')) {
            $text = strtoupper($text);
        }

        $this->output->writeln($text);
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::OPTIONAL, 'Who do you want to greet?'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters'],
        ];
    }
}
