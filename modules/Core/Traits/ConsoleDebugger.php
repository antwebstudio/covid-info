<?php
namespace Ant\Core\Traits;

use Cache;

trait ConsoleDebugger {
    use ConsoleBootableTraits;

    protected $startTime;

    public function bootConsoleDebugger() {
        $this->startTime = microtime(true);
    }

    public function displayExcecutionTime() {
        $time = microtime(true) - $this->startTime;
        $this->comment("Processed in $time seconds");
    }
}