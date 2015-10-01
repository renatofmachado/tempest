<?php

namespace Tempest\Commands;

use Tempest\Command;
use Illuminate\Support\Str;

class KeyGenerateCommand extends Command
{
    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'key:generate';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Generate a random key for your application.';

    /**
     * Handle the command.
     *
     * @return void
     */
    public function handle()
    {
        $length = $this->option('length');

        $key = Str::random($length);

        $this->output->writeln($key);
    }

    /**
     * Defines the command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            'l|length=32 : Sets the length of the random generated key.',
        ];
    }
}
