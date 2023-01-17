<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';
    protected $guarded = false;

    public function filial()
    {
        return $this->belongsTo(Filial::class,'filial_id','id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
