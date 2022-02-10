<?php
namespace Ant\Core\Traits;

use Cache;

trait ConsoleStorage {
    protected function getStateCacheName() {
        return 'state';
    }

    public function clear($name) {
        $state = cache($this->getStateCacheName());
        unset($state[$name]);
        cache([$this->getStateCacheName() => $state]);
    }

    public function save($name, $value) {
        $state = cache($this->getStateCacheName());
        $state[$name] = $value;
        cache([$this->getStateCacheName() => $state]);
        // $app = app();
        // $path = $app['files']->putFileAs('', 'Content3s', 'file.txt');
        // dd($path);
    }

    public function load($name, $defaultValue = null) {
        $state = cache($this->getStateCacheName(), $defaultValue);
        return $state[$name] ?? $defaultValue;
    }
}