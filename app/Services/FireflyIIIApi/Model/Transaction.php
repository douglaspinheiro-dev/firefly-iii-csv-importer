<?php
/**
 * Transaction.php
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

namespace App\Services\FireflyIIIApi\Model;

/**
 * Class Transaction
 */
class Transaction
{
    /** @var string */
    public $amount;
    /** @var string */
    public $date;
    /** @var string */
    public $description;
    /** @var int */
    public $id;
    /** @var string */
    public $type;
    /** @var string */
    public $currencyCode;
    /** @var int */
    public $currencyId;
    /**
     * Transaction constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id           = (int)$data['transaction_journal_id'];
        $this->description  = $data['description'];
        $this->type         = $data['type'];
        $this->date         = $data['date'];
        $this->amount       = $data['amount'];
        $this->currencyCode = $data['currency_code'];
        $this->currencyId   = $data['currency_id'];
    }

}
