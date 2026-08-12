<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreSetting extends Model
{
    protected $fillable = [
    'address',
    'open_hours',
    'whatsapp_number',
];
}
