<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{
    use HasFactory;

    protected $table = 'filials';
    protected $guarded = false;

    public function departments()
    {
        return $this->hasMany(Department::class, 'filial_id', 'id');
    }
}
