<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'Name' =>'required|unique:categories|max:225',
            'Description'=>'required|min:6',
            'Price'=>'required|gte:0',
            'Quantity'=>'required|gte:0',
            'CategoryID'=>'required|array|min:1'
        ];
    }

    public function messages(): array
    {
        return [
            'Name.required' => 'A Name is required',
            'Description.required' => 'A Description is required',
            'Price.required' =>'A Price is required',
            'Quantity.required' =>'A Price is required',
            'CategoryID.required' =>'A Price is required',

        ];
    }
}