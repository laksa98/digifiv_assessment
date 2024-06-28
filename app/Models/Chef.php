<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chef extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'chefs';

    protected $fillable = [
        'name', 'signature_dishes'
    ];

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}
