<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customization extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'favicon',
        'primary_color',
        'secondary_color',
        'tersier_color',
        'active_color',
    ];

    public function getActiveColorValueAttribute()
    {
        if ($this->active_color == 'primary') {
            return $this->primary;
        } elseif ($this->active_color == 'secondary') {
            return $this->secondary;
        } elseif ($this->active_color == 'tersier') {
            return $this->tersier;
        }

        return $this->primary;
    }
}
