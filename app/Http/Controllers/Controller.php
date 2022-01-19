<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1",
 *      title="Flights",
 *      description="Documentação da aplicação Flights"
 * )
 * @OA\Server(
 *      description="Flights API",
 *      url=L5_SWAGGER_CONST_HOST,
 * )
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     in="header",
 *     name="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 * )
 * @OA\Schema(
 *     schema="Groups",
 *     type="object",
 *    @OA\Property(
 *           property="flights",
 *           ref="#/components/schemas/flights"
 *    ),
 *    @OA\Property(
 *           property="groups",
 *           ref="#/components/schemas/groups"
 *    ),
 *     @OA\Property(
 *         property="totalGroups",
 *         type="int",
 *         example="10"
 *     ),
 *    @OA\Property(
 *         property="totalFlights",
 *         type="int",
 *         example="15"
 *     ),
 *    @OA\Property(
 *         property="cheapestPrice",
 *         type="float",
 *         example="200"
 *     ),
 *    @OA\Property(
 *        property="cheapestGroup",
 *        type="string",
 *        example="73060fcfbf1b4581ff4c5f8b7e49733e"
 *    )
 * )
 *
 * @OA\Schema(
 *     schema="flights",
 *     type="array",
 *     @OA\Items(
 *         @OA\Property(
 *             property="id",
 *             type="int",
 *             example="1"
 *         ),
 *         @OA\Property(
 *             property="cia",
 *             type="string",
 *             example="GOL"
 *         ),
 *         @OA\Property(
 *             property="fare",
 *             type="string",
 *             example="1AF"
 *         ),
 *         @OA\Property(
 *             property="flightNumber",
 *             type="string",
 *             example="G3-1701"
 *         ),
 *         @OA\Property(
 *             property="origin",
 *             type="string",
 *             example="CNF"
 *         ),
 *         @OA\Property(
 *             property="destination",
 *             type="string",
 *             example="BSB"
 *         ),
 *         @OA\Property(
 *             property="departureDate",
 *             type="string",
 *             example="29/01/2021"
 *         ),
 *         @OA\Property(
 *             property="arrivalDate",
 *             type="string",
 *             example="29/01/2021"
 *         ),
 *         @OA\Property(
 *             property="departureTime",
 *             type="string",
 *             example="07:40"
 *         ),
 *         @OA\Property(
 *             property="arrivalTime",
 *             type="string",
 *             example="09:00"
 *         ),
 *         @OA\Property(
 *             property="classService",
 *             type="int",
 *             example=3
 *         ),
 *         @OA\Property(
 *             property="price",
 *             type="float",
 *             example="50"
 *         ),
 *         @OA\Property(
 *             property="tax",
 *             type="float",
 *             example="36"
 *         ),
 *         @OA\Property(
 *             property="outbound",
 *             type="int",
 *             example="1"
 *         ),
 *         @OA\Property(
 *             property="inbound",
 *             type="int",
 *             example="0"
 *         ),
 *         @OA\Property(
 *             property="duration",
 *             type="string",
 *             example="1:20"
 *         )
 *     )
 *  )
 *
 * @OA\Schema(
 *     schema="groups",
 *     type="array",
 *     @OA\Items(
 *         @OA\Property(
 *             property="uniqueId",
 *             type="string",
 *             example="73060fcfbf1b4581ff4c5f8b7e49733e"
 *         ),
 *         @OA\Property(
 *             property="totalPrice",
 *             type="float",
 *             example="200"
 *         ),
 *         @OA\Property(
 *           property="inbound",
 *           ref="#/components/schemas/flights"
 *         ),
 *         @OA\Property(
 *           property="outbound",
 *           ref="#/components/schemas/flights"
 *         )
 *     )
 * )
 *
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
