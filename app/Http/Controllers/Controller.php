<?php
/**
 * Controller.php
 * Copyright (c) 2019 thegrumpydictator@gmail.com
 *
 * This file is part of Firefly III CSV Importer.
 *
 * Firefly III CSV Importer is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Firefly III CSV Importer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Firefly III CSV Importer.If not, see
 * <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Artisan;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Controller constructor.
     *
     * @throws ConfigMissingException
     */
    public function __construct()
    {

        $variables = [
            'FIREFLY_III_ACCESS_TOKEN' => 'csv_importer.access_token',
            'FIREFLY_III_URI'          => 'csv_importer.uri',
        ];
        foreach ($variables as $env => $config) {

            $value = (string)config($config);
            if ('' === $value) {
                echo sprintf('Please set a valid value for "%s" in the env file.', $env);
                Artisan::call('config:clear');
                exit;
            }
        }
        $path     = config('csv_importer.upload_path');
        $writable = is_dir($path) && is_writable($path);
        if (false === $writable) {
            echo sprintf('Make sure that directory "%s" exists and is writeable.', $path);
            exit;
        }

        app('view')->share('version', config('csv_importer.version'));
    }

}
