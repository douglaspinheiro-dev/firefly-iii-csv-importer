<?php
/**
 * StorageService.php
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

namespace App\Services\Storage;

use RuntimeException;
use Storage;
use Str;

/**
 * Class StorageService
 */
class StorageService
{
    /**
     * @param string $content
     *
     * @return string
     */
    public static function storeContent(string $content): string
    {
        $fileName = Str::random(20);
        $disk     = Storage::disk('uploads');
        $disk->put($fileName, $content);

        return $fileName;
    }

    public static function getContent(string $name): string
    {
        $disk = Storage::disk('uploads');
        if ($disk->exists($name)) {
            return $disk->get($name);
        }
        throw new RuntimeException(sprintf('No such file %s', $name));
    }

}
