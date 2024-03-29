<?php
/**
 * PostTransactionRequest.php
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

namespace App\Services\FireflyIIIApi\Request;


use App\Exceptions\ApiException;
use App\Exceptions\ApiHttpException;
use App\Services\FireflyIIIApi\Response\PostTransactionResponse;
use App\Services\FireflyIIIApi\Response\Response;
use App\Services\FireflyIIIApi\Response\ValidationErrorResponse;
use GuzzleHttp\Exception\GuzzleException;
use Log;

/**
 * Class PostTransactionRequest
 */
class PostTransactionRequest extends Request
{
    /**
     * PostTransactionRequest constructor.
     */
    public function __construct()
    {
        $url        = config('csv_importer.uri');
        $token      = config('csv_importer.access_token');
        $this->setBase($url);
        $this->setToken($token);
        $this->setUri('transactions');
    }

    /**
     * @return Response
     */
    public function get(): Response
    {
        // TODO: Implement get() method.
    }

    /**
     * @return Response
     * @throws ApiHttpException
     */
    public function post(): Response
    {
        Log::debug(sprintf('Now in %s', __METHOD__));
        try {
            $data = $this->authenticatedPost();
        } catch (ApiException|GuzzleException $e) {
            throw new ApiHttpException($e->getMessage());
        }
        if(isset($data['message']) && self::VALIDATION_ERROR_MSG === $data['message']) {
            return new ValidationErrorResponse($data['errors']);
        }

        return new PostTransactionResponse($data['data']);
    }
}
