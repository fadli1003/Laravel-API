<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'totalTickets' => $this['totalTickets'],
          'activeTickets' => $this['activeTickets'],
          'resolvedTickets' => $this['resolvedTickets'],
          'avgResolutionTime' => $this['avgResolutionTime'],
          'statusDistibution' => [
            'open' => $this['statusDistribution']['open'],
            'onprogress' => $this['statusDistribution']['onprogress'],
            'resolved' => $this['statusDistribution']['resolved'],
            'rejected' => $this['statusDistribution']['rejected'],

          ],
          // 'totalTickets' => $this->totalTickets,
          // 'activeTickets' => $this->activeTickets,
          // 'resolvedTickets' => $this->resolvedTickets,
          // 'avgResolutionTime' => $this->avgResolutionTime,
          // 'statusDistibution' => [
          //   'open' => $this->statusDistribution->open,
          //   'onprogress' => $this->statusDistribution->onprogress,
          //   'resolved' => $this->statusDistribution->resolved,
          //   'rejected' => $this->statusDistribution->rejected,

          // ],
        ];
    }
}
