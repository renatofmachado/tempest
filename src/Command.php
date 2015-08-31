<?php

namespace Tempest;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;

class Command extends SymfonyCommand
{
    /**
     * The Slim Framework instance.
     *
     * @var \Slim\Slim
     */
    protected $slim;

    /**
     * The input interface implementation.
     *
     * @var \Symfony\Component\Console\Input\InputInterface
     */
    protected $input;

    /**
     * The output interface implementation.
     *
     * @var \Symfony\Component\Console\Output\OutputInterface
     */
    protected $output;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description;

    /**
     * Create a new console command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct($this->name);

        $this->setDescription($this->description);

        foreach ($this->getArguments() as $argument)
        {
            $this->getDefinition()->addArgument(Parser::parseArgument($argument));
        }

        foreach ($this->getOptions() as $option)
        {
            $this->getDefinition()->addOption(Parser::parseOption($option));
        }
    }


    /**
     * Executes a console command.
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;

        $this->output = $output;

        return $this->handle();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }

    /**
     * Call a console command.
     *
     * @param  string $command
     * @param  array $parameters
     * @return int
     */
    public function call($command, array $parameters = [])
    {
        $instance = $this->find($command);

        $parameters['command'] = $command;

        $input = new ArrayInput($parameters);

        return $instance->run($input, $this->output);
    }

    /**
     * Get the value of a console command argument.
     *
     * @param  string $key
     * @return string|array
     */
    public function argument($key = null)
    {
        return is_null($key) ? $this->input->getArguments() : $this->input->getArgument($key);
    }

    /**
     * Get the value of console command option.
     *
     * @param  string $key
     * @return string|array
     */
    public function option($key = null)
    {
        return is_null($key) ? $this->input->getOptions() : $this->input->getOption($key);
    }
}
