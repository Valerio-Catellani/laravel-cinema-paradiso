<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => 'required|max:255|min:3',
            'avarage_rating' => 'required|numeric',
            'original_language' => 'required|max:255|min:2',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio',
            'title.min' => 'Il titolo deve avere almeno :min caratteri',
            'title.max' => 'Il titolo deve avere massimo :max caratteri',
            'original_language.required' => 'La lingua più originale è obbligatoria',
            'original_language.min' => 'La lingua più originale deve avere almeno :min caratteri',
            'original_language.max' => 'La lingua più originale deve avere massimo :max caratteri',
            'avarage_rating.required' => 'La valutazione è obbligatoria',
            'avarage_rating.numeric' => 'La valutazione è un valore numerico compreso tra 0 e 5 (max 2 decimali)',
        ];
    }
}
