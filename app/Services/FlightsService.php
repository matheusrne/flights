<?php

namespace App\Services;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\Types\Collection;

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
    public function list(): array
    {
        $flights = $this->getFlights();
        $fares = $flights->groupBy('fare');

        $groups = [];
        $data = [];

        foreach ($fares as $k => $fare) {
            $data[$k] = $this->arrangeByType($fare);
            $groups = array_merge($groups, $this->setGroups($data, $k));
        }

        $groups = $this->sortGroups($groups);

        return [
            'flights' => $flights,
            'groups' => $groups,
            'totalGroups' => $groups->count(),
            'totalFlights' => $flights->count(),
            'cheapestPrice' => $groups[0]['totalPrice'],
            'cheapestGroup' => $groups[0]['uniqueId'],
        ];

    }

    /**
     *
     * @return \Illuminate\Support\Collection
     */
    private function getFlights(): \Illuminate\Support\Collection
    {
        $flights = Http::get($this->baseUrl . 'flights')->json();
        return collect($flights);
    }

    /**
     *
     * @param $fare
     * @return array
     */
    private function arrangeByType($fare): array
    {
        $data = [];

        foreach ($fare as $flight) {
            if ($flight['outbound'] == 1) {
                $data['outbound'][$flight['price']][] = $flight;
            } else {
                $data['inbound'][$flight['price']][] = $flight;
            }
        }
        return $data;
    }

    /**
     *
     * @param $fare
     * @return array
     */
    private function setGroups($data, $k): array
    {
        $groups = [];

        foreach ($data[$k]['outbound'] as $v1 => $outbound) {
            foreach ($data[$k]['inbound'] as $v2 => $inbound) {
                $groups[] = [
                    'uniqueId' => md5($k . $v1 . $v2),
                    'totalPrice' => $v1 + $v2,
                    'outbound' => $outbound,
                    'inbound' => $inbound,
                ];
            }
        }

        return $groups;

    }

    /**
     *
     * @param $groups
     * @return \Illuminate\Support\Collection
     */
    private function sortGroups($groups): \Illuminate\Support\Collection
    {
        usort($groups, function ($item1, $item2) {
            return $item1['totalPrice'] > $item2['totalPrice'];
        });

        return collect($groups);

    }

}
