<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    private $totalRecords;
    private $dataTableDraw;

    public function __construct($resource, $totalRecords, $draw)
    {
        // Ensure you call the parent constructor
        parent::__construct($resource);
        $this->resource = $resource;
        
        $this->totalRecords = $totalRecords;
        $this->dataTableDraw = $draw;
    }

    public function toArray($request): array
    {
        return [
            'draw' => $this->dataTableDraw,
            'recordsTotal' => $this->totalRecords,
            'recordsFiltered' => $this->totalRecords,
            'data' => $this->collection->map(function ($user) {
                return collect($user->toArray())
                    ->only('firstname', 'lastname', 'email')
                    ->values();
            }),
        ];
    }
}
