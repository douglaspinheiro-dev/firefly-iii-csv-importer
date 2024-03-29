<?php
/**
 * BankDebitCredit.php
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

namespace App\Services\CSV\Converter;


use Log;

/**
 *
 * Class BankDebitCredit
 */
class BankDebitCredit implements ConverterInterface
{

    /**
     * Convert a value.
     *
     * @return mixed
     *
     * @param $value
     */
    public function convert($value): int
    {
        Log::debug('Going to convert ', ['value' => $value]);
        $negative = [
            'D', // Old style Rabobank (NL). Short for "Debit"
            'A', // New style Rabobank (NL). Short for "Af"
            'DR', // https://old.reddit.com/r/FireflyIII/comments/bn2edf/generic_debitcredit_indicator/
            'Af', // ING (NL).
            'Debet', // Triodos (NL)
        ];
        if (in_array(trim($value), $negative, true)) {
            return -1;
        }

        return 1;
    }
    /**
     * Add extra configuration parameters.
     *
     * @param string $configuration
     */
    public function setConfiguration(string $configuration): void
    {

    }
}
