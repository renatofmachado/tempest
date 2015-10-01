<?php

namespace Tempest;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

use Illuminate\Support\Str;

class Parser
{

    /**
     * Parses the input string.
     *
     * @param  string $input
     * @return array
     */
    protected static function parse($input)
    {
        $command = $input;
        $description = null;

        if (Str::contains($input, ' : ')) {
            list($command, $description) = explode(' : ', $input);
            $description = trim($description);
        }

        return [
            trim($command),
            $description
        ];
    }

    /**
     * Parses the input string as an argument.
     *
     * @param  string $argument
     * @return \Symfony\Component\Console\Input\InputArgument
     */
    public static function parseArgument($argument)
    {
        list($command, $description) = self::parse($argument);

        // example?*
        if (Str::endsWith($command, '?*')) {
            return new InputArgument(trim($command, '?*'), InputArgument::IS_ARRAY, $description);
        }

        // example?
        if (Str::endsWith($command, '?')) {
            return new InputArgument(trim($command, '?'), InputArgument::OPTIONAL, $description);
        }

        // example*
        if (Str::endsWith($command, '*')) {
            return new InputArgument(trim($command, '*'), InputArgument::REQUIRED | InputArgument::IS_ARRAY, $description);
        }

        // example=hello
        if (preg_match('/(.+)\=(.+)/', $command, $data)) {
            return new InputArgument($data[0], InputArgument::REQUIRED, $description, $data[1]);
        }

        // example
        return new InputArgument($command, InputArgument::REQUIRED, $description);
    }

    /**
     * Parses the input string as an argument.
     *
     * @param  string $option
     * @return \Symfony\Component\Console\Input\InputOption
     */
    public static function parseOption($option)
    {
        list($command, $description) = self::parse($option);

        list($shortcut, $command) = self::parseShortcut($command);

        // --example= or --example
        if (Str::endsWith($command, '=')) {
            return new InputOption(trim($command, '='), $shortcut, InputOption::VALUE_OPTIONAL, $description);
        }

        // --example=hello --example=world
        if (Str::endsWith($command, '=*')) {
            return new InputOption(trim($command, '=*'), $shortcut, InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, $description);
        }

        // --example=hello or --example
        if (preg_match('/(.+)\=(.+)/', $command, $data)) {
            return new InputOption($data[1], $shortcut, InputOption::VALUE_OPTIONAL, $description, $data[2]);
        }

        // --example
        return new InputOption($command, $shortcut, InputOption::VALUE_NONE, $description);
    }

    /**
     * Parses an option's shortcut.
     *
     * @param  string $option
     * @return array
     */
    private static function parseShortcut($option)
    {
        $shortcut = null;

        // e|example
        $data = preg_split('/\s*\|\s*/', $option, 2);

        if (isset($data[1])) {
            $shortcut = $data[0];
            $option = $data[1];
        }

        return [
            $shortcut,
            $option
        ];
    }
}
