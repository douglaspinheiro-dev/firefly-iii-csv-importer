<?php
/**
 * ImportJobStatusManager.php
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

namespace App\Services\Import\ImportJobStatus;

use App\Services\Session\Constants;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Log;
use Storage;

/**
 * Class ImportJobStatusManager
 */
class ImportJobStatusManager
{
    /**
     * @param string $identifier
     *
     * @return ImportJobStatus
     */
    public static function startOrFindJob(string $identifier): ImportJobStatus
    {
        Log::debug(sprintf('Now in startOrFindJob(%s)', $identifier));
        $disk = Storage::disk('jobs');
        try {
            Log::debug('Try to see if file exists.');
            if ($disk->exists($identifier)) {
                Log::debug('File exists.');

                return ImportJobStatus::fromArray(json_decode($disk->get($identifier), true, 512, JSON_THROW_ON_ERROR));
            }
        } catch (FileNotFoundException $e) {
            Log::error('Could not find file, write a new one.');
            Log::error($e->getMessage());
        }
        Log::debug('File does not exist or error, create a new one.');
        $status = new ImportJobStatus;
        $disk->put($identifier, json_encode($status->toArray(), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));

        Log::debug('Return status.', $status->toArray());

        return $status;
    }

    /**
     * @param string $identifier
     * @param int    $index
     * @param string $error
     */
    public static function addError(string $identifier, int $index, string $error): void
    {
        $disk = Storage::disk('jobs');
        try {
            if ($disk->exists($identifier)) {
                $status                   = ImportJobStatus::fromArray(json_decode($disk->get($identifier), true, 512, JSON_THROW_ON_ERROR));
                $status->errors[$index]   = $status->errors[$index] ?? [];
                $status->errors[$index][] = $error;
                self::storeJobStatus($identifier, $status);
            }
        } catch (FileNotFoundException $e) {
            Log::error($e);
        }
    }

    /**
     * @param string $identifier
     * @param int    $index
     * @param string $warning
     */
    public static function addWarning(string $identifier, int $index, string $warning): void
    {
        $disk = Storage::disk('jobs');
        try {
            if ($disk->exists($identifier)) {
                $status                     = ImportJobStatus::fromArray(json_decode($disk->get($identifier), true, 512, JSON_THROW_ON_ERROR));
                $status->warnings[$index]   = $status->warnings[$index] ?? [];
                $status->warnings[$index][] = $warning;
                self::storeJobStatus($identifier, $status);
            }
        } catch (FileNotFoundException $e) {
            Log::error($e);
        }
    }

    /**
     * @param string $identifier
     * @param int    $index
     * @param string $message
     */
    public static function addMessage(string $identifier, int $index, string $message): void
    {
        $disk = Storage::disk('jobs');
        try {
            if ($disk->exists($identifier)) {
                $status                     = ImportJobStatus::fromArray(json_decode($disk->get($identifier), true, 512, JSON_THROW_ON_ERROR));
                $status->messages[$index]   = $status->messages[$index] ?? [];
                $status->messages[$index][] = $message;
                self::storeJobStatus($identifier, $status);
            }
        } catch (FileNotFoundException $e) {
            Log::error($e);
        }
    }


    /**
     * @param string $status
     *
     * @return ImportJobStatus
     */
    public static function setJobStatus(string $status): ImportJobStatus
    {
        $identifier = session()->get(Constants::JOB_IDENTIFIER);
        Log::debug(sprintf('Now in setJobStatus(%s)', $status));
        Log::debug(sprintf('Found "%s" in the session', $identifier));

        $jobStatus         = self::startOrFindJob($identifier);
        $jobStatus->status = $status;

        self::storeJobStatus($identifier, $jobStatus);

        return $jobStatus;
    }

    /**
     * @param string          $identifier
     * @param ImportJobStatus $status
     */
    private static function storeJobStatus(string $identifier, ImportJobStatus $status): void
    {
        Log::debug(sprintf('Now in storeJobStatus(%s)', $identifier));
        $array = $status->toArray();
        Log::debug('Going to store', $array);
        $disk = Storage::disk('jobs');
        $disk->put($identifier, json_encode($status->toArray(), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
        Log::debug('Done with storing.');
    }
}
