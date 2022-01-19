<?php

namespace App\Http\Controllers;

use App\Services\FlightsService;
use Illuminate\Contracts\Pagination\Paginator;

class FlightsController extends Controller
{
    /**
     * @var FlightsService
     */
    public $service;

    public function __construct(FlightsService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/flights",
     *     tags={"flights"},
     *     operationId="index",
     *     summary="",
     *     description="",
     *     security={
     *         {"bearerAuth": {}}
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Groups"),
     *         ),
     *     ),
     * )
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */

    public function index()
    {
        return response($this->service->list(), 200);
    }
}
