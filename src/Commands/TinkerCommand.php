<?php

namespace Tempest\Commands;

use Tempest\Command;
use Psy\Shell;

class TinkerCommand extends Command
{

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'tinker';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Interact with your application.';

    /**
     * Handle the command.
     *
     * @return void
     */
    public function handle()
    {
        $this->getApplication()->setCatchExceptions(false);

        $shell = new Shell();
        $shell->setIncludes($this->argument('include'));
        $shell->run();
    }

    /**
     * Defines the command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            'include?* : Include the necessary files before starting the Psy Shell.',
        ];
    }

}
