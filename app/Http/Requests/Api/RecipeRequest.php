<?php

namespace App\Http\Requests\Api;

use App\Models\Chef;
use App\Models\Recipe;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;


class RecipeRequest extends FormRequest
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
            'name' => 'required',
            'chef_id' => [
                'required',
                Rule::exists(Chef::class, 'id')
            ],
            'unique_code' => [
                'required',
                Rule::unique(Recipe::class, 'unique_code')
            ]
        ];

        return $rules;
    }
}
