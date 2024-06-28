<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'recipes';

    protected $fillable = [
        'name', 'chef_id', 'unique_code', 'popularity'
    ];

    public function chef()
    {
        return $this->belongsTo(Chef::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'recipe_category');
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class, 'recipe_ingredients');
    }

    public function recipeIngredients()
    {
        return $this->hasMany(RecipeIngredient::class);
    }
}
