<?php

namespace App\Http\Requests\Api;
use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class RecipeIngredientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'ingredient_id' => [
                'required',
                'array'
            ],
            'ingredient_id.*' => [
                'required',
                Rule::exists(Ingredient::class, 'id')
            ]
        ];
        return $rules;
    }
}
