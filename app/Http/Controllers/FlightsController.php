<?php

namespace App\Http\Controllers;

use App\Services\FlightsService;

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
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function index()
    {
        return response($this->service->list(), 200);
    }
}
