<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Validation\Rule;


class RecipeCategoryRequest extends FormRequest
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
            'recipe_id' => [
                'required',
                'array',
            ],
            'recipe_id.*' => [
                'required',
                Rule::exists(Recipe::class, 'id')
            ],
            'category_id' => [
                'required',
                Rule::exists(Category::class, 'id')
            ]
        ];
        return $rules;
    }
}
