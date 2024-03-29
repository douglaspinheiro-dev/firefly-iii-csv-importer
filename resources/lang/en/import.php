<?php
/**
 * import.php
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


return [

    // column roles for CSV import:
    'column__ignore'                => '(ignore this column)',
    'column_account-iban'           => 'Asset account (IBAN)',
    'column_account-id'             => 'Asset account ID (matching FF3)',
    'column_account-name'           => 'Asset account (name)',
    'column_account-bic'            => 'Asset account (BIC)',
    'column_amount'                 => 'Amount',
    'column_amount_foreign'         => 'Amount (in foreign currency)',
    'column_amount_debit'           => 'Amount (debit column)',
    'column_amount_credit'          => 'Amount (credit column)',
    'column_amount_negated'         => 'Amount (negated column)',
    'column_amount-comma-separated' => 'Amount (comma as decimal separator)',
    'column_bill-id'                => 'Bill ID (matching FF3)',
    'column_bill-name'              => 'Bill name',
    'column_budget-id'              => 'Budget ID (matching FF3)',
    'column_budget-name'            => 'Budget name',
    'column_category-id'            => 'Category ID (matching FF3)',
    'column_category-name'          => 'Category name',
    'column_currency-code'          => 'Currency code (ISO 4217)',
    'column_foreign-currency-code'  => 'Foreign currency code (ISO 4217)',
    'column_currency-id'            => 'Currency ID (matching FF3)',
    'column_currency-name'          => 'Currency name (matching FF3)',
    'column_currency-symbol'        => 'Currency symbol (matching FF3)',
    'column_date_interest'          => 'Interest calculation date',
    'column_date_book'              => 'Transaction booking date',
    'column_date_process'           => 'Transaction process date',
    'column_date_transaction'       => 'Date',
    'column_date_due'               => 'Transaction due date',
    'column_date_payment'           => 'Transaction payment date',
    'column_date_invoice'           => 'Transaction invoice date',
    'column_description'            => 'Description',
    'column_opposing-iban'          => 'Opposing account (IBAN)',
    'column_opposing-bic'           => 'Opposing account (BIC)',
    'column_opposing-id'            => 'Opposing account ID (matching FF3)',
    'column_external-id'            => 'External ID',
    'column_opposing-name'          => 'Opposing account (name)',
    'column_rabo-debit-credit'      => 'Rabobank specific debit/credit indicator',
    'column_ing-debit-credit'       => 'ING specific debit/credit indicator',
    'column_generic-debit-credit'   => 'Generic bank debit/credit indicator',
    'column_sepa_ct_id'             => 'SEPA end-to-end Identifier',
    'column_sepa_ct_op'             => 'SEPA Opposing Account Identifier',
    'column_sepa_db'                => 'SEPA Mandate Identifier',
    'column_sepa_cc'                => 'SEPA Clearing Code',
    'column_sepa_ci'                => 'SEPA Creditor Identifier',
    'column_sepa_ep'                => 'SEPA External Purpose',
    'column_sepa_country'           => 'SEPA Country Code',
    'column_sepa_batch_id'          => 'SEPA Batch ID',
    'column_tags-comma'             => 'Tags (comma separated)',
    'column_tags-space'             => 'Tags (space separated)',
    'column_account-number'         => 'Asset account (account number)',
    'column_opposing-number'        => 'Opposing account (account number)',
    'column_note'                   => 'Note(s)',
    'column_internal_reference'     => 'Internal reference',
    'account_types_asset'           => 'Asset accounts',
    'account_types_liabilities'     => 'Liabilities',
];
