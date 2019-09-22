<?php
/**
 * Configuration.php
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

namespace App\Services\CSV\Configuration;

/**
 * Class Configuration
 */
class Configuration
{
    /** @var string */
    private $date;
    /** @var int */
    private $defaultAccount;
    /** @var string */
    private $delimiter;
    /** @var bool */
    private $headers;
    /** @var bool */
    private $ignoreDuplicates;
    /** @var bool */
    private $ignoreLines;
    /** @var bool */
    private $ignoreTransfers;
    /** @var bool */
    private $rules;
    /** @var bool */
    private $skipForm;
    /** @var array */
    private $specifics;

    /**
     * Configuration constructor.
     */
    private function __construct()
    {
        $this->date             = 'Y-m-d';
        $this->defaultAccount   = 1;
        $this->delimiter        = 'comma';
        $this->headers          = false;
        $this->ignoreDuplicates = false;
        $this->ignoreLines      = false;
        $this->ignoreTransfers  = false;
        $this->rules            = true;
        $this->skipForm         = false;
        $this->specifics        = [];
    }

    /**
     * @param array $array
     *
     * @return static
     */
    public static function fromArray(array $array): self
    {
        $object = new self;

        $object->date             = $array['date'];
        $object->defaultAccount   = $array['defaultAccount'];
        $object->delimiter        = $array['delimiter'];
        $object->ignoreDuplicates = $array['ignoreDuplicates'];
        $object->ignoreLines      = $array['ignoreLines'];
        $object->ignoreTransfers  = $array['ignoreTransfers'];
        $object->rules            = $array['rules'];
        $object->skipForm         = $array['skipForm'];
        $object->specifics        = $array['specifics'];

        return $object;
    }

    /**
     * TODO: column count and column roles. column mapping / do-mapping.
     *
     * @param array $data
     *
     * @return $this
     */
    public static function fromClassic(array $data): self
    {
        $validDelimiters = [
            ','   => 'comma',
            ';'   => 'semicolon',
            'tab' => 'tab',
        ];


        $object                 = new self;
        $object->date           = $data['date-format'] ?? $object->date;
        $object->defaultAccount = $data['import-account'] ?? $object->defaultAccount;
        $delimiter              = $data['delimiter'] ?? ',';
        $object->delimiter      = $validDelimiters[$delimiter] ?? 'comma';
        $object->headers        = $data['has-headers'] ?? false;
        $object->rules          = $data['apply-rules'] ?? true;
        $object->specifics      = [];

        $specifics = array_keys($data['specifics'] ?? []);
        foreach ($specifics as $name) {
            $class = sprintf('App\\Services\\CSV\\Specifics\\%s', $name);
            if (class_exists($class)) {
                $object->specifics[] = $name;
            }
        }

        return $object;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'date'             => $this->date,
            'defaultAccount'   => $this->defaultAccount,
            'delimiter'        => $this->delimiter,
            'headers'          => $this->headers,
            'ignoreDuplicates' => $this->ignoreDuplicates,
            'ignoreLines'      => $this->ignoreLines,
            'ignoreTransfers'  => $this->ignoreTransfers,
            'rules'            => $this->rules,
            'skipForm'         => $this->skipForm,
            'specifics'        => $this->specifics,
        ];
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getDefaultAccount(): int
    {
        return $this->defaultAccount;
    }

    /**
     * @return string
     */
    public function getDelimiter(): string
    {
        return $this->delimiter;
    }

    /**
     * @return bool
     */
    public function isHeaders(): bool
    {
        return $this->headers;
    }

    /**
     * @return bool
     */
    public function isIgnoreDuplicates(): bool
    {
        return $this->ignoreDuplicates;
    }

    /**
     * @return bool
     */
    public function isIgnoreLines(): bool
    {
        return $this->ignoreLines;
    }

    /**
     * @return bool
     */
    public function isIgnoreTransfers(): bool
    {
        return $this->ignoreTransfers;
    }

    /**
     * @return bool
     */
    public function isRules(): bool
    {
        return $this->rules;
    }

    /**
     * @return bool
     */
    public function isSkipForm(): bool
    {
        return $this->skipForm;
    }

    /**
     * @return array
     */
    public function getSpecifics(): array
    {
        return $this->specifics;
    }


}