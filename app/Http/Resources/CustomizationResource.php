<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomizationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'logo' => $this->logo ? 'data:image/png;base64,' . $this->logo : null,
            'favicon' => $this->favicon ? 'data:image/x-icon;base64,' . $this->favicon : null,
            'active_color' => $this->active_color,
            'primary_color' => $this->primary,
            'secondary_color' => $this->secondary,
            'tersier_color' => $this->tersier,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
