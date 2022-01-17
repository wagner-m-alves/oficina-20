<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EstimateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'datetime'      => Carbon::parse($this->created_at)->format('d/m/Y H:i'),
            'client'        => new ClientResource($this->client),
            'employee'      => new EmployeeResource($this->employee),
            'description'   => $this->description,
            'value'         => number_format($this->value, 2, ',', '.' ),
        ];
    }
}
