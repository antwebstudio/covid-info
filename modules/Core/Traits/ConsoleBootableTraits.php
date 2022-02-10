<?php
namespace Ant\Core\Traits;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

trait ConsoleBootableTraits {
    protected function bootTraits()
    {
        $class = $this;

        $booted = [];

        foreach (class_uses_recursive($class) as $trait) {
            $method = 'boot'.class_basename($trait);

            if (method_exists($class, $method) && ! in_array($method, $booted)) {
                call_user_func([$class, $method]);

                $booted[] = $method;
            }
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->bootTraits();

        return (int) $this->laravel->call([$this, 'handle']);
    }
}