<?php

namespace Addons\TagFieldtype\Listeners;

use Menu;

class AddonMenuLoader
{
    public function handle()
    {
        $menu = Menu::get('admin');

        $menu->all()->map(function($item, $index) {
            $item->data('position', $index);
        });
        $item = $menu->add('Tag')->data([
            'position' => 0,
            'to'    => '/tags',
            'icon'  => 'grip-horizontal',
        ]);

        $menu->sortBy('position');
    }
}
