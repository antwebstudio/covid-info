<?php

/*
 * This file is part of the FusionCMS application.
 *
 * (c) efelle creative <appdev@efelle.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Jobs\Uninstaller;

use File;
use Storage;

class DeleteUserFiles
{
    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        // Remove all files created in File Manager
        File::deleteDirectory(Storage::disk('public')->path('files'));

        // Remove .cache folder created by Glide
        File::deleteDirectory(Storage::disk('public')->path('.cache'));
    }
}