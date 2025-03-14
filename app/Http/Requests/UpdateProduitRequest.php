<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:produit,name'.$this->route('id')], 
            'description' => ['required', 'string', 'max:255'], 
            'price' => ['required', 'numeric', 'min:0'], 
            'stock' => ['required', 'integer', 'min:0'], 
            'category_id' => ['required', 'exists:category,id'], 
            'rayon_id' => ['required', 'exists:rayon,id'], 
            'is_promotion' => ['nullable', 'integer', 'in:0,1']
        ];
    }
}
