<?php

namespace App\Services;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class FlightsService extends Service
{
    /**
     * @var string
     */
    public $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.flights.base_url');
    }

    /**
     *
     * @return array
     */
    public function list() : array
    {
        $flights = Http::get($this->baseUrl . 'flights')->json();
        $flights = collect($flights);
        $fares = $flights->groupBy('fare');

        $data = [];
        $groups = [];

        foreach ($fares as $k => $fare) {
            foreach ($fare as $flight) {
                if ($flight['outbound'] == 1) {
                    $data[$k]['outbound'][$flight['price']][] = $flight;
                } else {
                    $data[$k]['inbound'][$flight['price']][] = $flight;
                }
            }

            foreach ($data[$k]['outbound'] as $v1 => $outbound) {
                foreach ($data[$k]['inbound'] as $v2 => $inbound) {
                    $groups[] = [
                        'uniqueId' => md5($k.$v1.$v2),
                        'totalPrice' => $v1 + $v2,
                        'outbound' => $outbound,
                        'inbound' => $inbound,
                    ];
                }
            }

        }

        usort($groups, function ($item1, $item2) {
            return $item1['totalPrice'] > $item2['totalPrice'];
        });

        $groups = collect($groups);

        return [
            'flights' => $flights,
            'groups' => $groups,
            'totalGroups' => $groups->count(),
            'totalFlights' => $flights->count(),
            'cheapestPrice' => $groups[0]['totalPrice'],
            'cheapestGroup' =>  $groups[0]['uniqueId'],
        ];

    }

}
