<?php
/**
 * FileReader.php
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

namespace App\Services\CSV\File;


use App\Services\Session\Constants;
use App\Services\Storage\StorageService;
use League\Csv\Reader;

/**
 * Class FileReader
 */
class FileReader
{
    /**
     * Get a CSV file reader and fill it with data from CSV file.
     * @return Reader
     */
    public static function getReaderFromSession(): Reader
    {
        $content = StorageService::getContent(session()->get(Constants::UPLOAD_CSV_FILE));

        // room for config
        return Reader::createFromString($content);
    }

    /**
     * @param string $content
     *
     * @return Reader
     */
    public static function getReaderFromContent(string $content): Reader
    {
        return Reader::createFromString($content);
    }

}
