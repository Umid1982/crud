<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $table = 'providers';
    protected $guarded = false;

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'provider_id', 'id');
    }
}
